<?php

require_once __DIR__.'/../connect.php';

session_start();
$_SESSION['email'] = 'a@a.com';

if(isset($_GET["txtiDogSitterFare"]) && isset($_GET['txtiDogSitterAbout'])){
    $iFareDogSitter = $_GET['txtiDogSitterFare'];
    echo 'txtiDogSitterFare is '.$_GET["txtiDogSitterFare"];
    $sAboutDogSitter = $_GET['txtiDogSitterAbout'];
    echo 'txtiDogSitterAbout is '.$_GET["txtiDogSitterAbout"];
} else {
    $iFareDogSitter == null;
    sendResponse(0, __LINE__, "Fare or about not defined");
}


try{

    $db->beginTransaction(); // all or nothing

    $stmt = $db->prepare('INSERT into dog_sitters (fare, about) VALUES (:iFareDogSitter, :sAboutDogSitter)');
    $stmt->bindValue(':iFareDogSitter', $iFareDogSitter);
    $stmt->bindValue(':sAboutDogSitter', $sAboutDogSitter);
    $stmt->execute();

   if( !$stmt->execute() ){
       echo 'Cannot insert the dog sitter '.__LINE__;
       sendResponse(0, __LINE__, "Cannot save dog sitter to DB");
       $db->rollBack();
       exit;
   }


    $stmt2 = $db->prepare('UPDATE users SET is_dog_sitter = 1 WHERE id = :userId');

    $stmt->bindValue(':userId', $_SESSION['email']);
    $stmt2->execute();

   if( !$stmt2->execute() ){
       echo 'Cannot update is_dog_sitter status '.__LINE__;
       $db->rollBack();
       exit;
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



