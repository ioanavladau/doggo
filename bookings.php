<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sEmail'];

    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    $sBookingsLink = 'bookings';
    $sGreyBodyClass = "class='grey-bg'";
    // $sHeaderLink = "<script> window.sUserEmail = '$sUserId'; window.sDogSitterId = '$sDogSitterId'; window.sTimeInterval = '$sSearchTimeInterval'; window.sSearchDate = '$sSearchDate'</script>";
    // $sHeaderLinkTwo = "<script> </script>";
    require_once 'top-logged-in.php';
?>

<div class="container contents-centered">
    <div class="card card-with-a-title width-100">
        <div class="card-title">
            Bookings
        </div>
    </div>
    
</div>


<?php 
    $sLinktoScript = '<script src="js/book-dogsitter.js"></script>';
    require_once 'bottom.php'; 
?>