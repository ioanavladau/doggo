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

<div class="container contents-centered flex-column">

    <div class="card card-with-a-title width-100 booking-request <?= $sClassHide ?? '' ?>">
        <div class="card-title">
            Booking requests
        </div>

        <div id="booking-requests">
        </div>

    </div>

    <div class="card card-with-a-title width-100">
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
                    
                    <table id="booking-row" class="booking-table">
                        <thead>
                            <tr>
                                <th class="sitter">Dog sitter</th>
                                <th class="pet">Your pet</th>
                                <th class="date">Date</th>
                                <th class="time-range">Time range</th>
                                <th class="message">Message</th>
                                <th class="status">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div> 
                <div id="tab-2" class="tab-pane">
                    <table id="booking-row-two" class="booking-table">
                        <thead>
                            <tr>
                                <th class="sitter">Dog sitter</th>
                                <th class="pet">Your pet</th>
                                <th class="date">Date</th>
                                <th class="time-range">Time range</th>
                                <th class="message">Message</th>
                                <th class="status">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
                <div id="tab-3" class="tab-pane">
                    <table id="booking-row-three" class="booking-table">
                        <thead>
                            <tr>
                                <th class="sitter">Dog sitter</th>
                                <th class="pet">Your pet</th>
                                <th class="date">Date</th>
                                <th class="time-range">Time range</th>
                                <th class="message">Message</th>
                                <th class="status">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
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