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


    $sLinktoExtraCss = '<link rel="stylesheet" href="css/white-theme.css">';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    require_once 'top-logged-in.php';
    
    
?>