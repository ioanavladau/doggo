<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserEmail = $_SESSION['sEmail'];
    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sGreyBodyClass = "class='grey-bg'";
    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'</script>";
    
    require_once 'top-logged-in.php';

    // GETTING USER ID AND STORING IT IN $userId

    require_once __DIR__.'/connect.php';
    $stmtUserId = $db->prepare("SELECT id FROM users WHERE email = :sUserEmail");
    $stmtUserId->bindValue(':sUserEmail', $sUserEmail);
    $stmtUserId->execute();
    $rowUserId = $stmtUserId->fetch();

    $userId = $rowUserId->id;

    // PROFILE PHOTO UPLOAD FOR USERS

    $target_dir = "images/profile-photo/";
    // $target_dir_dog_sitters = "images/dog-sitter-photos/";

    if(!isset($_FILES["fileToUpload"]["name"])){
      $target_file = '';
    } else {
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }

    // FOR DOGSITTERS
    // if(!isset($_FILES["filesToUpload"]["name"])){
    //   $target_file_dog_sitters = '';
    // } else {
    //   $target_file_dog_sitters = $target_dir_dog_sitters . basename($_FILES["filesToUpload"]["name"]);
    // };
    // $target_file = $target_dir.uniqid();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 9999999999) { // bytes
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }
    // Check if $uploadOk is set to 0 by an error

        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              // echo "The file ". $target_file . " has been uploaded.";
              require_once __DIR__.'/connect.php';
              $stmt = $db->prepare("UPDATE users SET profile_photo_url = :profilePhotoUrl WHERE email = :sUserEmail");
              $stmt->bindValue(':profilePhotoUrl', $target_file);
              $stmt->bindValue(':sUserEmail', $sUserEmail);
              $stmt->execute();
          }
          else {
              echo "Sorry, there was an error uploading your file.";
          }
        }

    }


    
    $stmt = $db->prepare("SELECT profile_photo_url FROM users WHERE email = :sUserEmail");
    $stmt2 = $db->prepare("SELECT is_dog_sitter FROM users WHERE email = :sUserEmail");
    
    $stmt->bindValue(':sUserEmail', $sUserEmail);
    $stmt->execute();
    
    $stmt2->bindValue(':sUserEmail', $sUserEmail);
    $stmt2->execute();

    $row = $stmt->fetch();

    if(!$row->profile_photo_url){
      $sImagePath = 'images/user.png';
    } else {
      $sImagePath = $row->profile_photo_url;
    }

    $row2 = $stmt2->fetch();

    if($row2->is_dog_sitter == 0){
      $hideDogSitterUploadPhotosContainer = "hide";
    }

    include 'upload-dogsitter-photos.php';


    


  
    // // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 9999999999) { // bytes
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }
    // Check if $uploadOk is set to 0 by an error
    
    /********************************/

    function sendResponse($iStatus, $iLine, $sMessage){
      echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
      exit;
  }


?>



<div class="container">
    <h1>Settings page</h1>
    <img id="profile-photo-preview" src=<?php echo $sImagePath ?> style="width: 200px; height: 200px;">

    <form id="frmUploadProfilePhoto" action='settings.php' method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImage()">
      <input type="submit" value="Upload Image" name="submit">
    </form>


      <!-- THIS DIV IS SHOWN ONLY IF THE USER IS A DOGSITTER -->
    <div id="dogsitter-photos" class='<?php echo $hideDogSitterUploadPhotosContainer?>'>
      <form id="frmUploadDogSitterPhotos" action='settings.php' method="post" enctype="multipart/form-data">
        Select dogsitter images to upload:
        <input type="file" name="dogSitterPhotos[]" id="dogSitterPhoto" multiple>
        <input type="submit" value="Upload Images" name="submitDogSitterPhotos">
      </form>
    </div>

</div>



<?php 
  $sLinktoScript = '<script src="js/settings.js"></script>';
  require_once 'bottom.php'; 
?>