<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';


$stmtone = $db->prepare( 'SELECT id FROM users WHERE email=:sUserEmail' );
$stmtone->bindValue(':sUserEmail', $sUserEmail);
$stmtone->execute();
$aRows = $stmtone->fetchAll();

foreach( $aRows as $aRow ){
    $iDogSitterFk = $aRow->id;
}

$stmttwo = $db->prepare( 'SELECT reviews.review_date, reviews.review_text, reviews.stars, users.profile_photo_url, users.first_name, users.last_name FROM reviews INNER JOIN users ON users.id = reviews.user_fk WHERE dog_sitter_fk = :iDogSitterFk ORDER BY reviews.review_date DESC' );
$stmttwo->bindValue(':iDogSitterFk', $iDogSitterFk);
$stmttwo->execute();
$aRowsTwo = $stmttwo->fetchAll();

$aAllReviews = array();

foreach( $aRowsTwo as $aRow ){
    $aAllStars = array();
    for($i=1; $i<=$aRow->stars; $i++){
        $sOneStarImg = "<img class='margin-right-5' src='images/star-yellow.svg'>";
        $aAllStars[] = $sOneStarImg;
    }
    $sAllStars = join(" ",$aAllStars);
    $sDateNormalized =  date("d/m/Y", substr($aRow->review_date, 0, 10));
    $sOneReviewText = "<div class='review'><div class='review-header'><div class='owner-photo-info'><div class='photo'><img src='$aRow->profile_photo_url' alt=''></div><div class='review-owner-info'><h5>$aRow->first_name $aRow->last_name</h5><h5>$sDateNormalized</h5></div></div><div class='stars-rating'>$sAllStars</div></div><p class='review-text'>$aRow->review_text</p><div class='horizontal-divider'></div></div>";
    $aAllReviews[] = $sOneReviewText;
}
$sAllReviews = join(" ",$aAllReviews);

if($aRowsTwo==[]){
    $sAllReviews="<div class='review'><h5 style='text-transform: none;'>No reviews yet</h5></div>";
}



sendResponse(1, __LINE__, $sAllReviews);



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}