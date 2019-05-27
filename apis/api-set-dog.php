<?php

require_once '../connect.php';

session_start();
$sUserEmail = $_SESSION['sEmail'];


$sDogName = $_POST['txtsDogName'];
if(empty($sDogName)){
  sendResponse(0,__LINE__,"sDogName can't be empty");
}

$iDogWeight = $_POST['txtiDogWeight'];
if(empty($iDogWeight)){
  sendResponse(0,__LINE__,"iDogWeight can't be empty");
}

$iDogYears = $_POST['txtiDogYears'];
if(empty($iDogYears)){
  sendResponse(0,__LINE__,"iDogYears can't be empty");
}

$iDogMonths = $_POST['txtiDogMonths'];
if(empty($iDogMonths)){
  sendResponse(0,__LINE__,"iDogMonths can't be empty");
}

if(!isset($_POST['rbDogGender'])){
  sendResponse(0,__LINE__,"Please select gender");
} else {
    $bDogGender = $_POST['rbDogGender'];
    if($bDogGender == 'female'){
      $bDogGender = 1; 
    } else $bDogGender = 0; 
}



$iDogBreed = $_POST['selDogBreed'];
// if(empty($iDogBreed)){
//   sendResponse(0,__LINE__,"Breed can't be empty");
// }

if(!isset($_POST['rbDogSpayedNeutered'])){
  sendResponse(0,__LINE__,"Please select if dog is spayed/neutered");
} else {
    $rbDogSpayedNeutered = $_POST['rbDogSpayedNeutered'];
    if($rbDogSpayedNeutered == 'yes'){
      $rbDogSpayedNeutered = 1; 
    } else $rbDogSpayedNeutered = 0; 
}

if(!isset($_POST['rbDogMicrochipped'])){
  sendResponse(0,__LINE__,"Please select if dog is microchipped");
} else {
    $bDogMicrochipped = $_POST['rbDogMicrochipped'];
    if($bDogMicrochipped == 'yes'){
      $bDogMicrochipped = 1; 
    } else $bDogMicrochipped = 0; 
}

if(!isset($_POST['rbDogFriendlyWithOtherDogs'])){
  sendResponse(0,__LINE__,"Please select if dog is friendly with other dogs");
} else {
    $bDogFriendlyWithOtherDogs = $_POST['rbDogFriendlyWithOtherDogs'];
    if($bDogFriendlyWithOtherDogs == 'yes'){
      $bDogFriendlyWithOtherDogs = 1; 
    } else $bDogFriendlyWithOtherDogs = 0; 
}

$sDogSpecialRequirements = $_POST['txtsDogSpecialRequirements'] ?? '';
$sDogVetContact = $_POST['txtsDogVetContact'] ?? '';
$sDogAbout = $_POST['txtsDogAbout'] ?? '';
$sDogCareInstructions = $_POST['txtsDogCareInstructions'] ?? '';
// $imgFile = $_FILES['fileToUpload'] ?? '';




if(!isset($_FILES['fileToUpload'])){
  sendResponse(0,__LINE__,"Please select image");
} else {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0; 
        sendResponse(0, __LINE__, "file not an image");
    }
}


// DOG PHOTO UPLOAD
$target_dir = "../images/dog-photo/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
// if($check !== false) {
//     // echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
// } else {
//     // echo "File is not an image.";
//     $uploadOk = 0;
// }
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    // sendResponse(0, __LINE__, 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    sendResponse(0, __LINE__, 'Sorry, your file was not uploaded.');
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
        $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
        if($result == 1){
          // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $stmt = $db->prepare( "INSERT INTO dogs (id, user_fk, name, weight, breed_fk, age_years, age_months,  gender , image_url,  spayed_neutered ,  microchipped ,  friendly ,  special_requirements ,vet_contact ,about , care_instructions) 
          VALUES (NULL, (SELECT id FROM users WHERE email = :sEmail), :sDogName, :iDogWeight, :iDogBreed, :iDogYears, :iDogMonths, :bDogGender, :sImageUrl, :bDogSpayedNeutered, :bDogMicrochipped, :bDogFriendlyWithOtherDogs, :sDogSpecialRequirements, :sDogVetContact, :sDogAbout, :sDogCareInstructions)" );
          
          $stmt->bindValue(':sEmail', $sUserEmail);
          $stmt->bindValue(':sDogName', $sDogName);
          $stmt->bindValue(':iDogWeight', $iDogWeight);
          $stmt->bindValue(':iDogBreed', $iDogBreed);
          $stmt->bindValue(':iDogYears', $iDogYears);
          $stmt->bindValue(':iDogMonths', $iDogMonths);
          $stmt->bindValue(':bDogGender', $bDogGender);
          $stmt->bindValue(':sImageUrl', $target_dir . $_FILES["fileToUpload"]["name"]);
          $stmt->bindValue(':bDogSpayedNeutered', $rbDogSpayedNeutered);
          $stmt->bindValue(':bDogMicrochipped', $bDogMicrochipped);
          $stmt->bindValue(':bDogFriendlyWithOtherDogs', $bDogFriendlyWithOtherDogs);
          $stmt->bindValue(':sDogSpecialRequirements', $sDogSpecialRequirements);
          $stmt->bindValue(':sDogVetContact', $sDogVetContact);
          $stmt->bindValue(':sDogAbout', $sDogAbout);
          $stmt->bindValue(':sDogCareInstructions', $sDogCareInstructions);

          
          $stmt->execute();
          header("Location: ../profile");
          sendResponse(1, __LINE__, 'dog saved');
          exit;
          
        }
        else{
          header("Location: ../profile");
          sendResponse(0, __LINE__, 'error uploading photo');
          exit;
        }
       
    }



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}
