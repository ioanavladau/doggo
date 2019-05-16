<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sEmail'];

    

    // Check if the client is active
    // if($jClient->active == false){
    //     unset($_SESSION['sEmail']);
    //     session_destroy();

    //     header("Location: login");
    //     exit;
    // }


    $sLinktoExtraCss = '<link rel="stylesheet" href="css/white-theme.css"><link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    $sGreyBodyClass = "class='grey-bg'";
    require_once 'top-logged-in.php';
?>
<div class="container contents-centered">
        <div class="card ">
            <input type="text" name="daterange" id="availability" value="01/01/2018 - 01/15/2018" />
            <div class="available-times">
                <div class="available-time" id="morning">6:00-11:00</div>
                <div class="available-time" id="noon">11:00-15:00</div>
                <div class="available-time" id="evening">15:00-20:00</div>
            </div>

                <button class="yellow-btn" id="add-availability">Add availability</button>

        </div>
</div>


<?php 
$sLinktoScript = '<script src="js/profile.js"></script>';
require_once 'bottom.php'; ?>