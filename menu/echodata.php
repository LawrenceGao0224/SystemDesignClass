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

			$sqltable1="tce01_".$nowdate;
			$sqltable2="tce02_".$nowdate;
			//$sqltable = "tce01_20151218";

			$sql = "SELECT * FROM `total_data` ORDER BY `Primarynumber` DESC LIMIT 1 " ;
			$result = mysqli_query($link, $sql);
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {

			    	$mDate = $row['Date']; 
                		$mTime =  $row['Time'];
             			$myDatetime = strtotime($mDate. " ". $mTime) * 1000;
             		
			    	$jsondata = array();
			       $jsondata['Datetime'] = $myDatetime;//這是給javascript 用的 所以要程上1000
			 

			       $jsondata['timeA1']=$row['AveragetimeA1'];        
			       $jsondata['timeA2']=$row['AveragetimeA2'];
			       $jsondata['timeA3']=$row['AveragetimeA3'];
			       $jsondata['timeA4']=$row['AveragetimeA4'];
			       $jsondata['timeA2r']=$row['AveragetimeA2r'];
			       $jsondata['timeA3r']=$row['AveragetimeA3r'];
			       $jsondata['timeB1']=$row['AveragetimeB1'];
			       $jsondata['timeB2']=$row['AveragetimeB2'];
			       $jsondata['timeB3']=$row['AveragetimeB3'];
			       $jsondata['timeB4']=$row['AveragetimeB4'];
			       $jsondata['timeB2r']=$row['AveragetimeB2r'];
			       $jsondata['timeB3r']=$row['AveragetimeB3r'];
			       $jsondata['timeB4r']=$row['AveragetimeB4r'];

			       
			       $jsondata['totalA1']=$row['AveragetotalA1'];        
			       $jsondata['totalA2']=$row['AveragetotalA2'];
			       $jsondata['totalA3']=$row['AveragetotalA3'];
			       $jsondata['totalA4']=$row['AveragetotalA4'];
			       $jsondata['totalA5']=$row['AveragetotalA5'];
			       $jsondata['totalA2r']=$row['AveragetotalA2r'];
			       $jsondata['totalA3r']=$row['AveragetotalA3r'];
			       $jsondata['totalA4r']=$row['AveragetotalA4r'];
			       $jsondata['totalB1']=$row['AveragetotalB1'];
			       $jsondata['totalB2']=$row['AveragetotalB2'];
			       $jsondata['totalB3']=$row['AveragetotalB3'];
			       $jsondata['totalB4']=$row['AveragetotalB4'];
			       $jsondata['totalB5']=$row['AveragetotalB5'];
			       $jsondata['totalB2r']=$row['AveragetotalB2r'];
			       $jsondata['totalB3r']=$row['AveragetotalB3r'];
			       $jsondata['totalB4r']=$row['AveragetotalB4r'];
			       $jsondata['totalB5r']=$row['AveragetotalB5r'];
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