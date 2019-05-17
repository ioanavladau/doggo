<?php 
    $sGreyBodyClass = "class='grey-bg'";
    
    session_start();
    $sUserEmail = $_SESSION['sEmail'];
    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'; </script>";
    
    require_once 'top-logged-in.php';
    // $sUserEmail = $_SESSION['sEmail'];

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

<div class="container">
<div class="card">
    <form id="frmBecomeDogsitter" enctype="multipart/form-data">
        <label for="txtiFare">Hourly Fare</label>
        <input type="number" name="txtiFareDogSitter" id="txtiFareDogSitter"><br>
        <label for="txtAbout">About Me</label>
        <textarea name="txtsAboutDogSitter" id="txtsAboutDogSitter"></textarea><br>
        <input type="file" name="dogSitterPicturesToUpload" id="dogSitterPicturesToUpload">
        <input type="submit" value="Become a dogsitter!" name="submit">
        
    </form>
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/become-a-dogsitter.js"></script>';
    require_once 'bottom.php'; ?>