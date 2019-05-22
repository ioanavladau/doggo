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
    

    require_once 'connect.php';
    $sDogSitterId = $_GET['id'] ?? '';
    $sSearchDate = $_GET['sSearchDate'] ?? '';
    $sSearchTimeInterval = $_GET['sSearchTimeInterval'] ?? '';
    

    $stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address FROM users WHERE id=:sDogSitterId' );
    $stmt->bindValue(':sDogSitterId', $sDogSitterId);
    $stmt->execute();
    $aRows = $stmt->fetchAll();

    foreach( $aRows as $aRow ){
        $sEmail = $aRow->email;
        $sFirstName = $aRow->first_name;
        $sFullName = $aRow->first_name.' '.$aRow->last_name;
        $sPhotoUrl = $aRow->profile_photo_url;
    }

    $sHeaderLink = "<script> window.sHeaderDogSitterEmail = '$sEmail'</script>";
    require_once 'top-logged-in.php';

    $stmttwo = $db->prepare( 'SELECT fare, about FROM dog_sitters INNER JOIN users ON users.id = dog_sitters.user_fk WHERE user_fk=:sDogSitterId' );
    $stmttwo->bindValue(':sDogSitterId', $sDogSitterId);
    $stmttwo->execute();
    $aRowsTwo = $stmttwo->fetchAll();

    foreach( $aRowsTwo as $aRow ){
        $sFare = $aRow->fare;
        $sAbout = $aRow->about;
    }

    $sDateNormalized =  date("d/m/Y", substr($sSearchDate, 0, 10));
    if($sSearchTimeInterval=='morning'){
        $sTimePeriod = '06:00-11:00';
    }else if($sSearchTimeInterval=='noon'){
        $sTimePeriod = '11:00-15:00';
    }else if($sSearchTimeInterval=='evening'){
        $sTimePeriod = '15:00-22:00';
    }
    

?>

<div class="container">   
    
    <div class="dog-sitter-profile">
        <div class="left-column">
            <div class="about-photo">
                <img src="<?= $sPhotoUrl ?>" alt="">
            </div>

            <div class="services">
                <span>Dog walking</span>
                <span>DKK <?= $sFare ?></span>
            </div>

            <div class="availability-calendar">
                <div id='calendar'></div>
            </div>
        </div>

        <div class="right-column">
            <div class="about-text">
                <h1><?= $sFullName ?></h1>
                <p><?= $sAbout ?></p>
                <button class="yellow-btn" id="contact-dog-sitter" onclick="location.href='book-dogsitter.php?sDogSitterId=<?= $sDogSitterId ?>&sSearchDate=<?= $sSearchDate ?>&sSearchTimeInterval=<?= $sSearchTimeInterval ?>';">Contact <?= $sFirstName ?> for <?= $sDateNormalized ?>, <?= $sTimePeriod ?></button>
            </div>
        </div>
    </div>
    
    
    
    
</div>

<script src='fullcalendar/core/main.js'></script>
<script src='fullcalendar/daygrid/main.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' ]
    });

    calendar.render();
    });

</script>

<?php 
    $sLinktoScript = '<script src="js/dog-sitter-profile.js"></script>';
    require_once 'bottom.php'; 
?>