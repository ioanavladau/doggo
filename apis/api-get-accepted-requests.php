<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';
// $sBookingType = $_GET['sBookingType'] ?? '';

$stmtone = $db->prepare( 'SELECT bookings.id AS booking_id, bookings.user_fk, bookings.dog_sitter_fk, bookings.dog_fk, bookings.time_interval, bookings.message, bookings.booking_date, bookings.is_confirmed, dogs.name AS dog_name, dogs.image_url AS dog_photo, dogs.id, breeds.name AS breed_name, (SELECT users.first_name FROM users WHERE users.id = bookings.user_fk) AS owner_first_name, (SELECT users.last_name FROM users WHERE users.id = bookings.user_fk) AS owner_last_name, (SELECT users.address FROM users WHERE users.id = bookings.user_fk) AS owner_address, (SELECT users.phone_number FROM users WHERE users.id = bookings.user_fk) AS owner_phone_number, dog_sitters.fare FROM bookings 
INNER JOIN users ON users.id = bookings.dog_sitter_fk 
INNER JOIN dogs ON dogs.id = bookings.dog_fk 
INNER JOIN breeds ON breeds.id = dogs.breed_fk 
INNER JOIN dog_sitters ON users.id = dog_sitters.user_fk 
WHERE bookings.dog_sitter_fk IN (SELECT users.id from users WHERE users.email = :sUserEmail) AND bookings.is_confirmed = 1 ORDER BY bookings.booking_date ASC' );
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
    $sOneResult = "<div class='request-card'><div class='request-info'><a href='view-dog?id=$aRow->id'><img src='doggo/".$aRow->dog_photo."' alt=''></a><div class='request-text'><h5>Dog walking for ".$aRow->dog_name.", ".$aRow->breed_name."</h5><span class='request-date'>".$sDateNormalized."</span><span class='request-time'>".$sTimeIntervalString."</span><div class='request-message'>“".$aRow->message."”</div><span class='request-owner'>- ".$aRow->owner_first_name." ".$aRow->owner_last_name."</span></div></div><div class='owner-info'><div><h6>Owners address</h6>".$aRow->owner_address."</div><div><h6>Your fare</h6>".$aRow->fare." kr./walk</div><div><h6>Owner</h6>".$aRow->owner_first_name." ".$aRow->owner_last_name."</div><div><h6>Phone number</h6>+45 ".$aRow->owner_phone_number."</div></div></div>";
    $aAllResults[] = $sOneResult;
}

$sAllResultsString = join(" ",$aAllResults);
if($aRows==[]){
    $sAllResultsString = "<div class='no-requests'>No accepted requests yet</div>";
}
sendResponse(1, __LINE__, $sAllResultsString);


/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}