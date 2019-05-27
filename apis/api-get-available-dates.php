<?php

// ini_set('display_errors',0);

require_once '../connect.php';

$sUserEmail = $_GET['sUserEmail'] ?? '';

$stmtone = $db->prepare( 'SELECT start_date, end_date FROM dog_sitters_availability INNER JOIN users ON users.id = dog_sitters_availability.user_fk WHERE users.email = :sUserEmail AND is_available=1' );
$stmtone->bindValue(':sUserEmail', $sUserEmail);
$stmtone->execute();
$aRows = $stmtone->fetchAll();

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

$aStartDates = array();
$aEndDates = array();
$aAllDates = array();
$aDates = array();

foreach( $aRows as $aRow ){
    $sStartDate = $aRow->start_date;
    $sEndDate = $aRow->end_date;

    $aStartDates[] = $sStartDate;
    $aEndDates[] = $sEndDate;
    //sStartDate is in seconds, convert to date

    // echo date("Y-m-d", substr($sStartDate, 0, 10));
    // createRange('2010-10-01', '2010-10-05')
}

foreach($aStartDates as $key => $startDateInSeconds){
    $endDateInSeconds = $aEndDates[$key];
    $startDate =  date("Y-m-d", substr($startDateInSeconds, 0, 10));
    $endDate = date("Y-m-d", substr($endDateInSeconds, 0, 10));

    $aDates[] = createRange($startDate, $endDate);
    $sAllDatesString = join(",",$aDates);
}
// array_push($aAllDates, $aDatesTwo);

// $sAllDates = json_encode($sAllDatesString);

sendResponse(1, __LINE__, $sAllDatesString);



/********************************/

function sendResponse($iStatus, $iLine, $sMessage){
    echo '{"status": '.$iStatus.', "code": "'.$iLine.'", "message":"'.$sMessage.'"}';
    exit;
}