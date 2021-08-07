
<?php
//#!/usr/bin/php -q
ini_set('date.timezone','Asia/Taipei');
$nowdate=date("Y-m-d");
$nowtime=date("H:i:s");//現在時間
$nowtimestr = substr($nowtime, 0, -2);
$nowtimestr = $nowtimestr."00"; //xx:xx:00

$nowtime50=date("H:i:s",strtotime($nowtimestr."-50 min"));//現在時間往前40分

$Datetime = $nowdate." " . $nowtimestr;
$Datetime50 = $nowdate. " ". $nowtime50;

//echo $Datetime;
//echo "<br>";
//echo $Datetime50;


$url = 'http://210.65.139.55:8081/tom/autoreceive.php';
$data = array('Datetime50' => $Datetime50, 'Datetime' => $Datetime);
$options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);



$json_a = json_decode($result,true);
$C1time = $json_a['C1time'];
$C2time = $json_a['C2time'];
$C3time = $json_a['C3time'];
$C3rtime = $json_a['C3rtime'];
$C2rtime = $json_a['C2rtime'];
$D1time = $json_a['D1time'];
$C1total = $json_a['C1total'];
$C2total = $json_a['C2total'];
$C3total = $json_a['C3total'];
$C4total = $json_a['C4total'];
$C3rtotal = $json_a['C2rtotal'];
$C4rtotal = $json_a['C3rtotal'];
$C2rtotal = $json_a['C4rtotal'];
$D1total = $json_a['D1total'];
$D2total = $json_a['D2total'];
$C1Num  = $json_a['C1Num'];
$C2Num  = $json_a['C2Num'];
$C3Num = $json_a['C3Num'];
$C3rNum = $json_a['C3rNum'];
$C2rNum = $json_a['C2rNum'];
$D1Num  = $json_a['D1Num'];
 echo "<br>";

// echo "C1time test = ". $json_a[C1time] . "another ". $json_a['C1time'];



//There are columns [array C1time C2time C3time C4time C1total]  <(^ v ^)> 


$database = "etag" ;
//#!/bin/bash


$database_host = "localhost" ;
$database_user = "root";
$database_pass = "ursa0601";


$link = mysqli_connect($database_host,$database_user,$database_pass,$database);

$sqlinsert2 = "INSERT INTO `total_data2`( `Date`, `Time` ,`AveragetimeC1`, `AveragetimeC2`, `AveragetimeC3`,
 `AveragetimeC2r`, `AveragetimeC3r`, `AveragetimeD1`, `AveragetotalC1`, `AveragetotalC2`, `AveragetotalC3`, 
 `AveragetotalC4`, `AveragetotalC2r`, `AveragetotalC3r`, `AveragetotalC4r`, `AveragetotalD1`, `AveragetotalD2`
 , `DatanumC1`, `DatanumC2`, `DatanumC3`, `DatanumC2r`, `DatanumC3r`, `DatanumD1`)
  VALUES ('$nowdate','$nowtimestr','$C1time','$C2time','$C3time','$C2rtime','$C3rtime',
	'$D1time','$C1total','$C2total','$C3total','$C4total','$C2rtotal','$C3rtotal','$C4rtotal','$D1total',
	'$D2total' , '$C1Num','$C2Num','$C3Num','$C3rNum','$C2rNum','$D1Num')";



//輸入到資料庫裡面
if (mysqli_query($link, $sqlinsert2)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlinsert. "<br>" . mysqli_error($link);
}

?>
