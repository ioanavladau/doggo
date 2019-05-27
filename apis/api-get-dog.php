<?php

// ini_set('display_errors',0);

require_once '../connect.php';

session_start();
$sUserEmail = $_SESSION['sEmail'];

$stmt = $db->prepare('SELECT dogs.name, dogs.gender, dogs.image_url, breeds.name AS breed FROM dogs JOIN breeds ON dogs.breed_fk = breeds.id WHERE user_fk=(SELECT id FROM users WHERE email=:sUserEmail)');
$stmt->bindValue(':sUserEmail', $sUserEmail);
$stmt->execute();

$showAddDog = true;

$aRows = $stmt->fetchAll();
if(sizeof($aRows)==1){
  $showAddDog == false;
}

foreach($aRows as $aRow){
  $dog = "<div class='white-card'><div class='photo'><img src='$aRow->image_url'></div><div class='about'><h1>$aRow->name</h1><h5>$aRow->breed</h5></div><div class='side-btns'><button class='yellow-btn' id='edit-dog-btn'>Edit</button><button class='yellow-btn' id='view-dog-btn'>View</button></div></div>";
}

if($aRows == []){
  $dog = "<div class='card' id='add-a-dog-container'><a class='yellow-btn' href='your-dogs'>Add a pet</a><div></div></div>";
}



// if(!$stmt->execute()){
//   sendResponse(0, __LINE__, "dogs cannot be shown");
// }

sendResponse(1, __LINE__, $dog, $showAddDog);



/********************************/

function sendResponse($iStatus, $iLine, $sMessage, $bShowAddDogContainer){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'", "showAddDogContainer": "'.$bShowAddDogContainer.'"}';
    exit;
}