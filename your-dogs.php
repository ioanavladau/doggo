<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserEmail = $_SESSION['sEmail'];

    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'</script>";
    
    require_once 'top-logged-in.php';
?>

<div class="container">
    <h1>Your pets</h1>

    <div>
      <form id="frmAddDog" action="apis/api-set-dog.php" method="post" enctype="multipart/form-data">
        <label for="txtsDogName">Name</label>
        <input type="text" name="txtsDogName" id="txtsDogName"><br>

        <label for="txtiDogWeight">Weight (kg)</label>
        <input type="text" name="txtiDogWeight" id="txtiDogWeight"><br>
        <!-- <label for="txtsDogBreed">Breed<br> Write all breeds that apply. If your dog is a mixed breed, add 'mixed' in your description.</label>
        <input type="text" name="txtsDogBreed" id="txtBreed"><br> -->
        <label for="txtiDogYears">Age (years)</label>
        <input type="number" name="txtiDogYears" id="txtiDogYears"><br>
        
        <label for="txtiDogMonths">Age (months)</label>
        <input type="number" name="txtiDogMonths" id="txtiDogMonths"><br>

        <label for="rbDogGender">Gender</label>
        <input type="radio" name="rbDogGender" value="female" class="radio" <?php if (isset($_POST['rbDogGender']) && $_POST['rbDogGender'] == 'female'): ?>checked='checked'<?php endif; ?> /> Female
        <input type="radio" name="rbDogGender" value="male"  class="radio" <?php if (isset($_POST['rbDogGender']) && $_POST['rbDogGender'] ==  'male'): ?>checked='checked'<?php endif; ?> />  Male <br>
        
        <label for="txtsDogBreed">Breed</label>
        <select name="txtsDogBreed" id="txtsDogBreed">
          <?php
            require_once __DIR__.'/connect.php';
            $stmt = $db->prepare('SELECT name FROM breeds');
            $stmt->execute();
            $aRows = $stmt->fetchAll();
            $i=0;
            foreach($aRows as $jRow){
             $i2 = $i++;
            echo "
                <option value='$i2'>
                  $jRow->name
                </option>
                ";
            }
          ?>
        </select><br>

        <label for="rbDogSpayedNeutered">Spayed/Neutered</label>
        <input type="radio" name="rbDogSpayedNeutered" value="yes" class="radio" <?php if (isset($_POST['rbDogSpayedNeutered']) && $_POST['rbDogSpayedNeutered'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> Yes
        <input type="radio" name="rbDogSpayedNeutered" value="no"  class="radio" <?php if (isset($_POST['rbDogSpayedNeutered']) && $_POST['rbDogSpayedNeutered'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        
        <label for="rbDogMicrochipped">Microchipped</label>
        <input type="radio" name="rbDogMicrochipped" value="yes" class="radio" <?php if (isset($_POST['rbDogMicrochipped']) && $_POST['rbDogMicrochipped'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> Yes
        <input type="radio" name="rbDogMicrochipped" value="no"  class="radio" <?php if (isset($_POST['rbDogMicrochipped']) && $_POST['rbDogMicrochipped'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        
        <label for="rbDogFriendlyWithOtherDogs">Friendly With Other Dogs</label>
        <input type="radio" name="rbDogFriendlyWithOtherDogs" value="yes" class="radio" <?php if (isset($_POST['rbDogFriendlyWithOtherDogs']) && $_POST['rbDogFriendlyWithOtherDogs'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> Yes
        <input type="radio" name="rbDogFriendlyWithOtherDogs" value="no"  class="radio" <?php if (isset($_POST['rbDogFriendlyWithOtherDogs']) && $_POST['rbDogFriendlyWithOtherDogs'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
        
        <label for="txtsDogSpecialRequirements">Special requirements</label>
        <input type="text" name="txtsDogSpecialRequirements" id="txtsDogSpecialRequirements"><br>
        
        <label for="txtsDogVetContact">Vet contact</label>
        <input type="text" name="txtsDogVetContact" id="txtsDogVetContact"><br>
        
        <label for="txtsDogAbout">About my dog</label>
        <input type="text" name="txtsDogAbout" id="txtsDogAbout"><br>

        <label for="txtsDogCareInstructions">Dog care instructions</label>
        <input type="text" name="txtsDogCareInstructions" id="txtsDogCareInstructions"><br>



        <br><input type="submit" value="Add dog" name="submit">
      </form>   
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/add-dog.js"></script>';
    require_once 'bottom.php'; 
?>
    