<?php

  require_once '../connect.php';

  session_start();
  $dogId = $_POST['id'];


  $iDogWeight = $_POST['txtiDogWeight'] ?? '';
  // TODO: CHANGE value of IMAGE VARIABLE
  // $sImageUrl = $_FILES['fileToUpload'];
  $bDogSpayedNeutered = $_POST['rbDogSpayedNeutered'] ?? '';
  $bDogMicrochipped = $_POST['rbDogMicrochipped'] ?? '';
  $bDogFriendlyWithOtherDogs = $_POST['rbDogFriendlyWithOtherDogs'] ?? '';
  $sDogSpecialRequirements = $_POST['txtsDogSpecialRequirements'] ?? '';
  $sDogVetContact = $_POST['txtsDogVetContact'] ?? '';
  $sDogAbout = $_POST['txtsDogAbout'] ?? '';
  $sDogCareInstructions = $_POST['txtsDogCareInstructions'] ?? '';

  // image_url=:sImageUrl,

  $stmt = $db->prepare("UPDATE dogs SET weight=:iDogWeight, spayed_neutered=:bDogSpayedNeutered,  microchipped=:bDogMicrochipped,  
                          friendly=:bDogFriendlyWithOtherDogs,  special_requirements=:sDogSpecialRequirements, vet_contact=:sDogVetContact, about=:sDogAbout, 
                          care_instructions=:sDogCareInstructions WHERE id=:dogId");
  // care_instructions=:sDogCareInstructions WHERE user_fk = (CALL get_user_id('i@i.com')) ");
  
  $stmt->bindValue(':dogId', $dogId);

  // $stmt->bindValue(':sImageUrl', $sImageUrl);
  $stmt->bindValue(':iDogWeight', $iDogWeight);
  $stmt->bindValue(':bDogSpayedNeutered', $bDogSpayedNeutered);
  $stmt->bindValue(':bDogMicrochipped', $bDogMicrochipped);
  $stmt->bindValue(':bDogFriendlyWithOtherDogs', $bDogFriendlyWithOtherDogs);
  $stmt->bindValue(':sDogSpecialRequirements', $sDogSpecialRequirements);
  $stmt->bindValue(':sDogCareInstructions', $sDogCareInstructions);
  $stmt->bindValue(':sDogVetContact', $sDogVetContact);
  $stmt->bindValue(':sDogAbout', $sDogAbout);
  
  
  $stmt->execute();
  sendResponse(1, __LINE__, 'dog updated');

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
  echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
  exit;
}