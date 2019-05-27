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
    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'</script>";

    
    require_once 'top-logged-in.php';
    

    //*************************DB stuff******************************/
    require_once 'connect.php';
    // $sDogSitterId = $_GET['id'] ?? '';

    $stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address, is_dog_sitter FROM users WHERE email=:sUserEmail' );
    $stmt->bindValue(':sUserEmail', $sUserEmail);
    $stmt->execute();
    $aRows = $stmt->fetchAll();

    foreach( $aRows as $aRow ){
        $sFullName = $aRow->first_name.' '.$aRow->last_name;
        $sProfilePhotoUrl = $aRow->profile_photo_url;
        if($aRow->is_dog_sitter == 0){
            $sClassHide = 'hide';
        }
    }

    $stmttwo = $db->prepare("SELECT * FROM users WHERE email = :sUserEmail AND is_dog_sitter = 1"); 
    $stmttwo->bindValue(':sUserEmail', $sUserEmail);
    $stmttwo->execute();
    $aRowsTwo = $stmttwo->fetchAll();
    
    // if ($aRowsTwo == []){
    //     echo 'not a dogsitter'; 
    // }
    
    foreach( $aRowsTwo as $aRow ){
        $sUserId = $aRow->id;
        $sIsDogSitter = '<div class="is-dog-sitter"><img src="images/dog.svg" class="small-icon">Dog sitter</div>';
    }
?>

<div class="container two-grid">
        <div class="card card-with-a-title ">
            <div class="card-title">
                Profile info
            </div>


            
            <div class="row">
                <img class="small-photo" src="<?= $sProfilePhotoUrl ?>" alt="">
                <div class="about-profile">
                    <h1><?= $sFullName ?></h1>
                    <?= $sIsDogSitter ?? "" ?>
                </div>
            </div>
            
        </div>
        <div class="card card-with-a-title <?= $sClassHide ?? '' ?>">
            <div class="card-title">
                Availability calendar
            </div>
            <div class="width-320 margin-top-30">
                <input type="text" name="daterange" id="availability" value="05/01/2019 - 05/30/2019" />
                <div class="available-times">
                    <div class="available-time first-time-span" id="morning">6:00-11:00</div>
                    <div class="available-time second-time-span" id="noon">11:00-15:00</div>
                    <div class="available-time third-time-span" id="evening">15:00-20:00</div>
                </div>

                <button class="yellow-btn" id="add-availability">Add availability</button>
            </div>


        <div class="availability-calendar">
            <div id='calendar'></div>
        </div>
            

        </div>


        <div class="card" id="add-a-dog-container">
            <a class="yellow-btn" href="your-dogs">Add a pet</a>
        </div>

        <div class="card card-with-a-title" id="myDog">
            <div class="card-title">
               Your dog
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
$sLinktoScript = '<script src="js/profile.js"></script>';
require_once 'bottom.php'; 
?>