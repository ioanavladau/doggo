<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<?php

require_once __DIR__.'/connect.php';
$stmt = $db->prepare('SELECT * FROM dog_sitters');
$stmt->execute(); //check if it works
$aRows = $stmt->fetchAll();

foreach($aRows as $jRow){
echo "
    <div>
        <p>$jRow->fare</p>
        <p>$jRow->about</p>
    </div>
    ";
}
?>


    <form action="profile.php" method="post" enctype="multipart/form-data">
        <label for="txtiFare">Hourly Fare</label>
        <input type="number" name="txtiDogSitterFare" id="txtiDogSitterFare"><br>
        <label for="txtAbout">About Me</label>
        <input type="text" name="txtDogSitterAbout" id="txtDogSitterAbout"><br>
        <input type="file" name="dogSitterPicturesToUpload" id="dogSitterPicturesToUpload">
        <input type="submit" value="Become a dogsitter!" name="submit">
    </form>



</body>
</html>