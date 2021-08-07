#!/usr/bin/php -q
<?php
$database = "etag" ;
//#!/bin/bash
ini_set('date.timezone','Asia/Taipei');

$database_host = "localhost" ;
$database_user = "root";
$database_pass = "ursa0601";


$link = mysqli_connect($database_host,$database_user,$database_pass,$database);
$nowdate=date("Ymd");
$nowtime=date("H:i:s");//現在時間
$nowtime5=date("H:i:s",strtotime($nowtime."-5 min"));//現在時間往前5分
$nowtime40=date("H:i:s",strtotime($nowtime."-40 min"));//現在時間往前40分
$nowtimestr = substr($nowtime, 0, -2);
$nowtimestr = $nowtimestr."00"; //xx:xx:00

//echo $nowtime5;
$mytime = "19:00:00";
$mytime2 = "20:59:00";
$sqltable1="tce01_".$nowdate;
$sqltable2="tce02_".$nowdate;
//要抓五十分鐘前的資料 在前五分鐘的資料進行分析
//$table = "`tce02_20151208`";
//$sql = "SELECT * FROM $table where `system_time` between '$mytime' and '$mytime2'";
//$sql = "SELECT * FROM $sqltable1" ;
//$sql = "SELECT * FROM `tce01_20151218` where `time` between '$mytime' and '$mytime2' " ;
//$sql = "SELECT * FROM `tce01_20151218`";
$sql = "SELECT * FROM `$sqltable1` where `time` between '$nowtime40' and '$nowtime' " ;
echo $sqltable1."<br>";
echo $mytime40. " to ". $nowtime."<br>";


$etag1 = array();//忠明 -出城往西
$etag2 = array();//文心 -出城往西
$etag3 = array();//黎明 -出城往西
$etag4 = array();//向上 -出城往西
$etag5 = array();//環中 -出城往西

$etag6 = array();//向上 -入城往東
$etag7 = array();//黎明 -入城往東
$etag8 = array();//文心 -入城往東
$fetag1 = array();//
$fetag2 = array();//
$fetag3 = array();//
$fetag4 = array();//
$fetag5 = array();//

$fetag6 = array();//
$fetag7 = array();//
$fetag8 = array();//
$fetag9 = array();//

$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
    	
		$etagnumber = $row['station'];
		$arrayitem = array();
		$arrayitem['key_id'] = $row['key_id'];//流水編號
		$arrayitem['epc'] =$row['epc'];//唯一車編
		$arrayitem['tid']=$row['tid'];//唯一車編
		$arrayitem['station']=$row['station'];//感應架編號
		$arrayitem['lane']=$row['lane'];//不知道
		$arrayitem['vehicles']=$row['vehicles'];//不知道
		$arrayitem['direction']=$row['direction'];//west西邊，east東邊
		$arrayitem['date']=$row['date'];//年月日
		$arrayitem['time']=$row['time'];//時分秒
		$arrayitem['system_time']=$row['system_time'];//附註時分秒
		
		switch ($etagnumber) {
			case "etag-01":
			array_push($etag1, $arrayitem);
			break;
			case "etag-02":
			array_push($etag2, $arrayitem);
			break;
			case "etag-03":
			array_push($etag3, $arrayitem);
			break;
			case "etag-04":
			array_push($etag4, $arrayitem);
			break;
			case "etag-05":
			array_push($etag5, $arrayitem);
			break;
			case "etag-06":
			array_push($etag6, $arrayitem);
			break;
			case "etag-07":
			array_push($etag7, $arrayitem);
			break;
			case "etag-08":
			array_push($etag8, $arrayitem);
			break;
			case "fetag-01":
			array_push($fetag1, $arrayitem);
			break;
			case "fetag-02":
			array_push($fetag2, $arrayitem);
			break;
			case "fetag-03":
			array_push($fetag3, $arrayitem);
			break;
			case "fetag-04":
			array_push($fetag4, $arrayitem);
			break;
			case "fetag-05":
			array_push($fetag5, $arrayitem);
			break;
			case "fetag-06":
			array_push($fetag6, $arrayitem);
			break;
			case "fetag-07":
			array_push($fetag7, $arrayitem);
			break;
			case "fetag-08":
			array_push($fetag8, $arrayitem);
			break;
			case "fetag-09":
			array_push($fetag9, $arrayitem);
			break;

		     default:
		         echo "Something Strange! <br>";
		}
		  




      //  echo "id: " . $row["epc"]. " - Name: " . $row["tic"]. " " . $row["lane"]. "<br>";
    }
} else { 	
    echo "0 results what?";
}
list($ab,$abtime)=comparetag1($etag1,$etag2);//******忠明文心-出城往西
list($bc,$bctime)=comparetag1($etag2,$etag3);//******文心黎明-出城往西
list($cd,$cdtime)=comparetag1($etag3,$etag4);
list($de,$detime)=comparetag1($etag4,$etag5);

list($dc,$dctime)=comparetag1($etag6,$etag7);
list($cb,$cbtime)=comparetag1($etag7,$etag8);

list($ab2,$ab2time) = comparetag1($fetag3,$fetag8);
list($bc2,$bc2time) = comparetag1($fetag8,$fetag1);
list($cd2,$cd2time) = comparetag1($fetag1,$fetag6);
list($de2,$de2time) = comparetag1($fetag6,$fetag4);

list($ed2,$ed2time)= comparetag1($fetag2,$fetag7);
list($dc2,$dc2time) = comparetag1($fetag7,$fetag9);
list($cb2,$cb2time) = comparetag1($fetag9,$fetag5);

$A1total  = count($etag1);
$A2total  = count($etag2);
$A3total  = count($etag3);
$A4total  = count($etag4);
$A5total  = count($etag5);
$A4rtotal = count($etag6);
$A3rtotal = count($etag7);
$A2rtotal = count($etag8);
$B1total = count($fetag3);
$B2total = count($fetag8);
$B3total = count($fetag1);
$B4total = count($fetag6);
$B5total = count($fetag4);
$B5rtotal = count($fetag2);
$B4rtotal = count($fetag7);
$B3rtotal = count($fetag9);
$B2rtotal = count($fetag5);
echo "count finish";

//出:3 8 1 6 4
//入:2 7 9 5 








//$sqlinsert = "INSERT INTO `total_data`( `ab`, `bc`, `cd`, `de`, `dc`, `cb`) VALUES (123,123,123,123,123,123)";
$sqlinsert = "INSERT INTO `total_data`(`Date`, `Time`, `AveragetimeA1`, `AveragetimeA2`, `AveragetimeA3`, `AveragetimeA4`,
 `AveragetimeA2r`, `AveragetimeA3r`, `AveragetimeB1`, `AveragetimeB2`, `AveragetimeB3`,
 `AveragetimeB4`, `AveragetimeB2r`, `AveragetimeB3r`, `AveragetimeB4r`, `AveragetotalA1`, `AveragetotalA2`, `AveragetotalA3`
 , `AveragetotalA4`, `AveragetotalA5`, `AveragetotalA2r`, `AveragetotalA3r`, `AveragetotalA4r`, 
 `AveragetotalB1`, `AveragetotalB2`, 
	`AveragetotalB3`, `AveragetotalB4`, `AveragetotalB5`, `AveragetotalB2r`, `AveragetotalB3r`, `AveragetotalB4r`
	, `AveragetotalB5r`,`DatanumA1`, `DatanumA2`, `DatanumA3`, `DatanumA4`, `DatanumA2r`, `DatanumA3r`, `DatanumB1`, 
	`DatanumB2`, `DatanumB3`, `DatanumB4`, `DatanumB2r`, `DatanumB3r`, `DatanumB4r`) VALUES ('$nowdate','$nowtimestr','$ab','$bc','$cd','$de','$cb',
	'$dc','$ab2','$bc2','$cd2','$de2','$cb2','$dc2','$ed2','$A1total',
	'$A2total','$A3total','$A4total','$A5total','$A2rtotal','$A3rtotal','$A4rtotal','$B1total','$B2total',
	'$B3total','$B4total','$B5total','$B2rtotal','$B3rtotal','$B4rtotal','$B5rtotal','$abtime','$bctime','$cdtime','$detime','$cbtime'
	,'$dctime','$ab2time','$bc2time','$cd2time','$de2time','$cb2time','$dc2time','$ed2time')";



//輸入到資料庫裡面
if (mysqli_query($link, $sqlinsert)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlinsert. "<br>" . mysqli_error($link);
}







function comparetag1($num1,$num2){//將兩個數字進行比較

	//global $etag1,$etag2,$etag3,$etag4,$etag5,$etag6,$etag7,$etag8;
	$carTime=0;
	$k=0;
	for($m = 0; $m < count($num1); $m++) 
	{ 
	    for($n = 0; $n < count($num2); $n++) 
	    { 
	        if ($num1[$m]['epc'] == $num2[$n]['epc']){ //當兩個etag重複
	        	$timedistance = strtotime($num2[$n]['time']) - strtotime($num1[$m]['time']);
	        	if($timedistance>0){
	        		
				$carTime=$carTime+(strtotime($num2[$n]['time']) - strtotime($num1[$m]['time']));//計算兩個etag的時間差,並將他們都加在一起
			
				//echo strtotime($num2[$n][8])."<br>";			
	             		$k++; //$k 代表多少車算進去

	        	}else {
	        		echo "someone have ride error on ".$num1[$m]['epc'] . " etc ! <br>";
	        	}
			
	        }else{ 
	             
	        } 
	    } 
	}
	if($k == 0){
		$kk = 0;
		


	}else{
		$kk = $k;

	}
	$output=$carTime/$kk;//這裡是在除上 流動車輛
	echo $output."<br>";
return array($output,$k);
}
?>

