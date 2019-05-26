<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserEmail = $_SESSION['sEmail'];

    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';

    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'</script>";

    // $sGreyBodyClass = "class='grey-bg'";
    
    require_once 'connect.php';
    require_once 'top-logged-in.php';
?>

<div class="container">   
    
    <div class="dog-profile">
        <div class="left-column">
            <div class="about-photo">
                <img id="dog-image-preview" alt="">
            </div>
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImage()">
        </div>

        <div class="right-column">
            <div class="about-text">
              <h1 id="dog-name"></h1>
              <p id="dog-breed"></p><br>
              <label for="iDogWeight">Dog Weight</label>
              <input type="number" name="txtiDogWeight"><br>

              <label for="rbDogSpayedNeutered">Spayed/Neutered</label>
              <input type="radio" name="rbDogSpayedNeutered" value="yes" class="radio" /> Yes
              <input type="radio" name="rbDogSpayedNeutered" value="no"  class="radio" /> No <br>
              
              <label for="rbDogMicrochipped">Microchipped</label>
              <input type="radio" name="rbDogMicrochipped" value="yes" class="radio" /> Yes
              <input type="radio" name="rbDogMicrochipped" value="no"  class="radio" /> No <br>
              
              <label for="rbDogFriendlyWithOtherDogs">Friendly With Other Dogs</label>
              <input type="radio" name="rbDogFriendlyWithOtherDogs" value="yes" class="radio" /> Yes
              <input type="radio" name="rbDogFriendlyWithOtherDogs" value="no"  class="radio" /> No <br>
              
              <label for="txtsDogSpecialRequirements">Special requirements</label>
              <input type="text" name="txtsDogSpecialRequirements" id="txtsDogSpecialRequirements"><br>
              
              <label for="txtsDogVetContact">Vet contact</label>
              <input type="text" name="txtsDogVetContact" id="txtsDogVetContact"><br>
              
              <label for="txtsDogAbout">About my dog</label>
              <input type="text" name="txtsDogAbout" id="txtsDogAbout"><br>

              <label for="txtsDogCareInstructions">Dog care instructions</label>
              <input type="text" name="txtsDogCareInstructions" id="txtsDogCareInstructions"><br>
                  
            </div>
        </div>
    </div>
    
    
    
    
</div>

<?php 
    $sLinktoScript = '<script src="js/show-dog-info.js"></script>';
    require_once 'bottom.php'; 
?>