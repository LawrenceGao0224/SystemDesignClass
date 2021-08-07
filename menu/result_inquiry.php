<!doctype html>
<?php
//require("../link.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>旅行時間資訊服務網頁</title>

<!-- 最新編譯和最佳化的 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- 選擇性佈景主題 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Include Google Maps API (Google Maps API v3 已不需使用 API Key) -->
<!-- Require jQuery v1.7.0 or newer -->
<!-- jQuery (Bootstrap 所有外掛均需要使用) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script src="jquery.tinyMap.js"></script>  -->
<!-- point_map -->
<style>
.left {

   margin-left: 2cm;

}
</style>
<script>

</script>

</head>

<body>
<form name="myform" action="result_inquiry.php" method="post" enctype="multipart/form-data" />
<div class="container"><!--響應式網頁S-->
<div class="row">
<h1>
            etag
            <small>旅行時間查詢</small>
          </h1>


    <div class="form-group col-md-12">
      <label for="date">查詢日期:</label>
      <input type="text" class="form-control " placeholder="2016/01/12" id="date" name = "date" value = "<?php echo $_POST['date'];?>">
    </div>  

    <div class="form-group col-md-6">
      <label for="timebegin">查詢時間 起:</label>
      <input type="text" class="form-control " placeholder="11:00" id="timebegin" name = "timebegin" value = "<?php echo $_POST['timebegin'];?>">
    </div>  

    <div class="form-group col-md-6">
      <label for="timeend">查詢時間 迄:</label>
      <input type="text" class="form-control "  placeholder="15:00" id="timeend" name = "timeend" value = "<?php echo $_POST['timeend'];?>">
    </div>
    <div class="form-group col-md-12">
      <label for="road">選擇路線:</label>
      <select class="form-control" id="road" name = "road">
        <option value = "A">台灣大道,市政路</option>
        <option value = "B">五權西路</option>
        <option value = "C">中清路</option>
      </select>
      <br>

       <button type="submit" class="btn btn-primary left pull-left">查詢</button>

    </div>


 




<?php

if($_POST['timebegin']!= '' && $_POST['timeend']!='' && $_POST['date']!=''){
 // echo "hi2";
  $timebegin = $_POST['timebegin'];
  $timeend = $_POST['timeend'];
  $date = $_POST['date'];



  $database = "etag" ;
  $database_host = "localhost" ;
  $database_user = "root";
  $database_pass = "ursa0601";
  $link = mysqli_connect($database_host,$database_user,$database_pass,$database);
  
  $nowdate=date("Ymd");
  $nowtime=date("H:i:s");//現在時間
  $nowtime5=date("H:i:s",strtotime($nowtime."-5 min"));//現在時間往前5分
  $nowtime70=date("H:i:s",strtotime($nowtime."-70 min"));//現在時間往前40分
  $nowtimestr = substr($nowtime, 0, -2);
  $nowtimestr = $nowtimestr."00"; //xx:xx:00
  $road = $_POST['road'];


  if($_POST['road'] == 'A' ){//中港路
      $sqltable = "total_data2";

      $roadsql = " `Date`, `Time`, `Currenttime`, `AveragetimeC1`, `AveragetimeC2`, `AveragetimeC3`,
       `AveragetimeC2r`, `AveragetimeC3r`, `AveragetimeD1`, `AveragetotalC1`, `AveragetotalC2`, `AveragetotalC3`, 
       `AveragetotalC4`, `AveragetotalC2r`, `AveragetotalC3r`, `AveragetotalC4r`, `AveragetotalD1`, `AveragetotalD2` ";
       $roadarray = array('日期','時間','系統輸入時間','忠明往文心路','文心往環中路','環中往東大路','台中交流道往文心','東大往台中交流道',
        '龍門往惠文路(在市政路上)','台灣大道忠明路口(出城)','台灣大道文心路口(出城)','台灣大道環中路口(出城)','台灣大道東大路口(出城)'
        ,'台灣大道文心路口(進城)','台中交流道下匝道(進城)','台灣大道文心路口(進城)','市政路龍門路口(進城)','市政路惠文路口(進城)');


  }else if($_POST['road'] == 'B' ){ //五權西路
  $sqltable = "total_data";
   $roadsql = " `Date`, `Time`, `Currenttime`, `AveragetimeA1`, `AveragetimeA2`, `AveragetimeA3`,
       `AveragetimeA4`, `AveragetimeA2r`, `AveragetimeA3r`, `AveragetotalA1`, `AveragetotalA2`, `AveragetotalA3`,
        `AveragetotalA4`, `AveragetotalA5`, `AveragetotalA2r`, `AveragetotalA3r`, `AveragetotalA4r`";
   $roadarray = array('日期','時間','系統輸入時間','忠明往文心路','文心往黎明路','黎明往向上路'
    ,'向上往環中路','黎明往文心路','向上往黎明路','忠明路(出城)','文心路(出城)','黎明路(出城)',
    '向上路(出城)往西','環中路(出城)','文心路(入城)','黎明路(入城)', '向上路(入城)');
  }else{ // "C"  中清路
      $sqltable = "total_data";
       $roadsql = "`Date`, `Time`, `Currenttime`,`AveragetimeB1`, `AveragetimeB2`, `AveragetimeB3`, `AveragetimeB4`, 
  `AveragetimeB2r`, `AveragetimeB3r`, `AveragetimeB4r`,  `AveragetotalB1`, `AveragetotalB2`, `AveragetotalB3`, `AveragetotalB4`,
   `AveragetotalB5`, `AveragetotalB2r`, `AveragetotalB3r`, `AveragetotalB4r`, `AveragetotalB5r`";
  $roadarray = array('日期','時間','系統輸入時間','健行往忠明路','忠明往漢口路','漢口往文心路','文心往環中路',
    '漢口往忠明路', '文心往漢口路','環中往文心路','健行路(出城)','忠明路(出城)','漢口路(出城)','文心路(出城)'
    ,'環中路(出城)','忠明路(入城)','漢口路(入城)','文心路(入城)','環中路(入城)');
  }


$sql = "SELECT ". $roadsql . " FROM `$sqltable` where `Date` = '$date' AND (`Time` between '$timebegin' and '$timeend') " ;
//$sql = "SELECT * FROM `$sqltable` LIMIT 10";
//echo $sql;
$result = mysqli_query($link, $sql);


if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


echo "<table  align = center class = 'table table-hover table-bordered'> ";
echo "<tr bgcolor = '#EEF0A3'>";
//while ($field = mysqli_fetch_field($result)){
foreach ($roadarray as $key => $roadname) {
   echo "<td align = center>".$roadname."</td>";
 
}
echo "</tr>";
while($record = mysqli_fetch_row($result)){
  echo "<tr>";
  for($i=0;$i<count($record);$i++){
    echo "<td align = center>".$record[$i]."</td>";
    
  }
  echo "<tr>";
}
echo "</table>";



}
?>




<br>
</div>
</div><!--響應式網頁E-->
</body>
</html>