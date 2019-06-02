<?php

try{

    $sUserName = 'marijabelautdinova_com_doggo';
    $sPassword = 'ilovepizza';
    $sConnection = "mysql:host=marijabelautdinova.com.mysql; dbname=marijabelautdinova_com_doggo; charset=utf8mb4";

    $aOptions = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );
}catch( PDOException $e){
    echo $e;
    // echo '{"status":0,"message":"cannot connect to database"}';
    exit();
}