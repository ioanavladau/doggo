<?php
    session_start();
    if( !isset($_SESSION['sUserId']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sUserId'];

    

    // Check if the client is active
    // if($jClient->active == false){
    //     unset($_SESSION['sUserId']);
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
            <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
        </div>
</div>


<?php 
$sLinktoScript = '<script src="js/profile.js"></script>';
require_once 'bottom.php'; ?>