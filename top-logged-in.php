<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doggo</title>
    <link rel="stylesheet" href="css/style.css">
    <?php echo $sLinktoExtraCss ?? '';?>

    <?php 
    $sUserEmail = $_SESSION['sEmail'];
    echo $sHeaderLink ?? '';?>
</head>
<body <?= $sGreyBodyClass ?? "" ?> >
    <nav class="shadow">
        <div class="left-nav">
            <a href="<?php echo $sProfileLink ?? 'profile'; ?>"><img class="logo" src="images/doggo-loggo.svg"></a>
            <a href="search"><img src="images/search.svg" class="small-icon">Search for dog sitters</a>


            <?php
                    require_once __DIR__.'/connect.php';
                    // $sUserEmail = $_SESSION['sEmail'];
                    // session_start();
                    
                    // $sUserEmail = $_SESSION['sEmail'];


                    $stmt = $db->prepare("SELECT * FROM users WHERE email = :sUserEmail AND is_dog_sitter = 1"); 
                    $stmt->bindValue(':sUserEmail', $sUserEmail);
                    $stmt->execute();

                    $aRows = $stmt->fetchAll();
                    
                    if ($aRows == []){
                        echo '<a href="become-a-dogsitter"><img src="images/dog.svg" class="small-icon">Become a dog sitter</a>';
                    }
                    
                    // foreach( $aRows as $aRow ){
                    //     $sUserId = $aRow->id;
                    //     // echo $sUserId;
                    //     echo "$sUserEmail with sUserId $sUserId is a dog sitter";
                    // }
                    
                ?>


        </div>
        <div class="right-nav">
            <a href="<?php echo $sProfileLink ?? 'profile'; ?>">Profile</a>
            <a href="<?php echo $sSettingsLink ?? 'settings'; ?>">Settings</a>
            <a href="logout">Logout</a>
        </div>
    </nav>
