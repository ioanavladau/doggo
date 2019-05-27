<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$iBookingId = $_GET['iBookingId'] ?? '';

$stmtone = $db->prepare( 'UPDATE bookings SET is_confirmed=1 WHERE id=:iBookingId' );
$stmtone->bindValue(':iBookingId', $iBookingId);
$stmtone->execute();

sendResponse(1, __LINE__, 'Request is confirmed by dogsitter');

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}

