<?php

// ini_set('display_errors',0);

require_once __DIR__.'/connect.php';

$sStartDate = $_GET['sStartDate'] ?? '';
$sEndDate = $_GET['sEndDate'] ?? '';
$sTimeInterval = $_GET['sTimeInterval'] ?? '';

// $stmt = $db->prepare( 'INSERT INTO dog_sitters_availability VALUES(1, :sStartDate, :sEndDate, :sTimeInterval)' );
// $stmt->bindValue(':sStartDate', $sStartDate);
// $stmt->bindValue(':sEndDate', $sEndDate);
// $stmt->bindValue(':sTimeInterval', $sTimeInterval);

// $stmt->execute();


try {
   $db->beginTransaction(); //all or nothing **********************
//    $stmt = $db->prepare('INSERT INTO users_actions VALUES (1,:sImageId,1)');
//    $stmt->bindValue(':sImageId', $sImageId);
//    $stmt->execute();


   $stmt = $db->prepare('INSERT INTO dog_sitters_availability VALUES(1, :sStartDate, :sEndDate, :sTimeInterval)');
   $stmt->bindValue(':sStartDate', $sStartDate);
    $stmt->bindValue(':sEndDate', $sEndDate);
    $stmt->bindValue(':sTimeInterval', $sTimeInterval);
    $stmt->execute();
    sendResponse(1, __LINE__, "Success");
//    if( !$stmt->execute() ){
//        echo 'Can not update the user '.__LINE__;
//        $db->rollBack();
//        exit;
//    }

//    $db->commit(); //**********************

}catch(PDOException $e){
   echo $e;
   //fatal error if you try to break the uniqueness in the database
   $db->rollBack(); //**********************
   exit;
}




/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}