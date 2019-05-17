<?php

// ini_set('display_errors',0);

require_once __DIR__.'/connect.php';

$sSearchDate = $_GET['sSearchDate'] ?? '';
$sUserEmail = $_GET['sUserEmail'] ?? '';

$stmt = $db->prepare( 'SELECT first_name, last_name, email, profile_photo_url, address
FROM users 
WHERE id IN (SELECT user_fk 
              FROM dog_sitters_availability
             WHERE :sSearchDate BETWEEN start_date AND end_date)' );
$stmt->bindValue(':sSearchDate', $sSearchDate);
$stmt->execute();
$aRows = $stmt->fetchAll();

$aResults = array();
foreach( $aRows as $aRow ){
        $aResults[] = "<div class='white-card'><div class='photo'><img src='$aRow->profile_photo_url' alt=''></div><div class='about'><h1>$aRow->first_name $aRow->last_name</h1><p>About</p><p class='address'>$aRow->address</p></div><div class='fare'><h2>$25</h2></div></div>";
}

if($aRows == []){
    $aResults[] = "<div class='white-card'>No dog sitters found for this date :(</div>";
}
sendResponse(1, __LINE__, implode(" ",$aResults));



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}