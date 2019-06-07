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

            <label for="rbVetStudies">I have studied in vet school*</label>
            <div class="dog-gender">
                <input type="radio" name="rbVetStudies" value="yes" class="radio" <?php if (isset($_POST['rbVetStudies']) && $_POST['rbVetStudies'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
                <input type="radio" name="rbVetStudies" value="no"  class="radio" <?php if (isset($_POST['rbVetStudies']) && $_POST['rbVetStudies'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
            </div>


            <label for="rbOralMedication">I can manage oral medication for dogs*</label>
            <div class="dog-gender">
                <input type="radio" name="rbOralMedication" value="yes" class="radio" <?php if (isset($_POST['rbOralMedication']) && $_POST['rbOralMedication'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
                <input type="radio" name="rbOralMedication" value="no"  class="radio" <?php if (isset($_POST['rbOralMedication']) && $_POST['rbOralMedication'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
            </div>

            <label for="rbVaccinateDogs">I know how to vaccinate dogs*</label>
            <div class="dog-gender">
                <input type="radio" name="rbVaccinateDogs" value="yes" class="radio" <?php if (isset($_POST['rbVaccinateDogs']) && $_POST['rbVaccinateDogs'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
                <input type="radio" name="rbVaccinateDogs" value="no"  class="radio" <?php if (isset($_POST['rbVaccinateDogs']) && $_POST['rbVaccinateDogs'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
            </div>

            <label for="rbTrainingTechniques">I am familiar with dog training techniques*</label>
            <div class="dog-gender">
                <input type="radio" name="rbTrainingTechniques" value="yes" class="radio" <?php if (isset($_POST['rbTrainingTechniques']) && $_POST['rbTrainingTechniques'] == 'Yes'): ?>checked='checked'<?php endif; ?> /> <span>Yes</span>
                <input type="radio" name="rbTrainingTechniques" value="no"  class="radio" <?php if (isset($_POST['rbTrainingTechniques']) && $_POST['rbTrainingTechniques'] ==  'No'): ?>checked='checked'<?php endif; ?> /> No <br>
            </div>

            



            <input type="file" name="dogSitterPicturesToUpload" id="dogSitterPicturesToUpload" class="custom-file-input custom-file-input-one-file">
            <input class="yellow-btn" type="submit" value="Become a dogsitter!" name="submit">
            

            </div>

        </form>
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/become-a-dogsitter.js"></script>';
    require_once 'bottom.php'; ?>