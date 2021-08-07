<?php
// session_start();
// if(isset($_SESSION['pass'])){
// 	if($_SESSION['pass'] == "this is my password"){
// 		if(isset($_POST['Hi'])){//Confirm user

			$database = "etag" ;
		
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

			// $sqltable1="tce01_".$nowdate;
			// $sqltable2="tce02_".$nowdate;
			//$sqltable = "tce01_20151218";

			$sql = "SELECT * FROM `total_data2` ORDER BY `Primarynumber` DESC LIMIT 1 " ;
			$result = mysqli_query($link, $sql);
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {

			    	$mDate = $row['Date']; 
                		$mTime =  $row['Time'];
             			$myDatetime = strtotime($mDate. " ". $mTime) * 1000;
             		
			    	$jsondata = array();
			       $jsondata['Datetime'] = $myDatetime;//這是給javascript 用的 所以要程上1000
			       
			       $jsondata['timeC1']=$row['AveragetimeC1'];        
			       $jsondata['timeC2']=$row['AveragetimeC2'];
			       $jsondata['timeC3']=$row['AveragetimeC3'];
			       $jsondata['timeC2r']=$row['AveragetimeC2r'];
			       $jsondata['timeC3r']=$row['AveragetimeC3r'];
			       $jsondata['timeD1']=$row['AveragetimeD1'];

			       
			       $jsondata['totalC1']=$row['AveragetotalC1'];        
			       $jsondata['totalC2']=$row['AveragetotalC2'];
			       $jsondata['totalC3']=$row['AveragetotalC3'];
			       $jsondata['totalC4']=$row['AveragetotalC4'];
			       $jsondata['totalC2r']=$row['AveragetotalC2r'];
			       $jsondata['totalC3r']=$row['AveragetotalC3r'];
			       $jsondata['totalC4r']=$row['AveragetotalC4r'];
			       $jsondata['totalD1']=$row['AveragetotalD1'];
			       $jsondata['totalD2']=$row['AveragetotalD2'];
			       header('Content-Type: application/json');



			       $jsondata = json_encode($jsondata);
			       echo $jsondata;

			    	
			   
			    }
			} else {
				
			    echo "for no results what?";
			}






// 		}//Confirm user end

// 	}

// }else{
// 	echo "Hi this is my world! <br> Who are you? ";
// }



?>