<?php 
    $sGreyBodyClass = "class='grey-bg'";
    
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }
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

<div class="container contents-centered">
    <div class="card card-with-a-title ">
        <div class="card-title">
            Become a dogsitter
        </div>
        <form id="frmBecomeDogsitter" enctype="multipart/form-data">
            <div>
                <label for="txtiFare">Hourly Fare</label>
                <input type="number" name="txtiFareDogSitter" id="txtiFareDogSitter"><br>
            </div>

            <div>
                <label for="txtAbout">About Me</label>
                <textarea name="txtsAboutDogSitter" id="txtsAboutDogSitter"></textarea><br>
            </div>
            <input type="file" name="dogSitterPicturesToUpload" id="dogSitterPicturesToUpload" class="custom-file-input custom-file-input-one-file">
            <input class="yellow-btn" type="submit" value="Become a dogsitter!" name="submit">
            
        </form>
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/become-a-dogsitter.js"></script>';
    require_once 'bottom.php'; ?>