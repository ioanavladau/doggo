<?php

require_once '../connect.php';

session_start();
$sEmail = $_SESSION['sEmail'];

if( !isset($_GET["txtiFareDogSitter"]) && !isset($_GET["txtsAboutDogSitter"])){
        sendResponse(0, __LINE__, "Fare and about not defined");
    } else {
        $iFareDogSitter = $_GET['txtiFareDogSitter'];
        $sAboutDogSitter = $_GET['txtsAboutDogSitter'];
}

try{

    $db->beginTransaction(); // all or nothing

    $stmt0 = $db->prepare('SELECT * FROM users WHERE email = :sEmail');
    $stmt0->bindValue(':sEmail', $sEmail);
    $stmt0->execute();

    $aRows = $stmt0->fetchAll();

    foreach($aRows as $row){
        $sUserId = $row->id;

        $stmt = $db->prepare("INSERT into dog_sitters VALUES (:sUserId, :iFareDogSitter, :sAboutDogSitter)");
        $stmt->bindValue(':sUserId', $sUserId);
        $stmt->bindValue(':iFareDogSitter', $iFareDogSitter);
        $stmt->bindValue(':sAboutDogSitter', $sAboutDogSitter);
        $stmt->execute();
        
        $stmt2 = $db->prepare("UPDATE users SET is_dog_sitter = 1 WHERE id = :sUserId");
        $stmt2->bindValue(':sUserId', $sUserId);
        $stmt2->execute();
    }


   if( !$stmt0->execute() ){
       $db->rollBack();
    //    echo 'Cannot insert the dog sitter '.__LINE__;
       sendResponse(0, __LINE__, "Cannot save dog sitter to DB");
    //    exit;
   }

   if( !$stmt2->execute() ){
    //    echo 'Cannot update is_dog_sitter status '.__LINE__;
       sendResponse(0, __LINE__, "Cannot save dog sitter to DB");
       $db->rollBack();
    //    exit;
   }

   $db->commit(); 
   sendResponse(1, __LINE__, "Success, dog sitter saved to DB");

}catch(PDOException $e){
    echo $e;
    exit;
}




/**************************************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}



