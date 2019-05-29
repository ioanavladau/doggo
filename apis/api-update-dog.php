<?php

  require_once '../connect.php';

  session_start();
  $sUserEmail = $_POST['sEmail'];

  $sUserEmail = $_POST['sUserEmail'] ?? '';
  $iDogWeight = $_POST['txtiDogWeight'] ?? '';
  // TODO: CHANGE value of IMAGE VARIABLE
  $sImageUrl = $_POST['txtiDogWeight'] ?? '';
  $bDogSpayedNeutered = $_POST['rbDogSpayedNeutered'] ?? '';
  $bDogMicrochipped = $_POST['rbDogMicrochipped'] ?? '';
  $bDogFriendlyWithOtherDogs = $_POST['rbDogFriendlyWithOtherDogs'] ?? '';
  $sDogSpecialRequirements = $_POST['txtsDogSpecialRequirements'] ?? '';
  $sDogVetContact = $_POST['txtsDogVetContact'] ?? '';
  $sDogAbout = $_POST['txtsDogAbout'] ?? '';
  $sDogCareInstructions = $_POST['txtsDogCareInstructions'] ?? '';




  $stmt = $db->prepare("UPDATE dogs SET weight=:iDogWeight, image_url=:sImageUrl,  spayed_neutered=:bDogSpayedNeutered,  microchipped=:bDogMicrochipped,  
                          friendly=:bDogFriendlyWithOtherDogs,  special_requirements=:sDogSpecialRequirements, vet_contact=:sDogVetContact, about=:sDogAbout, 
                          care_instructions=:sDogCareInstructions WHERE user_fk = (SELECT id FROM users WHERE email=:sEmail) ");
  // care_instructions=:sDogCareInstructions WHERE user_fk = (CALL get_user_id('i@i.com')) ");
  
  $stmt->bindValue(':iDogWeight', $iDogWeight);
  $stmt->bindValue(':sImageUrl', $sImageUrl);
  $stmt->bindValue(':bDogSpayedNeutered', $bDogSpayedNeutered);
  $stmt->bindValue(':bDogMicrochipped', $bDogMicrochipped);
  $stmt->bindValue(':sDogCareInstructions', $sDogCareInstructions);
  $stmt->bindValue(':bDogFriendlyWithOtherDogs', $bDogFriendlyWithOtherDogs);
  $stmt->bindValue(':sDogSpecialRequirements', $sDogSpecialRequirements);
  $stmt->bindValue(':sDogVetContact', $sDogVetContact);
  $stmt->bindValue(':sDogAbout', $sDogAbout);
  
  $stmt->bindValue(':sEmail', $sUserEmail);
  
  $stmt->execute();
  sendResponse(1, __LINE__, 'dog updated');

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
  echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
  exit;
}