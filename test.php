<?php 
  
// Declare two dates 
$Date1 = '1515283200000'; 
$Date2 = '1515801600000'; 
$sConvertedDate1 = date("Y-m-d", substr($Date1, 0, 10));  
$sConvertedDate2 = date("Y-m-d", substr($Date2, 0, 10));  

// Declare an empty array 
$array = array(); 
  
// Use strtotime function 
$Variable1 = strtotime($sConvertedDate1); 
$Variable2 = strtotime($sConvertedDate2); 
  
// Use for loop to store dates into array 
// 86400 sec = 24 hrs = 60*60*24 = 1 day 
for ($currentDate = $Variable1; $currentDate <= $Variable2;  
                                $currentDate += (86400)) { 
                                      
$Store = date('Y-m-d', $currentDate); 
$array[] = $Store; 
} 

foreach($array as $item){
    echo $item.", ";
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script src="test.js"></script>

</body>
</html>