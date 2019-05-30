<?php

// ini_set('display_errors',0);

require_once '../connect.php';


$sUserEmail = $_GET['sUserEmail'] ?? '';
$sDogSitterId = $_GET['sDogSitterId'] ?? '';
$sBookingMessage = $_GET['message'] ?? '';
$sTime = $_GET['sTime'] ?? '';
$sDate = $_GET['sDate'] ?? '';


$stmt = $db->prepare( 'SELECT id, first_name, last_name, email, profile_photo_url, address FROM users WHERE email=:sUserEmail' );
$stmt->bindValue(':sUserEmail', $sUserEmail);
$stmt->execute();
$aRows = $stmt->fetchAll();

foreach( $aRows as $aRow ){
    $sUserId = $aRow->id;
    
}

//sDate - find a record with this date



$stmtthree = $db->prepare( 'SELECT * FROM dog_sitters_availability WHERE user_fk = :sDogSitterId' );
$stmtthree->bindValue(':sDogSitterId', $sDogSitterId);
$stmtthree->execute();

$aRowsThree = $stmtthree->fetchAll();

$aStartDates = array();
$aEndDates = array();
$aAllIds = array();


foreach( $aRowsThree as $aRow ){
    $sRecordId = $aRow->id;
    // echo 'RECORD-ID: '.$sRecordId.", ";
    $aAllIds[] = $sRecordId;

    $sUserFk = $aRow->user_fk;
    // echo $sUserFk.", ";

    $sStartDate = $aRow->start_date;
    // echo $sStartDate.", ";
    $aStartDates[] = $sStartDate;

    $sEndDate = $aRow->end_date;
    // echo $sEndDate.", ";
    $aEndDates[] = $sEndDate;
    
    $sTimeInterval = $aRow->time_interval;
    // echo $sTimeInterval.", ";


    $sIsAvailable = $aRow->is_available;
    // echo $sIsAvailable." END ";    
    
}

$aDates = array();

foreach($aStartDates as $key => $startDateInSeconds){
    $endDateInSeconds = $aEndDates[$key];
    $startDate =  date("Y-m-d", substr($startDateInSeconds, 0, 10));
    $endDate = date("Y-m-d", substr($endDateInSeconds, 0, 10));

    $aDates[] = createRange($startDate, $endDate);
    // $sAllDatesString = join(",",$aDates);
}

// print_r($aDates);

$formattedDateForSearch =  date("Y-m-d", substr($sDate, 0, 10));

$i = -1;
foreach($aDates as $aDateGroup){
    ++$i;
    if(is_numeric(strpos($aDateGroup, $formattedDateForSearch))){
        $iFoundLine = $i;
    }
}

// echo 'THIS LINE: ';
// echo $iFoundLine;

$iRecordIdWithBookedDate = $aAllIds[$iFoundLine];

$stmtfour = $db->prepare( 'SELECT * FROM dog_sitters_availability WHERE id=:iRecordIdWithBookedDate' );
$stmtfour->bindValue(':iRecordIdWithBookedDate', $iRecordIdWithBookedDate);
$stmtfour->execute();
$aRowsFour = $stmtfour->fetchAll();

foreach( $aRowsFour as $aRow ){
    $sBookedRecordUserFk = $aRow->user_fk;
    $sBookedRecordTimeInterval = $aRow->time_interval;
}

$stmtfive = $db->prepare( 'DELETE FROM dog_sitters_availability WHERE id=:iRecordIdWithBookedDate' );
$stmtfive->bindValue(':iRecordIdWithBookedDate', $iRecordIdWithBookedDate);
$stmtfive->execute();


$aDateLine = $aDates[$iFoundLine];
// echo $aDateLine;

$aDatesFromId = explode(",",$aDateLine);

$aDatesFromId = array_flip($aDatesFromId);
unset($aDatesFromId[$formattedDateForSearch]);
$aDatesFromId = array_flip($aDatesFromId);


//make new records in the booking database for available dates
foreach($aDatesFromId as $aDate){

    $aDate = $aDate.' 12:00:00';
    $iUnixDate = strtotime($aDate);
    $iUnixDate = $iUnixDate*1000;
    $stmtfour = $db->prepare( 'INSERT INTO dog_sitters_availability VALUES(null, :sBookedRecordUserFk, :iUnixDate, :iUnixDate, :sBookedRecordTimeInterval, 1)' );
    $stmtfour->bindParam(':sBookedRecordUserFk', $sBookedRecordUserFk);
    $stmtfour->bindParam(':iUnixDate', $iUnixDate);
    $stmtfour->bindParam(':sBookedRecordTimeInterval', $sBookedRecordTimeInterval);
    $stmtfour->execute();
    // echo $aDate;
};
//make a new record for the booked date with is_available = 0

$sBookedDateFormatted = $formattedDateForSearch.' 12:00:00';
$iUnixBookedDate = strtotime($sBookedDateFormatted);
$iUnixBookedDate = $iUnixBookedDate*1000;
$stmtfive = $db->prepare( 'INSERT INTO dog_sitters_availability VALUES(null, :sBookedRecordUserFk, :iUnixBookedDate, :iUnixBookedDate, :sBookedRecordTimeInterval, 0)' );
$stmtfive->bindParam(':sBookedRecordUserFk', $sBookedRecordUserFk);
$stmtfive->bindParam(':iUnixBookedDate', $iUnixBookedDate);
$stmtfive->bindParam(':sBookedRecordTimeInterval', $sBookedRecordTimeInterval);
$stmtfive->execute();
// echo $aDate;


//remove the record with original startdate and enddate




$stmtsix = $db->prepare( 'SELECT id FROM dogs WHERE user_fk IN (SELECT id FROM users WHERE email=:sUserEmail)' );
$stmtsix->bindParam(':sUserEmail', $sUserEmail);
$stmtsix->execute();

$aRowsSix = $stmtsix->fetchAll();

foreach($aRowsSix as $aRow){

    $iDogId = $aRow->id;
};



$stmttwo = $db->prepare( 'INSERT INTO bookings(id, user_fk, dog_sitter_fk, dog_fk, time_interval, message, booking_date) VALUES(null, :sUserId, :sDogSitterId, :iDogId, :sTime, :sBookingMessage, :sDate)' );
$stmttwo->bindValue(':sUserId', $sUserId);
$stmttwo->bindValue(':sDogSitterId', $sDogSitterId);
$stmttwo->bindValue(':sBookingMessage', $sBookingMessage);
$stmttwo->bindValue(':sTime', $sTime);
$stmttwo->bindValue(':sDate', $sDate);
$stmttwo->bindValue(':iDogId', $iDogId);
$stmttwo->execute();

sendResponse(1, __LINE__, "Success");


/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}

function createRange($start, $end, $format = 'Y-m-d') {
    $start  = new DateTime($start);
    $end    = new DateTime($end);
    $invert = $start > $end;

    $dates = array();
    $dates[] = $start->format($format);
    while ($start != $end) {
        $start->modify(($invert ? '-' : '+') . '1 day');
        $dates[] = $start->format($format);
    }
    return join(",",$dates);
}