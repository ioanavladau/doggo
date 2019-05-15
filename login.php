<?php 
    $sGreyBodyClass = "class='grey-bg'";
    require_once 'top.php'; 
?>

    <div class="container contents-centered">
        <div class="card shadow">
            <h1>Log in to Doggo</h1>
            <form id="frmLogin">
                <label for="txtLoginEmail">Email</label>
                <input name="txtLoginEmail" type="email" data-validate="yes" data-type="integer">

                <label for="txtLoginPassword">Password</label>
                <input name="txtLoginPassword" type="password" data-validate="yes" data-type="string" data-min="6" data-max="50">
                <button class="yellow-btn">Log in</button>
                <div class="login-links">
                    <a href="forgot-password">Forgot password?</a>
                    <div>Not a member? <a href="signup">Sign up</a></div>
                </div>
            </form>
        </div>
    </div>

<?php 
    $sLinktoScript = '<script src="js/login.js"></script>';
    require_once 'bottom.php'; ?>