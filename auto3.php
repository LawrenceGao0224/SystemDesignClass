<?php




ini_set('date.timezone','Asia/Taipei');
 $nowdate=date("Ymd");
 $nowtime=date("H:i:s");//現在時間

 $nowtime5=date("H:i:s",strtotime($nowtime."-5 min"));//現在時間往前50分
 $nowtimestr5 = substr($nowtime5, 0, -2);
$nowtimestr5 = $nowtimestr5."00"; //xx:xx:00
$nowdatetimestr5 = $nowdate." " .$nowtimestr5;


//$nowtime = date("")




$url = 'http://210.65.139.17/tom/mssqlreceive.php';
$data = array('Date' => $nowdate, 'Time' => $nowtimestr5);
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
// A1 :CW  //14
// A2 :CE  //13
// A3 :WS  //47
// A4 :SW   //40
// A2r:SL   //39
// A3r:LW   //36
// 6,8 : WE  //45
// 2,4 : NW  //38
// 1,5 : MW  //37
// 1,4 : KW  //33
// 3,5 : JW  //30
// 1,3 : IW  //24
// 2,5 : HW  //22

$timeA1  =  intval($json_a['timeA1']);//CW
$timeA2  =  intval($json_a['timeA2']);//CE
$timeA3  =  intval($json_a['timeA3']);//WS
$timeA4  =  intval($json_a['timeA4']);//SW
$timeA2r =  intval($json_a['timeA2r']);//SL
$timeA3r =  intval($json_a['timeA3r']);//LW
$timeB1  =  intval($json_a['timeB1']);
$timeB2  =  intval($json_a['timeB2']);
$timeB3  =  intval($json_a['timeB3']);
$timeB4  =  intval($json_a['timeB4']);
$timeB2r =  intval($json_a['timeB2r']);
$timeB3r =  intval($json_a['timeB3r']);
$timeB4r =  intval($json_a['timeB4r']);
$numA1  =  intval($json_a['numA1']);
$numA2  =  intval($json_a['numA2']);
$numA3  =  intval($json_a['numA3']);
$numA4  =  intval($json_a['numA4']);
$numA2r =  intval($json_a['numA2r']);
$numA3r =  intval($json_a['numA3r']);
$numB1  =  intval($json_a['numB1']);
$numB2  =  intval($json_a['numB2']);
$numB3  =  intval($json_a['numB3']);
$numB4  =  intval($json_a['numB4']);
$numB2r =  intval($json_a['numB2r']);
$numB3r =  intval($json_a['numB3r']);
$numB4r =  intval($json_a['numB4r']);
$timeC1 =  intval($json_a['timeC1']);
$timeC2 =  intval($json_a['timeC2']);
$timeC3  =  intval($json_a['timeC3']);
$timeC3r =  intval($json_a['timeC3r']);
$timeC2r =  intval($json_a['timeC2r']);
$timeD1  =  intval($json_a['timeD1 ']);
$numC1 =  intval($json_a['numC1']);
$numC2 =  intval($json_a['numC2']);
$numC3 =  intval($json_a['numC3']);
$numC3r  =  intval($json_a['numC3r']);
$numC2r  =  intval($json_a['numC2r']);























$serverName = "10.1.1.105";
$connectionInfo = array( "Database"=>"tcdb", "UID"=>"tts92079", "PWD"=>"123456","CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
     echo "Connection established.<br />";
}else{
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}
doquery($conn,"CW",$timeA1,$numA1,$nowdatetimestr5);
doquery($conn,"CE",$timeA2,$numA2,$nowdatetimestr5);
doquery($conn,"WS",$timeA3,$numA3,$nowdatetimestr5);
doquery($conn,"SW",$timeA4,$numA4,$nowdatetimestr5);
doquery($conn,"SL",$timeA2r,$numA2r,$nowdatetimestr5);
doquery($conn,"LW",$timeA3r,$numA3r,$nowdatetimestr5);

// A1 :CW  //14 
// A2 :CE  //13
// A3 :WS  //47
// A4 :SW   //40
// A2r:SL   //39
// A3r:LW   //36
// 6,8 : WE  //45
// 2,4 : NW  //38
// 1,5 : MW  //37
// 1,4 : KW  //33
// 3,5 : JW  //30
// 1,3 : IW  //24
// 2,5 : HW  //22

#!/bin/bash
//#!/bin/bash

// echo $mytime50;
// echo "<br>";
// echo $mytime ;
// echo "<br>";











sqlsrv_close($conn);  


function doquery($conn,$roadid,$time,$nu1 m,$datetimestr5)
{
	 if($num != 0){
		$sql = "INSERT INTO [tcdb].[dbo].[AVI_TRAVELTIME_TAB] VALUES ('$roadid','$datetimestr5','$time','$num','$time')";
		echo $sql;

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		}
		


	 }else{
	 	echo "no data ";

	 }


}





?>
