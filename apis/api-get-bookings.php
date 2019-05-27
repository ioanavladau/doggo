<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';
$sBookingType = $_GET['sBookingType'] ?? '';


if($sBookingType=='upcoming'){
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name AS dog_name, users.profile_photo_url, dog_sitters.fare from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    INNER JOIN dog_sitters ON bookings.dog_sitter_fk = dog_sitters.user_fk
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.is_confirmed = 1 AND CONVERT(SUBSTRING(CONVERT(booking_date, CHAR),1,10), INT) >= UNIX_TIMESTAMP() ORDER BY bookings.booking_date DESC' );
    $stmtone->bindValue(':sUserEmail', $sUserEmail);
    $stmtone->execute();
    $aRows = $stmtone->fetchAll();

    $aAllResults = array();

    foreach( $aRows as $aRow ){
        if($aRow->time_interval == 'morning'){
            $sTimeIntervalString = '06:00-11:00';
        }else if($aRow->time_interval == 'noon'){
            $sTimeIntervalString = '11:00-15:00';
        }else if($aRow->time_interval == 'evening'){
            $sTimeIntervalString = '15:00-22:00';
        }
        $sDateNormalized =  date("d/m/Y", substr($aRow->booking_date, 0, 10));
        $sOneResult = "<div class='booking-container'><img src='".$aRow->profile_photo_url."' alt=''><div class='booking-name-time'><h5>".$aRow->first_name." ".$aRow->last_name."</h5><div class='booking-date-and-time'><h5 style='color: #474747;'>".$sDateNormalized."</h5><span class='booking-time'>".$sTimeIntervalString."</span></div><h6>Dog walking for ".$aRow->dog_name."</h6><div class='green-label'>Confirmed</div></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Message</span><span class='booking-message'>".$aRow->message."</span></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Fare</span><h6>".$aRow->fare." kr./walk</h6></div></div>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(" ",$aAllResults);
    if($aRows==[]){
        $sAllResultsString = "<div style='color: lightgray;'>No upcoming bookings yet</div>";
    }
    sendResponse(1, __LINE__, $sAllResultsString);

}else if($sBookingType=='pending'){
    
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name AS dog_name, users.profile_photo_url, dog_sitters.fare from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    INNER JOIN dog_sitters ON bookings.dog_sitter_fk = dog_sitters.user_fk
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND CONVERT(SUBSTRING(CONVERT(booking_date, CHAR),1,10), INT) >= UNIX_TIMESTAMP() AND bookings.is_confirmed = 0 OR bookings.is_confirmed = -1 ORDER BY bookings.booking_date DESC' );
    $stmtone->bindValue(':sUserEmail', $sUserEmail);
    $stmtone->execute();
    $aRows = $stmtone->fetchAll();

    $aAllResults = array();

    foreach( $aRows as $aRow ){
        if($aRow->time_interval == 'morning'){
            $sTimeIntervalString = '06:00-11:00';
        }else if($aRow->time_interval == 'noon'){
            $sTimeIntervalString = '11:00-15:00';
        }else if($aRow->time_interval == 'evening'){
            $sTimeIntervalString = '15:00-22:00';
        }
        if($aRow->is_confirmed == 1){
            $sStatusClass = 'green-label';
            $sStatus = 'Confirmed';
            $sCancelBtn = "";
        }else if($aRow->is_confirmed == 0){
            $sStatusClass = 'gray-label';
            $sStatus = 'Not confirmed';
            $sCancelBtn = "<div class='vertical-divider'></div><button data-bookingid='".$aRow->id."' data-bookingdate='".$aRow->booking_date."' data-dogsitterfk='".$aRow->dog_sitter_fk."' type='button' class='red-btn cancel-booking'>Cancel booking</button>";
        }else if($aRow->is_confirmed == -1){
            $sStatusClass = 'red-label';
            $sStatus = 'Declined';
            $sCancelBtn = "";
        }
        $sDateNormalized =  date("d/m/Y", substr($aRow->booking_date, 0, 10));
        $sOneResult = "<div class='booking-container'><img src='".$aRow->profile_photo_url."' alt=''><div class='booking-name-time'><h5>".$aRow->first_name." ".$aRow->last_name."</h5><div class='booking-date-and-time'><h5 style='color: #474747'>".$sDateNormalized."</h5><span class='booking-time'>".$sTimeIntervalString."</span></div><h6>Dog walking for ".$aRow->dog_name."</h6><div class='".$sStatusClass."'>".$sStatus."</div></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Message</span><span class='booking-message'>".$aRow->message."</span></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Fare</span><h6>".$aRow->fare." kr./walk</h6></div>".$sCancelBtn."</div>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(" ",$aAllResults);
    if($aRows==[]){
        $sAllResultsString = "<div style='color: lightgray;'>No pending bookings yet</div>";
    }
    sendResponse(2, __LINE__, $sAllResultsString);

}else if($sBookingType=='archived'){
    
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name AS dog_name, users.profile_photo_url, dog_sitters.fare from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    INNER JOIN dog_sitters ON bookings.dog_sitter_fk = dog_sitters.user_fk
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND CONVERT(SUBSTRING(CONVERT(booking_date, CHAR),1,10), INT) <= UNIX_TIMESTAMP() ORDER BY bookings.booking_date DESC' );
    $stmtone->bindValue(':sUserEmail', $sUserEmail);
    $stmtone->execute();
    $aRows = $stmtone->fetchAll();

    $aAllResults = array();

    foreach( $aRows as $aRow ){
        if($aRow->time_interval == 'morning'){
            $sTimeIntervalString = '06:00-11:00';
        }else if($aRow->time_interval == 'noon'){
            $sTimeIntervalString = '11:00-15:00';
        }else if($aRow->time_interval == 'evening'){
            $sTimeIntervalString = '15:00-22:00';
        }
        if($aRow->is_confirmed == 1){
            $sStatusClass = 'green-label';
            $sStatus = 'Confirmed';
        }else if($aRow->is_confirmed == 0){
            $sStatusClass = 'gray-label';
            $sStatus = 'Not confirmed';
        }else if($aRow->is_confirmed == -1){
            $sStatusClass = 'red-label';
            $sStatus = 'Declined';
        }
        $sDateNormalized =  date("d/m/Y", substr($aRow->booking_date, 0, 10));
        $sOneResult = "<div class='booking-container'><img src='".$aRow->profile_photo_url."' alt=''><div class='booking-name-time'><h5>".$aRow->first_name." ".$aRow->last_name."</h5><div class='booking-date-and-time'><h5 style='color: #474747'>".$sDateNormalized."</h5><span class='booking-time'>".$sTimeIntervalString."</span></div><h6>Dog walking for ".$aRow->dog_name."</h6><div class='".$sStatusClass."'>".$sStatus."</div></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Message</span><span class='booking-message'>".$aRow->message."</span></div><div class='vertical-divider'></div><div class='message-block'><span class='booking-time'>Fare</span><h6>".$aRow->fare." kr./walk</h6></div></div>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(" ",$aAllResults);

    if($aRows==[]){
        $sAllResultsString = "<div style='color: lightgray;'>No archived bookings yet</div>";
    }

    sendResponse(3, __LINE__, $sAllResultsString);
}






/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}