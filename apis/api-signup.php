<?php

ini_set('display_errors',0);

require_once __DIR__.'/connect.php';

$sName = $_POST['txtSignupName'] ?? '';
if( empty($sName) ){
    sendResponse(0,__LINE__,"Last name can't be empty");
}
if( strlen($sName) < 2 ){
    sendResponse(0,__LINE__,"Name should be at least 2 characters long");
}
if( strlen($sName) > 20 ){
    sendResponse(0,__LINE__,"Name can't be longer than 20 characters");
}

$sLastname = $_POST['txtSignupLastname'] ?? '';
if( empty($sLastname) ){
    sendResponse(0,__LINE__,"Last name can't be empty");
}
if( strlen($sLastname) < 2 ){
    sendResponse(0,__LINE__,"Last name should be at least 2 characters long");
}
if( strlen($sLastname) > 20 ){
    sendResponse(0,__LINE__,"Last name can't be longer than 20 characters");
}

$sEmail = $_POST['txtSignupEmail'] ?? '';
if( empty($sEmail) ){
    sendResponse(0,__LINE__,"Email can't be empty");
}
if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL) ){
    sendResponse(0,__LINE__,"Email should be in this format: example@example.com");
}

$sPassword =$_POST['txtSignupPassword'] ?? '';
if( empty($sPassword) ){
    sendResponse(0,__LINE__,"Password can't be empty");
}
if( strlen($sPassword) < 6 ){
    sendResponse(0,__LINE__,"Password should be at least 6 characters long");
}

$sConfirmPassword =$_POST['txtSignupConfirmPassword'] ?? '';
if( empty($sConfirmPassword) ){
    sendResponse(0,__LINE__,"Confirm password can't be empty");
}
if($sPassword != $sConfirmPassword){
    sendResponse(0,__LINE__,"Passwords don't match");
}

$sAddress = $_POST['txtSignupAddress'] ?? '';
if( empty($sAddress) ){
    sendResponse(0,__LINE__,"Address can't be empty");
}
if( strlen($sAddress) < 5 ){
    sendResponse(0,__LINE__,"Address should be at least 5 characters long");
}
if( strlen($sAddress) > 30 ){
    sendResponse(0,__LINE__,"Address can't be longer than 30 characters");
}

$sPhone = $_POST['txtSignupPhone'] ?? '';
if( empty($sPhone) ){
    sendResponse(0,__LINE__,"Phone can't be empty");
}
if( strlen($sPhone) != 8 ){
    sendResponse(0,__LINE__,"Phone should be 8 characters long");
}
if( intval($sPhone) < 10000000 ){
    sendResponse(0,__LINE__,"Phone should be 8 characters long");
}
if( intval($sPhone) > 99999999 ){
    sendResponse(0,__LINE__,"Phone should be 8 characters long");
}
if( ctype_digit($sPhone) == false ){
    sendResponse(0,__LINE__,"Phone should contain only digits");
}

$sEmergencyContactName = $_POST['txtSignupEmergencyContactName'] ?? '';
if( empty($sEmergencyContactName) ){
    sendResponse(0,__LINE__,"Emergency contact name can't be empty");
}
if( strlen($sEmergencyContactName) < 2 ){
    sendResponse(0,__LINE__,"Emergency contact name should be at least 2 characters long");
}
if( strlen($sEmergencyContactName) > 40 ){
    sendResponse(0,__LINE__,"Emergency contact name can't be longer than 40 characters");
}

$sEmergencyContactPhone = $_POST['txtSignupEmergencyContactPhone'] ?? '';
if( empty($sEmergencyContactPhone) ){
    sendResponse(0,__LINE__,"Emergency contact phone can't be empty");
}
if( strlen($sEmergencyContactPhone) != 8 ){
    sendResponse(0,__LINE__,"Emergency contact phone should be 8 characters long");
}
if( intval($sEmergencyContactPhone) < 10000000 ){
    sendResponse(0,__LINE__,"Emergency contact phone should be 8 characters long");
}
if( intval($sEmergencyContactPhone) > 99999999 ){
    sendResponse(0,__LINE__,"Emergency contact phone should be 8 characters long");
}
if( ctype_digit($sEmergencyContactPhone) == false ){
    sendResponse(0,__LINE__,"Emergency contact phone should contain only digits");
}

$stmt = $db->prepare( 'INSERT INTO users(id, first_name, last_name, email, password, profile_photo_url, address, phone_number, emergency_contact_name, emergency_contact_phone_number) VALUES(null, :sName, :sLastname, :sEmail, :sPassword, "images/1.jpg", :sAddress, :sPhone, :sEmergencyContactName, :sEmergencyContactPhone)' );
$stmt->bindValue(':sName', $sName);
$stmt->bindValue(':sLastname', $sLastname);
$stmt->bindValue(':sEmail', $sEmail);
$stmt->bindValue(':sPassword', $sPassword);
$stmt->bindValue(':sAddress', $sAddress);
$stmt->bindValue(':sPhone', $sPhone);
$stmt->bindValue(':sEmergencyContactName', $sEmergencyContactName);
$stmt->bindValue(':sEmergencyContactPhone', $sEmergencyContactPhone);

$stmt->execute();
sendResponse(1, __LINE__, "Success");


/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}