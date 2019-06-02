<?php

require_once '../connect.php';

$iBookingId = $_GET['iBookingId'] ?? '';
$iBookingdate = $_GET['iBookingdate'] ?? '';
$iDogsitterfk = $_GET['iDogsitterfk'] ?? '';

try{

  $db->beginTransaction();

  $stmtone = $db->prepare( 'UPDATE bookings SET is_confirmed=-1 WHERE id=:iBookingId' );
  $stmtone->bindValue(':iBookingId', $iBookingId);
  if( !$stmtone->execute() ){
    $db->rollback();
  }

  $stmttwo = $db->prepare( 'UPDATE dog_sitters_availability SET is_available=1 WHERE start_date = :iBookingdate AND user_fk = :iDogsitterfk' );
  $stmttwo->bindValue(':iBookingdate', $iBookingdate);
  $stmttwo->bindValue(':iDogsitterfk', $iDogsitterfk);
  if( !$stmttwo->execute() ){
    $db->rollback();
  }

  $db->commit();
  sendResponse(1, __LINE__, 'Request is declined by dogsitter');

}catch(PDOException $e){
  echo $e;
  $db->rollback();
  exit;
}

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}


