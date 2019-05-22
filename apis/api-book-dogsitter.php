<?php

// ini_set('display_errors',0);

require_once '../connect.php';


$sUserEmail = $_GET['sUserEmail'] ?? '';
$sDogSitterId = $_GET['sDogSitterId'] ?? '';
$sBookingMessage = $_GET['message'] ?? '';
$sTime = $_GET['sTime'] ?? '';
$sDate = $_GET['sDate'] ?? '';


$stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address FROM users WHERE email=:sUserEmail' );
$stmt->bindValue(':sUserEmail', $sUserEmail);
$stmt->execute();
$aRows = $stmt->fetchAll();

foreach( $aRows as $aRow ){
    $sUserId = $aRow->id;
    
}


$stmttwo = $db->prepare( 'INSERT INTO bookings(id, user_fk, dog_sitter_fk, dog_fk, time_interval, message, booking_date) VALUES(null, :sUserId, :sDogSitterId, 1, :sTime, :sBookingMessage, :sDate)' );
$stmttwo->bindValue(':sUserId', $sUserId);
$stmttwo->bindValue(':sDogSitterId', $sDogSitterId);
$stmttwo->bindValue(':sBookingMessage', $sBookingMessage);
$stmttwo->bindValue(':sTime', $sTime);
$stmttwo->bindValue(':sDate', $sDate);
$stmttwo->execute();
sendResponse(1, __LINE__, "Success");






/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}