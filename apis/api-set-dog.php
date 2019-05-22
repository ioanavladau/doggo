<?php

require_once '../connect.php';

session_start();
$sUserEmail = $_SESSION['sEmail'];


$sDogName = $_POST['txtsDogName'];
$iDogWeight = $_POST['txtiDogWeight'];
$iDogYears = $_POST['txtiDogYears'];
$iDogMonths = $_POST['txtiDogMonths'];

if(isset($_POST['female'])){
  $bDogGender = 1; 
} else $bDogGender = 0; 

$sDogBreed = $_POST['txtsDogBreed'];

if(($_POST['rbDogSpayedNeutered']) == 'yes'){
  $rbDogSpayedNeutered = 1; 
} else $rbDogSpayedNeutered = 0; 

if(($_POST['rbDogMicrochipped']) == 'yes'){
  $bDogMicrochipped = 1; 
} else $bDogMicrochipped = 0; 

if(($_POST['rbDogFriendlyWithOtherDogs']) == 'yes'){
  $bDogFriendlyWithOtherDogs = 1; 
} else $bDogFriendlyWithOtherDogs = 0; 

$sDogSpecialRequirements = $_POST['txtsDogSpecialRequirements'];
$sDogVetContact = $_POST['txtsDogVetContact'];
$sDogAbout = $_POST['txtsDogAbout'];
$sDogCareInstructions = $_POST['txtsDogCareInstructions'];


$stmt = $db->prepare( "INSERT INTO dogs (id, user_fk, name, weight, breed_fk, age_years, age_months,  gender ,  spayed_neutered ,  microchipped ,  friendly ,  special_requirements ,vet_contact ,about , care_instructions) 
VALUES (NULL, (SELECT id FROM users WHERE email = :sEmail), :sDogName, :iDogWeight, :bDogGender, :iDogYears, :iDogMonths,  :sDogBreed,   :bDogSpayedNeutered, :bDogMicrochipped, :bDogFriendlyWithOtherDogs, :sDogSpecialRequirements, :sDogVetContact, :sDogAbout, :sDogCareInstructions)" );

$stmt->bindValue(':sEmail', $sUserEmail);
$stmt->bindValue(':sDogName', $sDogName);
$stmt->bindValue(':iDogWeight', $iDogWeight);
$stmt->bindValue(':sDogBreed', $sDogBreed);
$stmt->bindValue(':iDogYears', $iDogYears);
$stmt->bindValue(':iDogMonths', $iDogMonths);
$stmt->bindValue(':bDogGender', $bDogGender);
$stmt->bindValue(':bDogSpayedNeutered', $rbDogSpayedNeutered);
$stmt->bindValue(':bDogMicrochipped', $bDogMicrochipped);
$stmt->bindValue(':bDogFriendlyWithOtherDogs', $bDogFriendlyWithOtherDogs);
$stmt->bindValue(':sDogSpecialRequirements', $sDogSpecialRequirements);
$stmt->bindValue(':sDogVetContact', $sDogVetContact);
$stmt->bindValue(':sDogAbout', $sDogAbout);
$stmt->bindValue(':sDogCareInstructions', $sDogCareInstructions);


$stmt->execute();

if(!$stmt->execute()){
  sendResponse(0, __LINE__, 'dog NOT saved');
}

sendResponse(1, __LINE__, 'dog saved');



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}
