<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sEmail'];

    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    // $sGreyBodyClass = "class='grey-bg'";
    $sHeaderLink = "<script> window.sUserEmail = '$sUserId'</script>";

    require_once 'top-logged-in.php';
?>

<div class="container">Hi</div>


<?php 
    $sLinktoScript = '<script src="js/search.js"></script>';
    require_once 'bottom.php'; 
?>