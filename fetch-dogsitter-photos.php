<?php
    require_once __DIR__.'/connect.php';
    $stmtDogSitterPhotos = $db->prepare("SELECT url FROM dog_sitters_photos WHERE user_fk=:userId");
    $stmtDogSitterPhotos->bindValue(':userId', $userId);
    $stmtDogSitterPhotos->execute();

    $aRows = $stmtDogSitterPhotos->fetchAll();

    foreach( $aRows as $aRow ){
        echo "<div><img src='images/dog-sitter-photos/$aRow->url' class='img-width100'></div>";
    }