<?php
    session_start();
    if( !isset($_SESSION['sEmail']) ){
        header('Location: login.php');
    }

    $sUserId = $_SESSION['sEmail'];

    $sLinktoExtraCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
    $sProfileLink = 'profile';
    $sSettingsLink = 'settings';
    $sGreyBodyClass = "class='grey-bg'";
    $sHeaderLink = "<script> window.sUserEmail = '$sUserId'</script>";

    require_once 'top-logged-in.php';
?>

<div class="container">
    <div class="search-results">
        <div class="search-bar white-card">
            <form>
                <input type="text" name="searchdate" id="availability" value="05/01/2019" />
                <div class="available-times">
                    <div class="available-time first-time-span" id="morning">6:00-11:00</div>
                    <div class="available-time second-time-span" id="noon">11:00-15:00</div>
                    <div class="available-time third-time-span" id="evening">15:00-20:00</div>
                </div>
            <!-- <input type="text" name="searchdate" value="01/01/2018" /> -->
                <button class="yellow-btn" id="searchForDate">Search</button>
            </form>
        </div>

        <div class="dog-sitters" id="dogSitterResults">
            <div class="white-card">
                <p style="color: lightgray;">Select a date and a time period in the search bar on the left</p>
                
            </div>
        </div>
    </div>
    
    <template id="dogSitterTemplate">
		<!-- <a class="dog-sitter-card" href=""> -->
		<div></div>
		<!-- </a> -->
	</template>

</div>



<?php 
    $sLinktoScript = '<script src="js/search.js"></script>';
    require_once 'bottom.php'; 
?>