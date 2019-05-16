<?php 
    $sGreyBodyClass = "class='grey-bg height-auto'";
    require_once 'top.php'; 
?>


    <div class="container contents-centered">
        <div class="card">
            <h1>Create an account</h1>
            <p>Already a user? <a href="login">Log in.</a></p>
            <form id="frmSignup" action='apis/api-signup' method="POST">
                <label for="txtSignupName">Name</label>
                <input name="txtSignupName" type="text" data-validate="yes" data-type="string" data-min="2" data-max="20">
                <label for="txtSignupLastname">Last name</label>
                <input name="txtSignupLastname" type="text" data-validate="yes" data-type="string" data-min="2" data-max="20">
                <label for="txtSignupEmail">Email</label>
                <input name="txtSignupEmail" type="text" data-validate="yes" data-type="email" data-min="6" data-max="50">
                <label for="txtSignupPassword">Password</label>
                <input name="txtSignupPassword" type="password" data-validate="yes" data-type="string" data-min="6" data-max="50">
                <label for="txtSignupConfirmPassword">Confirm password</label>
                <input name="txtSignupConfirmPassword" type="password" data-validate="yes" data-type="string" data-min="6" data-max="50">
                <label for="txtSignupAddress">Address</label>
                <input name="txtSignupAddress" type="text" data-validate="yes" data-type="string" data-min="5" data-max="30">
                <label for="txtSignupPhone">Mobile phone</label>
                <input name="txtSignupPhone" type="text" data-validate="yes" data-type="integer" data-min="10000000" data-max="99999999">
                <label for="txtSignupEmergencyContactName">Emergency contact name</label>
                <input name="txtSignupEmergencyContactName" type="text" data-validate="yes" data-type="string" data-min="2" data-max="40">
                <label for="txtSignupEmergencyContactPhone">Emergency contact phone</label>
                <input name="txtSignupEmergencyContactPhone" type="text" data-validate="yes" data-type="integer" data-min="10000000" data-max="99999999">
                <button class="yellow-btn">Sign up</button>
            </form>
        </div>
    </div>
    

    

<?php 
$sLinktoScript = '<script src="js/signup.js"></script>';
require_once 'bottom.php'; ?>