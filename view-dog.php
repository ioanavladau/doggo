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

    $sGreyBodyClass = "class='grey-bg'";
    
    require_once 'connect.php';
    require_once 'top-logged-in.php';
?>

<div class="container contents-centered">   
    <div class="card">
    <form id="frmChangeDog" action="" method="post">
      <div class="dog-profile">
          

          <div class="right-column">
              <div class="about-text">
                <h1 id="dog-name"></h1>
                <h5 id="dog-breed"></h5><br>

                <div class="left-column">
                    <div class="about-photo">
                        <img id="dog-image-preview" alt="">
                    </div>
                    <!-- <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImage()" class="custom-file-input custom-file-input-one-file"> -->
                </div>



                <label for="iDogWeight">Dog weight (kg)</label>
                <p id="txtiDogWeight"></p><br>

                <label for="rbDogSpayedNeutered">Spayed/Neutered</label>
                <div class="dog-gender">
                    <input type="radio" name="rbDogSpayedNeutered" value="yes" class="radio" disabled/> <span>Yes</span>
                    <input type="radio" name="rbDogSpayedNeutered" value="no"  class="radio" disabled/> No <br>
                </div>
                
                <label for="rbDogMicrochipped">Microchipped</label>
                <div class="dog-gender">
                    <input type="radio" name="rbDogMicrochipped" value="yes" class="radio" disabled/> <span>Yes</span>
                    <input type="radio" name="rbDogMicrochipped" value="no"  class="radio" disabled/> No <br>
                </div>
                
                <label for="rbDogFriendlyWithOtherDogs">Friendly With Other Dogs</label>
                <div class="dog-gender">
                    <input type="radio" name="rbDogFriendlyWithOtherDogs" value="yes" class="radio" disabled/> <span>Yes</span>
                    <input type="radio" name="rbDogFriendlyWithOtherDogs" value="no"  class="radio" disabled/> No <br>
                </div>

                <label for="txtsDogSpecialRequirements">Special requirements</label>
                <p id="txtsDogSpecialRequirements"></p><br>
                
                <label for="txtsDogVetContact">Vet contact</label>
                <p id="txtsDogVetContact"></p><br>
                
                <label for="txtsDogAbout">About dog</label>
                <p id="txtsDogAbout"></p><br>

                <label for="txtsDogCareInstructions">Dog care instructions</label>
                <p id="txtsDogCareInstructions"></p><br>

              </div>
          </div>
      </div>

    </form>
    
    </div>
    
</div>

<?php 
    $sLinktoScript = '<script src="js/get-dog-info.js"></script>';
    require_once 'bottom.php'; 
?>