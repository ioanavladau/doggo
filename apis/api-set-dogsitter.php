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

if(!isset($_GET['rbVetStudies'])){
    sendResponse(0,__LINE__,"Please select if you have vet studies");
  } else {
      $bVetStudies = $_GET['rbVetStudies'];
      if($bVetStudies == 'yes'){
        $bVetStudies = 1; 
      } else $bVetStudies = 0; 
  }

  if(!isset($_GET['rbOralMedication'])){
    sendResponse(0,__LINE__,"Please select if you can give dogs oral medication");
  } else {
      $bOralMedication = $_GET['rbOralMedication'];
      if($bOralMedication == 'yes'){
        $bOralMedication = 1; 
      } else $bOralMedication = 0; 
  }

  if(!isset($_GET['rbVaccinateDogs'])){
    sendResponse(0,__LINE__,"Please select if you are able to vaccinate dogs");
  } else {
      $bVaccinateDogs = $_GET['rbVaccinateDogs'];
      if($bVaccinateDogs == 'yes'){
        $bVaccinateDogs = 1; 
      } else $bVaccinateDogs = 0; 
  }

  if(!isset($_GET['rbTrainingTechniques'])){
    sendResponse(0,__LINE__,"Please select if you are familiar with training techniques");
  } else {
      $bTrainingTechniques = $_GET['rbTrainingTechniques'];
      if($bTrainingTechniques == 'yes'){
        $bTrainingTechniques = 1; 
      } else $bTrainingTechniques = 0; 
  }

  // id skills table: 1            2                   3                   4
  $aSkills = [$bVetStudies, $bOralMedication, $bVaccinateDogs, $bTrainingTechniques];

try{
    $db->beginTransaction(); // all or nothing

    $stmt0 = $db->prepare('SELECT * FROM users WHERE email = :sEmail');
    $stmt0->bindValue(':sEmail', $sEmail);
    $stmt0->execute();

    $aRows = $stmt0->fetchAll();

    foreach($aRows as $row){
        $sUserId = $row->id;

        $stmt = $db->prepare("INSERT into dog_sitters VALUES (null, :sUserId, :iFareDogSitter, :sAboutDogSitter)");
        $stmt->bindValue(':sUserId', $sUserId);
        $stmt->bindValue(':iFareDogSitter', $iFareDogSitter);
        $stmt->bindValue(':sAboutDogSitter', $sAboutDogSitter);
        $stmt->execute();
        
        $stmt2 = $db->prepare("UPDATE users SET is_dog_sitter = 1 WHERE id = :sUserId");
        $stmt2->bindValue(':sUserId', $sUserId);
        $stmt2->execute();
        
    }


    foreach($aSkills as $key=>$skill){
        // if($aSkills[$i] == 1){
            // echo $key;
        $key++;
        if($skill == 1){
            $stmt3 = $db->prepare("INSERT into dog_sitters_skills VALUES(:sUserId, :iSkillFk)");
            $stmt3->bindValue(':sUserId', $sUserId);
            $stmt3->bindParam(':iSkillFk', $key);
            $stmt3->execute();
        }


        // if( !$stmt3->execute() ){
        //     $db->rollBack();
        //     //    echo 'Cannot insert the dog sitter '.__LINE__;
        //         sendResponse(0, __LINE__, "Cannot save dog sitter to DB, error with skills");
        //     //    exit;
        // }
    }


    



   if( !$stmt0->execute() ){
       $db->rollBack();
    //    echo 'Cannot insert the dog sitter '.__LINE__;
       sendResponse(0, __LINE__, "Cannot save dog sitter to DB, error with inserting user into dog_sitters");
    //    exit;
   }

   if( !$stmt2->execute() ){
    //    echo 'Cannot update is_dog_sitter status '.__LINE__;
       sendResponse(0, __LINE__, "Cannot save dog sitter to DB, error with setting is_dog_sitter to 1");
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



