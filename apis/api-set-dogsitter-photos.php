<?php

require_once '../connect.php';
session_start();
$sUserEmail = $_SESSION['sEmail'];


// $dogSitterPicturesUploaded = isset($_FILES['dogSitterPhotos']) ? true : false;
// echo $dogSitterPicturesUploaded;

// $target_dir_dog_sitters = "images/dog-sitter-photos/";

  // DOG SITTERS PHOTOS UPLOAD FOR DOG SITTERS

    // foreach ($_FILES['dogSitterPhotos']['name'] as $key => $name){
    //   $newFilename = $_FILES['dogSitterPhotos']['name'][$key];
    //   $target_file = 'images/dog-sitter-photos/' . $newFilename;
    //   move_uploaded_file($_FILES['dogSitterPhotos']['name'][$key], $target_file);
    //   // $image = '../img/' . $newFilename;
    //   if(move_uploaded_file($_FILES['dogSitterPhotos']['name'][$key], $target_file)){
    //     $stmt = $db->prepare('INSERT INTO dog_sitters_photos(user_fk, url) VALUES (:userId, :newFileName)');
    //     // $stmt->bindValue(':profilePhotoUrl', $target_file);
    //     $stmt->bindValue(':newFileName', $newFilename);
    //     $stmt->bindValue(':userId', $userId);
    //     $stmt->execute();
    //   }
    // }

    if (isset($_FILES['dogSitterPhotos'])) {
      foreach ($_FILES['dogSitterPhotos']['name'] as $key => $name){
          $allowedExts = array("gif", "jpeg", "jpg", "png");
          $temp = explode(".", $_FILES["dogSitterPhotos"]["name"][$key]);
          $extension = end($temp);
          if ((($_FILES["dogSitterPhotos"]["type"][$key] == "image/gif")
                  || ($_FILES["dogSitterPhotos"]["type"][$key] == "image/jpeg")
                  || ($_FILES["dogSitterPhotos"]["type"][$key] == "image/jpg")
                  || ($_FILES["dogSitterPhotos"]["type"][$key] == "image/pjpeg")
                  || ($_FILES["dogSitterPhotos"]["type"][$key] == "image/x-png")
                  || ($_FILES["dogSitterPhotos"]["type"][$key] == "image/png"))
              && ($_FILES["dogSitterPhotos"]["type"][$key] < 500000)
              && in_array($extension, $allowedExts)
          ) {
              if ($_FILES["dogSitterPhotos"]["error"][$key] > 0) {
                  echo "Return Code: " . $_FILES["dogSitterPhotos"]["error"][$key] . "<br>";
              } else {
                $tmp = explode(".", $_FILES["dogSitterPhotos"]["name"][$key]);
                $ext = end($tmp);
                $filename = current(explode(".", $_FILES["dogSitterPhotos"]["name"][$key]));
                $newname = $filename . '.' . $ext;
                move_uploaded_file($_FILES["dogSitterPhotos"]["tmp_name"][$key],
                    "../images/dog-sitter-photos/" . $newname);
                  // move_uploaded_file($_FILES["dogSitterPhotos"]["tmp_name"][$key],
                  //     "images/dog-sitter-photos/" . $newname);

                      $stmt = $db->prepare('INSERT IGNORE INTO dog_sitters_photos(user_fk, url) VALUES ((SELECT id FROM users WHERE email=:sUserEmail), :newFileName)');
                          // $stmt->bindValue(':profilePhotoUrl', $target_file);
                      $stmt->bindValue(':newFileName', $newname);
                      $stmt->bindValue(':sUserEmail', $sUserEmail);
                      $stmt->execute();
                      sendResponse(1, __LINE__, "photos saved to db");
              }
          } else {
              // echo "<div class='alert alert-success'>Image type or size is not valid.</div>";
              sendResponse(0, __LINE__, 'image type or size is not valid');
          }

        }
  }
    

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
  echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
  exit;
}