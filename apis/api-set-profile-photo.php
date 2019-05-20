<?php 
  $target_dir = "../images/profile-photo/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  // $target_file = $target_dir.uniqid();
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          sendResponse(0, __LINE__, 'File is an image: '. $check["mime"]);
          $uploadOk = 1;
      } else {
          sendResponse(0, __LINE__, 'File is NOT an image');
          $uploadOk = 0;
      }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      sendResponse(0, __LINE__, 'Sorry, file already exists');
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 9999999999) { // bytes
      sendResponse(0, __LINE__, 'Sorry, file too large');
      $uploadOk = 0;
  }
  // Allow certain file formats
  // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  // && $imageFileType != "gif" ) {
  //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //     $uploadOk = 0;
  // }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    sendResponse(0, __LINE__, 'Sorry, your file has not been uploaded');
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". $target_file . " has been uploaded.";
          require_once '../connect.php';
          $stmt = $db->prepare("UPDATE users SET profile_photo_url = :profilePhotoUrl WHERE email = :sUserEmail");
          
          $stmt->bindValue(':profilePhotoUrl', $target_file);
          $stmt->bindValue(':sUserEmail', $sUserEmail);
          $stmt->execute();
          sendResponse(1, __LINE__, 'Profile photo has been uploaded');
      } else {
        sendResponse(0, __LINE__, 'There was an error uploading your file');          
      }
  }




  /********************************/

  function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    // exit;
  }

?>



