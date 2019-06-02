<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserEmail = $_SESSION['sEmail'];

    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'</script>";
    
    $sGreyBodyClass = "class='grey-bg'";
    require_once 'top-logged-in.php';
?>

<div class="container contents-centered">

    <div class="card card-with-a-title ">
            <div class="card-title">
            Add your pet
            </div>
      <!-- <form id="frmAddDog" method="post" action="apis/api-set-dog.php" enctype="multipart/form-data">
        <label for="txtsDogName">Name</label>
        <input type="text" name="txtsDogName" id="txtsDogName"><br>

        <label for="txtiDogWeight">Weight (kg)</label>
        <input type="text" name="txtiDogWeight" id="txtiDogWeight"><br>
         <label for="txtsDogBreed">Breed<br> Write all breeds that apply. If your dog is a mixed breed, add 'mixed' in your description.</label>
        <input type="text" name="txtsDogBreed" id="txtBreed"><br>
        <label for="txtiDogYears">Age (years)</label>
        <input type="number" name="txtiDogYears" id="txtiDogYears" ><br>
        
        <label for="txtiDogMonths">Age (months)</label>
        <input type="number" name="txtiDogMonths" id="txtiDogMonths"><br> -->
      <form id="frmAddDog" method="post" enctype="multipart/form-data">
        <label for="txtsDogName">Name*</label>
        <input type="text" name="txtsDogName" id="txtsDogName"><br>

        <label for="txtiDogWeight">Weight* (kg)</label>
        <input type="number" name="txtiDogWeight" id="txtiDogWeight"><br>
        <!-- <label for="txtsDogBreed">Breed<br> Write all breeds that apply. If your dog is a mixed breed, add 'mixed' in your description.</label>
        <input type="text" name="txtsDogBreed" id="txtBreed"><br> -->
        <label for="txtiDogYears">Age* (years)</label>
        <input type="number" name="txtiDogYears" id="txtiDogYears"><br>
        
        <label for="txtiDogMonths">Age* (months)</label>
        <input type="number" name="txtiDogMonths" id="txtiDogMonths"><br>

        <label for="rbDogGender">Gender*</label>
        <div class="dog-gender">
          <input type="radio" name="rbDogGender" value="female" class="radio" <?php if (isset($_POST['rbDogGender']) && $_POST['rbDogGender'] == 'female'): ?>checked='checked'<?php endif; ?> /> <span>Female</span>
          <input type="radio" name="rbDogGender" value="male"  class="radio" <?php if (isset($_POST['rbDogGender']) && $_POST['rbDogGender'] ==  'male'): ?>checked='checked'<?php endif; ?> />  Male <br>
        </div>

        <label for="selDogBreed">Breed*</label><br>
        <select name="selDogBreed" id="selDogBreed">
          <?php
            require_once __DIR__.'/connect.php';
            $stmt = $db->prepare('SELECT name FROM breeds');
            $stmt->execute();
            $aRows = $stmt->fetchAll();
            $i=0;
            foreach($aRows as $jRow){
              $i++;
              echo "
                  <option value='$i'>
                    $jRow->name
                  </option>
                  ";
            }
          ?>
        </select><br>
        
        <div class="dog-photo-container">
          <label for="fileToUpload">Upload a photo of your dog*</label><br>
          <img id="dog-image-preview" class="small-photo"><br>
          <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImage()" class="custom-file-input custom-file-input-one-file">
        </div>

        <label for="rbDogSpayedNeutered">Spayed/Neutered*</label>
        <div class="dog-gender">
          <input type="radio" name="rbDogSpayedNeutered" value="yes" class="radio" <?php if (isset($_POST['rbDogSpayedNeutered']) && $_POST['rbDogSpayedNeutered'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
          <input type="radio" name="rbDogSpayedNeutered" value="no"  class="radio" <?php if (isset($_POST['rbDogSpayedNeutered']) && $_POST['rbDogSpayedNeutered'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        </div>

        <label for="rbDogMicrochipped">Microchipped*</label>
        <div class="dog-gender">
          <input type="radio" name="rbDogMicrochipped" value="yes" class="radio" <?php if (isset($_POST['rbDogMicrochipped']) && $_POST['rbDogMicrochipped'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
          <input type="radio" name="rbDogMicrochipped" value="no"  class="radio" <?php if (isset($_POST['rbDogMicrochipped']) && $_POST['rbDogMicrochipped'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        </div>

        <label for="rbDogFriendlyWithOtherDogs">Friendly With Other Dogs*</label>
        <div class="dog-gender">
          <input type="radio" name="rbDogFriendlyWithOtherDogs" value="yes" class="radio" <?php if (isset($_POST['rbDogFriendlyWithOtherDogs']) && $_POST['rbDogFriendlyWithOtherDogs'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
          <input type="radio" name="rbDogFriendlyWithOtherDogs" value="no"  class="radio" <?php if (isset($_POST['rbDogFriendlyWithOtherDogs']) && $_POST['rbDogFriendlyWithOtherDogs'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        </div>

        <label for="txtsDogSpecialRequirements">Special requirements</label>
        <input type="text" name="txtsDogSpecialRequirements" id="txtsDogSpecialRequirements"><br>
        
        <label for="txtsDogVetContact">Vet contact*</label>
        <input type="text" name="txtsDogVetContact" id="txtsDogVetContact"><br>
        
        <label for="txtsDogAbout">About my dog*</label>
        <input type="text" name="txtsDogAbout" id="txtsDogAbout"><br>

        <label for="txtsDogCareInstructions">Dog care instructions</label>
        <input type="text" name="txtsDogCareInstructions" id="txtsDogCareInstructions"><br>



        <br><input class="yellow-btn" type="submit" value="Add dog" name="submit">
      </form>   
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/set-dog.js"></script>';
    require_once 'bottom.php'; 
?>
    