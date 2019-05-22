<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sEmail'];
    
    $sDogSitterId = $_GET['sDogSitterId'] ?? '';
    $sSearchDate = $_GET['sSearchDate'] ?? '';
    $sSearchTimeInterval = $_GET['sSearchTimeInterval'] ?? '';

    

    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    $sBookingsLink = 'bookings';
    $sGreyBodyClass = "class='grey-bg'";
    $sHeaderLink = "<script> window.sUserEmail = '$sUserId'; window.sDogSitterId = '$sDogSitterId'; window.sTimeInterval = '$sSearchTimeInterval'; window.sSearchDate = '$sSearchDate'</script>";
    // $sHeaderLinkTwo = "<script> </script>";
    require_once 'top-logged-in.php';

    


    $sDateNormalized =  date("d/m/Y", substr($sSearchDate, 0, 10));
    if($sSearchTimeInterval=='morning'){
        $sTimePeriod = '06:00-11:00';
    }else if($sSearchTimeInterval=='noon'){
        $sTimePeriod = '11:00-15:00';
    }else if($sSearchTimeInterval=='evening'){
        $sTimePeriod = '15:00-22:00';
    }

    require_once 'connect.php';
    $stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address FROM users WHERE id=:sDogSitterId' );
    $stmt->bindValue(':sDogSitterId', $sDogSitterId);
    $stmt->execute();
    $aRows = $stmt->fetchAll();

    foreach( $aRows as $aRow ){
        // echo $aRow->email;
        $sEmail = $aRow->email;
        $sFirstNameDogSitter = $aRow->first_name;
    }


    
?>
    <div class="container contents-centered">
        <div class="card">
            <h1>Contact <?= $sFirstNameDogSitter ?> for <?= $sDateNormalized ?>, <?= $sTimePeriod ?></h1>
            <label for="message">Write a message for the dog sitter:</label>
            <form id="frmBookDogsitter">
                <textarea name="message" id="booking-message" cols="30" rows="10"></textarea>
                <button type="submit" class="yellow-btn" id="book-btn">Book</button>
            </form>
        </div>
    </div>

<?php 
    $sLinktoScript = '<script src="js/book-dogsitter.js"></script>';
    require_once 'bottom.php'; 
?>