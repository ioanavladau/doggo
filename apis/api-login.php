<?php

ini_set('display_errors',0);

require_once __DIR__.'/connect.php';

$sEmail = $_POST['txtLoginEmail'] ?? '';
if( empty($sEmail) ){
    sendResponse(0,__LINE__,"Email can't be empty");
}

$sPassword = $_POST['txtLoginPassword' ?? ''];
if( empty($sPassword) ){
    sendResponse(0,__LINE__,"Password can't be empty");
}
if( strlen($sPassword) < 6 ){
    sendResponse(0,__LINE__,"Length of the password is less than 6");
}
if( strlen($sPassword) > 50 ){
    sendResponse(0,__LINE__,"Length of the password is more than 50");
}


$stmt = $db->prepare('SELECT * FROM users WHERE email=:sEmail'); 
$stmt->bindValue(':sEmail', $sEmail);

$stmt->execute();
$aRows = $stmt->fetchAll();

if ($aRows == []){
    sendResponse(-1, __LINE__, "User is not registered in Doggo");
    exit;
}

foreach( $aRows as $aRow ){
    if($sPassword !== $aRow->password){
        sendResponse(0, __LINE__, "Incorrect password");
        exit;
    }
    session_start();
    $_SESSION['sUserId'] = $sEmail;
    sendResponse(1, __LINE__, $sEmail);
}

/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}