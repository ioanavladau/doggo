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
    $sHeaderLink = "<script> window.sUserEmail = '$sUserId'</script>";
    // $sHeaderLinkTwo = "<script> </script>";
    require_once 'top-logged-in.php';

    require_once 'connect.php';
    $stmt = $db->prepare( 'SELECT is_dog_sitter FROM users WHERE email=:sUserId' );
    $stmt->bindValue(':sUserId', $sUserId);
    $stmt->execute();
    $aRows = $stmt->fetchAll();

    foreach( $aRows as $aRow ){
        if($aRow->is_dog_sitter == 0){
            $sClassHide = 'hide';
        }
    }

?>

<div class="container contents-centered flex-column" style="justify-content: flex-start;">
    <div class="booking-requests-all">
        <div class="card card-with-a-title width-100 booking-request <?= $sClassHide ?? '' ?>">
            <div class="card-title">
                Pending booking requests
            </div>

            <div id="booking-requests">
            </div>

        </div>

        <div class="card card-with-a-title width-100 booking-request accepted-booking-request <?= $sClassHide ?? '' ?>">
            <div class="card-title">
                Accepted booking requests
            </div>

            <div id="accepted-booking-requests">
            </div>

        </div>

        <div class="card card-with-a-title width-100 booking-request accepted-booking-request <?= $sClassHide ?? '' ?>">
            <div class="card-title">
                Declined booking requests
            </div>

            <div id="declined-booking-requests">
            </div>

        </div>
    </div>

    <div class="card card-with-a-title width-100 bookings-for-your-dog">
        <div class="card-title">
            Bookings for your dog
        </div>

        <div class="container--tabs">
        
        <section class="row-tabs">
            <ul class="nav nav-tabs">
                <li class="active" id="upcoming"><a href="#tab-1">Upcoming</a></li>
                <li class="" id="pending"><a href="#tab-2">Pending</a></li>
                <li class="" id="archived"><a href="#tab-3">Archived</a></li>
            </ul>
            <div class="tab-content">
                
                <div id="tab-1" class="tab-pane active">
                    <div id="booking-row">

                    </div>
                </div>

                <div id="tab-2" class="tab-pane">
                    <div id="booking-row-two">
                        
                    </div>
                </div>

                <div id="tab-3" class="tab-pane">
                    <div id="booking-row-three">
                        
                    </div>
                </div>
                
            </div>
        </section>
    </div>

    </div>
    
</div>


<?php 
    $sLinktoScript = '<script src="js/bookings.js"></script>';
    require_once 'bottom.php'; 
?>