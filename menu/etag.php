<?php
header("Content-Type:text/html; charset=utf-8");
$database = "etag" ;
$database_host = "localhost" ;
$database_user = "root";
$database_pass = "ursa0601";
$link = mysql_connect("$database_host","$database_user","$database_pass");
mysql_query("SET NAMES 'utf8'");
mysql_select_db("$database",$link);

		$str = "SELECT * FROM `total_data` ORDER BY Primarynumber DESC";
		$res = mysql_query($str);
		$num = mysql_num_rows($res);
		echo '<marquee direction="up" scrolldelay="250" height="125px" >';
		$arr = mysql_fetch_array($res);		
		$arrmin = array();

		//$arrmin['A1'] = round($arr["AveragetimeA1"]/60);
		$arrmin['A1'] = round($arr["AveragetimeA1"]/60);
		$arrmin['A2'] = round($arr["AveragetimeA2"]/60);
		$arrmin['A3'] = round($arr["AveragetimeA3"]/60);
		$arrmin['A4'] = round($arr["AveragetimeA4"]/60);
		$arrmin['A2r'] = round($arr["AveragetimeA2r"]/60);
		$arrmin['A3r'] = round($arr["AveragetimeA3r"]/60);

		echo '忠明往文心路(五權路段)'.$arrmin["A1"].'分鐘<br>';
		echo '文心往黎明路(五權路段)'.$arrmin["A2"].'分鐘<br>';
		echo '黎明往向上路(五權路段)'.$arrmin["A3"].'分鐘<br>';
		echo '向上往環中路(五權路段)'.$arrmin["A4"].'分鐘<br>';
		echo '黎明往文心路(五權路段)'.$arrmin["A2r"].'分鐘<br>';
		echo '向上往黎明路(五權路段)'.$arrmin["A3r"].'分鐘<br>';
		


		// echo '忠明往文心路(五權路段)'.$arr["AveragetimeA1"].'秒<br>';
		// echo '文心往黎明路(五權路段)'.$arr["AveragetimeA2"].'秒<br>';
		// echo '黎明往向上路(五權路段)'.$arr["AveragetimeA3"].'秒<br>';
		// echo '向上往環中路(五權路段)'.$arr["AveragetimeA4"].'秒<br>';
		// echo '黎明往文心路(五權路段)'.$arr["AveragetimeA2r"].'秒<br>';
		// echo '向上往黎明路(五權路段)'.$arr["AveragetimeA3r"].'秒<br>';
		
		echo '</marquee>';
?>        