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
    // $sHeaderLink = "<script> window.sUserEmail = '$sUserId'</script>";

    require_once 'top-logged-in.php';

    require_once 'connect.php';
    $sDogSitterId = $_GET['id'] ?? '';

    $stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address FROM users WHERE id=:sDogSitterId' );
    $stmt->bindValue(':sDogSitterId', $sDogSitterId);
    $stmt->execute();
    $aRows = $stmt->fetchAll();

    foreach( $aRows as $aRow ){
        $sEmail = $aRow->email;
        $sFullName = $aRow->first_name.' '.$aRow->last_name;
        $sPhotoUrl = $aRow->profile_photo_url;
    }

    $stmttwo = $db->prepare( 'SELECT fare, about FROM dog_sitters INNER JOIN users ON users.id = dog_sitters.user_fk WHERE user_fk=:sDogSitterId' );
    $stmttwo->bindValue(':sDogSitterId', $sDogSitterId);
    $stmttwo->execute();
    $aRowsTwo = $stmttwo->fetchAll();

    foreach( $aRowsTwo as $aRow ){
        $sFare = $aRow->fare;
        $sAbout = $aRow->about;
    }

?>

<div class="container">
    <div class="about-header">
        <div class="about-photo">
            <img src="<?= $sPhotoUrl ?>" alt="">
        </div>
        <div class="about-text">
            <h1><?= $sFullName ?></h1>
            <p><?= $sAbout ?></p>
        </div>
    </div>
    <div class="services">
        <span>Dog walking</span>
        <span>DKK <?= $sFare ?></span>
    </div>
    <div class="availability">
        
    </div>
    
    
    
    
    
</div>


<?php 
    $sLinktoScript = '<script src="js/search.js"></script>';
    require_once 'bottom.php'; 
?>