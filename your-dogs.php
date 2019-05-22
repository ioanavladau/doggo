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
      <form id="frmUploadDog" action='upload-dog.php' method="post" enctype="multipart/form-data">
        <label for="txtsDogName">Name</label>
        <input type="text" name="txtDogName" id="txtDogName"><br>
        <label for="txtsDogWeight">Weight (kg)</label>
        <input type="text" name="txtDogWeight" id="txtDogWeight"><br>
        <label for="txtsDogBreed">Breed<br> Write all breeds that apply. If your dog is a mixed breed, add 'mixed' in your description.</label>
        <input type="text" name="txtsDogBreed" id="txtBreed"><br>
        <label for="txtiDogYears">Age (years)</label>
        <input type="number" name="txtiDogYears" id="txtiDogYears"><br>
        <label for="txtiDogMonths">Age (months)</label>
        <input type="number" name="txtiDogMonths" id="txtiDogMonths"><br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female<br>
        <label for="selectBreed">Breed</label>

        <select name="selectBreed">
          <?php
            require_once __DIR__.'/connect.php';
            $stmt = $db->prepare('SELECT name FROM breeds');
            $stmt->execute();
            $aRows = $stmt->fetchAll();

            foreach($aRows as $jRow){
            echo "
                <option value='$jRow->name'>
                  $jRow->name
                </option>
                ";
            }
          ?>
        </select>


        <br><input type="submit" value="Add dog" name="submit">
      </form>   
    </div>
</div>
    