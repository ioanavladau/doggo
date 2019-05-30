<?php

  require_once '../connect.php';

  // $sUserEmail = $_GET['sUserEmail'] ?? '';
  $dogId = $_GET['id'];

  $stmt = $db->prepare( 'SELECT dogs.name, breeds.name AS breed, dogs.weight, dogs.age_years, dogs.age_months, dogs.image_url, dogs.spayed_neutered, dogs.microchipped, dogs.friendly, dogs.special_requirements, dogs.vet_contact, dogs.about, dogs.care_instructions FROM dogs INNER JOIN breeds on dogs.breed_fk = breeds.id WHERE dogs.id=:dogId' );
  $stmt->bindValue(':dogId', $dogId);
  $stmt->execute();
  $row = $stmt->fetch();

  $dogInfo = new stdClass();

  $dogInfo->sDogName = $row->name;
  $dogInfo->sDogBreed = $row->breed;
  $dogInfo->iDogWeight = $row->weight;
  $dogInfo->sDogImageUrl = 'doggo/'.$row->image_url;
  $dogInfo->bDogSpayedNeutered = $row->spayed_neutered;
  $dogInfo->bDogMicrochipped = $row->microchipped;
  $dogInfo->bDogFriendly = $row->friendly;
  $dogInfo->sDogSpecialRequirements = $row->special_requirements;
  $dogInfo->sDogVetContact = $row->vet_contact;
  $dogInfo->sDogAbout = $row->about;
  $dogInfo->sDogCareInstructions = $row->care_instructions;
    
  sendResponse(1, __LINE__, json_encode($dogInfo));

  
/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
  echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message": '.$sMessage.'}';
  exit;
}