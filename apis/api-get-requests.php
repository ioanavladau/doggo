<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';
// $sBookingType = $_GET['sBookingType'] ?? '';

$stmtone = $db->prepare( 'SELECT bookings.id AS booking_id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, dogs.name AS dog_name, breeds.name AS breed_name, (SELECT users.first_name FROM users WHERE users.id = bookings.user_fk) AS owner_first_name, (SELECT users.last_name FROM users WHERE users.id = bookings.user_fk) AS owner_last_name FROM bookings 
INNER JOIN users ON users.id = bookings.dog_sitter_fk 
INNER JOIN dogs ON dogs.id = bookings.dog_fk 
INNER JOIN breeds ON breeds.id = dogs.breed_fk 
WHERE bookings.dog_sitter_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.is_confirmed = 0 ORDER BY bookings.booking_date ASC' );
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
    // $sOneResult = "<tr><td>".$sDateNormalized."</td><td>".$sTimeIntervalString."</td><td>".$aRow->message."</td><td>".$aRow->dog_name.", ".$aRow->breed_name."</td></tr>";
    $sOneResult = "<div class='request-card'><div class='request-info'><img src='images/maya.jpg' alt=''><div class='request-text'><h5>Dog walking for ".$aRow->dog_name.", ".$aRow->breed_name."</h5><span class='request-date'>".$sDateNormalized."</span><span class='request-time'>".$sTimeIntervalString."</span><div class='request-message'>“".$aRow->message."”</div><span class='request-owner'>- ".$aRow->owner_first_name." ".$aRow->owner_last_name."</span></div></div><div class='accept-decline-buttons'><button data-bookingid='".$aRow->booking_id."' class='yellow-btn accept-btn'>Accept request</button><button data-bookingid='".$aRow->booking_id."' data-bookingdate='".$aRow->booking_date."' data-dogsitterfk='".$aRow->dog_sitter_fk."' class='red-btn decline-btn'>Decline request</button></div></div>";
    $aAllResults[] = $sOneResult;
}

$sAllResultsString = join(" ",$aAllResults);
if($aRows==[]){
    $sAllResultsString = "<div class='no-requests'>No pending requests yet</div>";
}
sendResponse(1, __LINE__, $sAllResultsString);


/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}