<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';
$sBookingType = $_GET['sBookingType'] ?? '';


if($sBookingType=='upcoming'){
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.is_confirmed = 1 AND bookings.booking_date >= UNIX_TIMESTAMP() ORDER BY bookings.booking_date ASC' );
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
        $sOneResult = "<tr><td>".$aRow->first_name." ".$aRow->last_name."</td><td>".$aRow->name."</td><td>".$sDateNormalized."</td><td>".$sTimeIntervalString."</td><td>".$aRow->message."</td><td>Confirmed</td></tr>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(",",$aAllResults);
    if($aRows==[]){
        $sAllResultsString = "<tr><td colspan='6' style='color: lightgray;'>No upcoming bookings yet</td></tr>";
    }
    sendResponse(1, __LINE__, $sAllResultsString);

}else if($sBookingType=='pending'){
    
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.is_confirmed = 0 AND bookings.booking_date >= UNIX_TIMESTAMP() ORDER BY bookings.booking_date ASC' );
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
        $sOneResult = "<tr><td>".$aRow->first_name." ".$aRow->last_name."</td><td>".$aRow->name."</td><td>".$sDateNormalized."</td><td>".$sTimeIntervalString."</td><td>".$aRow->message."</td><td>Not confirmed</td></tr>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(",",$aAllResults);
    if($aRows==[]){
        $sAllResultsString = "<tr><td colspan='6' style='color: lightgray;'>No pending bookings yet</td></tr>";
    }
    sendResponse(2, __LINE__, $sAllResultsString);
}else if($sBookingType=='archived'){
    
    $stmtone = $db->prepare( 'SELECT bookings.id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, users.first_name, users.last_name, dogs.name from bookings 
    INNER JOIN users ON users.id = bookings.dog_sitter_fk 
    INNER JOIN dogs ON dogs.id = bookings.dog_fk 
    WHERE bookings.user_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.booking_date <= UNIX_TIMESTAMP() ORDER BY bookings.booking_date ASC' );
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
            $sStatus = 'Confirmed';
        }else{
            $sStatus = 'Not confirmed';
        }
        $sDateNormalized =  date("d/m/Y", substr($aRow->booking_date, 0, 10));
        $sOneResult = "<tr><td>".$aRow->first_name." ".$aRow->last_name."</td><td>".$aRow->name."</td><td>".$sDateNormalized."</td><td>".$sTimeIntervalString."</td><td>".$aRow->message."</td><td>".$sStatus."</td></tr>";
        $aAllResults[] = $sOneResult;
    }
    $sAllResultsString = join(",",$aAllResults);

    if($aRows==[]){
        $sAllResultsString = "<tr><td colspan='6' style='color: lightgray;'>No archived bookings yet</td></tr>";
    }

    sendResponse(3, __LINE__, $sAllResultsString);
}






/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}