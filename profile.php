<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserEmail = $_SESSION['sEmail'];
    

    // Check if the client is active
    // if($jClient->active == false){
    //     unset($_SESSION['sEmail']);
    //     session_destroy();

    //     header("Location: login");
    //     exit;
    // }


    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    $sGreyBodyClass = "class='grey-bg'";
<<<<<<< HEAD
    $sHeaderLink = "<script> window.sUserEmail = '$sUserId'</script>";

    
    require_once 'top-logged-in.php';
?>
<div class="container three-grid">
=======
    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'; </script>";
    require_once 'top-logged-in.php';
?>



<div class="container contents-centered">
>>>>>>> ccf35fdaece67634cace9b8712ad92392fead81e
        <div class="card ">
            <p id="is-dog-sitter">
                <?php
                    require_once __DIR__.'/apis/connect.php';
                    $stmt = $db->prepare("SELECT * FROM users WHERE email = :sUserEmail AND is_dog_sitter = 1"); 
                    $stmt->bindValue(':sUserEmail', $sUserEmail);
                    $stmt->execute();
                    $aRows = $stmt->fetchAll();
                    
                    if ($aRows == []){
                        // sendResponse(-1, __LINE__, "User is not a dogsitter");
                        // exit;

                        echo 'not a dogsitter';
                    }
                    
                    foreach( $aRows as $aRow ){
                        $sUserId = $aRow->id;
                        // echo $sUserId;
                        echo "$sUserEmail with sUserId $sUserId is a dog sitter";
                    }
                    
                    /********************************/
                    
                    function sendResponse($iStatus, $iLine, $sMessage){
                        echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
                        exit;
                    }
                ?>
            </p>


            <input type="text" name="daterange" id="availability" value="01/01/2018 - 01/15/2018" />
            <div class="available-times">
                <div class="available-time first-time-span" id="morning">6:00-11:00</div>
                <div class="available-time second-time-span" id="noon">11:00-15:00</div>
                <div class="available-time third-time-span" id="evening">15:00-20:00</div>
            </div>

                <button class="yellow-btn" id="add-availability">Add availability</button>

        </div>
        <div class="card">
            <div class="availability">Hi</div>
        </div>
</div>


<?php 
$sLinktoScript = '<script src="js/profile.js"></script>';
require_once 'bottom.php'; 
?>