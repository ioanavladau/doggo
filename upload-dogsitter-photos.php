<?php

require_once __DIR__.'/connect.php';

$dogSitterPicturesUploaded = isset($_FILES['dogSitterPhotos']) ? true : false;

  if($dogSitterPicturesUploaded){
    foreach ($_FILES['dogSitterPhotos']['name'] as $key => $name){
      $newFilename = $_FILES['dogSitterPhotos']['name'][$key];
      $target_file = 'images/dog-sitter-photos/' . basename($newFilename);
      move_uploaded_file($_FILES['dogSitterPhotos']['name'][$key], $target_file);
      // $image = '../img/' . $newFilename;

      $stmt = $db->prepare('INSERT INTO dog_sitters_photos(user_fk, url) VALUES (:userId, :newFileName)');
      // $stmt->bindValue(':profilePhotoUrl', $target_file);
      $stmt->bindValue(':newFileName', $newFilename);
      $stmt->bindValue(':userId', $userId);
      $stmt->execute();
    }
  }
    
?>