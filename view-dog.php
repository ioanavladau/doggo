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
    <div class="card view-dog">
      <div class="dog-profile">
          

          <div class="right-column">
            <div class="about-photo">
                <img id="dog-image-preview" alt="">
            </div>
              <div class="about-text">
                <h1 id="dog-name"></h1>
                <h5 id="dog-breed"></h5><h5 id="dog-weight"></h5><br>
                <div class="extra-info">
                    <h6 id="spayed"></h6>
                    <h6 id="microchipped"></h6>
                    <h6 id="friendly"></h6>
                </div>

                
            </div>
                    <div class="left-column">
                        
                        <!-- <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImage()" class="custom-file-input custom-file-input-one-file"> -->
                    </div>
          </div>

          <div class="right-column-two">
            <!-- <label for="iDogWeight">Dog weight (kg)</label>
            <p id="txtiDogWeight"></p><br> -->

            <!-- <label for="rbDogSpayedNeutered">Spayed/Neutered</label>
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
            </div> -->

            <div class="description-left">
                <h5>Special requirements</h5>
                <p id="txtsDogSpecialRequirements"></p><br>
                
                <h5>Vet contact</h5>
                <p id="txtsDogVetContact"></p><br>
            </div>
            
            <div class="description-right">
                <h5>About dog</h5>
                <p id="txtsDogAbout"></p><br>

                <h5>Dog care instructions</h5>
                <p id="txtsDogCareInstructions"></p><br>
            </div>

          </div>
      </div> <!-- end of dog-profile -->


    
    </div> <!-- end card view-dog -->
    
</div>

<?php 
    $sLinktoScript = '<script src="js/get-dog-info.js"></script>';
    require_once 'bottom.php'; 
?>