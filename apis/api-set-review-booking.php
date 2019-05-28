<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$iBookingFk = $_GET['iBookingFk'] ?? '';
$iDogsitterfk = $_GET['iDogsitterfk'] ?? '';
$sUserEmail = $_GET['sUserEmail'] ?? '';
$iRating = $_GET['iRating'] ?? '';
$sReviewText = $_GET['sReviewText'] ?? '';



$stmt = $db->prepare( 'SELECT id FROM users WHERE email = :sUserEmail' );
$stmt->bindValue(':sUserEmail', $sUserEmail);
$stmt->execute();
$aRows = $stmt->fetchAll();

foreach( $aRows as $aRow ){
    $sUserId = $aRow->id;
    $stmtone = $db->prepare( 'INSERT INTO reviews VALUES(null, :sUserId, :iDogsitterfk, :iBookingFk, :sReviewText, UNIX_TIMESTAMP()*1000, :iRating)' );
$stmtone->bindValue(':sUserId', $sUserId);
$stmtone->bindValue(':iDogsitterfk', $iDogsitterfk);
$stmtone->bindValue(':iBookingFk', $iBookingFk);
$stmtone->bindValue(':iRating', $iRating);
$stmtone->bindValue(':sReviewText', $sReviewText);
$stmtone->execute();
}

// echo $sUserId;







sendResponse(1, __LINE__, 'Review is added');

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}
