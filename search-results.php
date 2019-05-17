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
            <input type="text" name="searchdate" value="01/01/2018" />
                <button class="yellow-btn" id="searchForDate">Search</button>
            </form>
        </div>

        <div class="dog-sitters" id="dogSitterResults">
            <div class="white-card">
                <div class="photo">
                    <img src="images/0.jpg" alt="">
                </div>
                <div class="about">
                    <h1>Name</h1>
                    <p>About</p>
                    <p class="address">Address</p>
                </div>
                <div class="fare">
                    <h2>$25</h2>
                </div>
            </div>
        </div>
    </div>
    
    <template id="dogSitterTemplate">
		<div>
		
		</div>
	</template>

</div>



<?php 
    $sLinktoScript = '<script src="js/search-results.js"></script>';
    require_once 'bottom.php'; 
?>