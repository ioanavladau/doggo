<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sSearchDate = $_GET['sSearchDate'] ?? '';
$sSearchTimeInterval = $_GET['sSearchTimeInterval'] ?? '';
$sUserEmail = $_GET['sUserEmail'] ?? '';

$stmt = $db->prepare( 'SELECT users.id, users.first_name, users.last_name, users.email, users.profile_photo_url, users.address, dog_sitters.about
FROM users INNER JOIN dog_sitters ON users.id = dog_sitters.user_fk
WHERE NOT users.email = :sUserEmail AND users.is_dog_sitter=1 AND users.id IN (SELECT user_fk 
              FROM dog_sitters_availability
             WHERE time_interval = :sSearchTimeInterval AND :sSearchDate BETWEEN start_date AND end_date)' );


$stmt->bindValue(':sSearchDate', $sSearchDate);
$stmt->bindValue(':sSearchTimeInterval', $sSearchTimeInterval);
$stmt->bindValue(':sUserEmail', $sUserEmail);
$stmt->execute();
$aRows = $stmt->fetchAll();

$aResults = array();
foreach( $aRows as $aRow ){
        $aResults[] = "<a href='dog-sitter-profile.php?id=$aRow->id'><div class='white-card'><div class='photo'><img src='$aRow->profile_photo_url' alt=''></div><div class='about'><h1>$aRow->first_name $aRow->last_name</h1><p>$aRow->about</p><p class='address'>$aRow->address</p></div><div class='fare'><h2>$25</h2></div></div></a>";
}

if($aRows == []){
    $aResults[] = "<div class='white-card'>No dog sitters found for this date and time frame :(</div>";
}
sendResponse(1, __LINE__, implode(" ",$aResults));



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}