<?php
    $host = 'localhost';
	$dbuser = 'root';
	$dbpw = '123456';
	$dbname = 'last';
	
	$link = mysqli_connect($host,$dbuser,$dbpw,$dbname);
	
	if($link){
		mysqli_set_charset($link,"utf8");
		$db = mysqli_select_db($link,$dbname);
		if($db){
			//echo "以正確連接資料庫:" . $dbname;
		}
		else{
			echo "未能連接資料庫 {$dbname} ，錯誤訊息:<br/>" . mysqli_error($link);
		}
	}
	else{
		echo "無法連接mysql資料庫:<br/>" . mysqli_error($link);
	}
?>