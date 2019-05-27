<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$iBookingId = $_GET['iBookingId'] ?? '';
$iBookingdate = $_GET['iBookingdate'] ?? '';
$iDogsitterfk = $_GET['iDogsitterfk'] ?? '';

$stmtone = $db->prepare( 'DELETE FROM bookings WHERE id = :iBookingId' );
$stmtone->bindValue(':iBookingId', $iBookingId);
$stmtone->execute();

$stmttwo = $db->prepare( 'UPDATE dog_sitters_availability SET is_available=1 WHERE start_date = :iBookingdate AND user_fk = :iDogsitterfk' );
$stmttwo->bindValue(':iBookingdate', $iBookingdate);
$stmttwo->bindValue(':iDogsitterfk', $iDogsitterfk);
$stmttwo->execute();


sendResponse(1, __LINE__, 'Booking is deleted and dogsitter is now available at this date');

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}
