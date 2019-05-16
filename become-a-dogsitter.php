<?php 
    $sGreyBodyClass = "class='grey-bg'";
    require_once 'top.php';
?>
    
<?php

    // require_once __DIR__.'/connect.php';
    // $stmt = $db->prepare('SELECT * FROM dog_sitters');
    // $stmt->execute(); //check if it works
    // $aRows = $stmt->fetchAll();

    // foreach($aRows as $jRow){
    // echo "
    //     <div>
    //         <p>$jRow->fare</p>
    //         <p>$jRow->about</p>
    //     </div>
    //     ";
    // }
?>


    <form action="apis/api-set-dog-sitter" method="post" enctype="multipart/form-data">
        <label for="txtiFare">Hourly Fare</label>
        <input type="number" name="txtiDogSitterFare" id="txtiDogSitterFare"><br>
        <label for="txtAbout">About Me</label>
        <input type="text" name="txtDogSitterAbout" id="txtDogSitterAbout"><br>
        <input type="file" name="dogSitterPicturesToUpload" id="dogSitterPicturesToUpload">
        <input type="submit" value="Become a dogsitter!" name="submit">
    </form>



<?php 
    $sLinktoScript = '<script src="js/become-a-dogsitter.js"></script>';
    require_once 'bottom.php'; ?>