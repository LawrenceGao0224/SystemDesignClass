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
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&language=zh-TW"></script>
<!-- Require jQuery v1.7.0 or newer --> 
<!-- jQuery (Bootstrap 所有外掛均需要使用) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="jquery.tinyMap.js"></script>  
<!-- point_map -->
    
<script>

function attachMessage(marker, Message) {
  var infowindow = new google.maps.InfoWindow({
    content: Message
  });

  marker.addListener('click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}

// This example adds a marker to indicate the position
// of Bondi Beach in Sydney, Australia
function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(24.164212, 120.659862)//初始畫面位置
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	var Drd = {//大雅路 - 遠傳
	  url: 'images/map-pointer1.png',
	  size: new google.maps.Size(35, 35),
	  scaledSize: new google.maps.Size(35, 35)
	}; 
	
	var Wrd = { //五權 - 中華
	  url: 'images/map-pointer2.png',
	  size: new google.maps.Size(35, 35),
	  scaledSize: new google.maps.Size(35, 35)
	}; 
  var Trd = {//台灣大道和市政路
      url: 'images/map-pointer3.png',
      size:new google.maps.Size(35, 35),
      scaledSize: new google.maps.Size(35, 35)
  }




  var myLatT1 = new google.maps.LatLng(24.17485 ,120.63188);//台灣大道環中路口(出城)
  var beachMarker = new google.maps.Marker({
      position: myLatT1,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道環中路口");

  var myLatT2 = new google.maps.LatLng(24.18301 ,120.60297);// 台灣大道東大路口(出城)
  var beachMarker = new google.maps.Marker({
      position: myLatT2,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道東大路口");

  var myLatT3 = new google.maps.LatLng(24.17282 ,120.63407);//台中交流道下匝道(進城)
  var beachMarker = new google.maps.Marker({
      position: myLatT3,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台中交流道下匝道");

  var myLatT4 = new google.maps.LatLng(24.16245 ,120.64963);//台灣大道文心路口(進城)
  var beachMarker = new google.maps.Marker({
      position: myLatT4,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道文心路口");

  var myLatT5 = new google.maps.LatLng(24.16244, 120.63084);//市政路龍門路口(進城)
  var beachMarker = new google.maps.Marker({
      position: myLatT5,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "市政路龍門路口");

  var myLatT6 = new google.maps.LatLng(24.15711, 120.65957);//台灣大道忠明路口(出城)
  var beachMarker = new google.maps.Marker({
      position: myLatT6,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道忠明路口");

  var myLatT7 = new google.maps.LatLng(24.18258 ,120.60261);//台灣大道東大路口(進城)
  var beachMarker = new google.maps.Marker({
      position: myLatT7,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道東大路口");

  var myLatT8 = new google.maps.LatLng(24.15609 ,120.64385);//市政路惠文路口(進城)
  var beachMarker = new google.maps.Marker({
      position: myLatT8,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "市政路惠文路口");

  var myLatT9 = new google.maps.LatLng(24.16272 ,120.64957);//台灣大道文心路口(出城)
  var beachMarker = new google.maps.Marker({
      position: myLatT9,
      map: map,
      icon:Trd
  });
   attachMessage(beachMarker, "台灣大道文心路口");










  var myLatC1 = new google.maps.LatLng(24.16689018207709, 120.67324876785278);//漢口路(出)
  var beachMarker = new google.maps.Marker({
      position: myLatC1,
      map: map,
      icon:Drd
  });
   attachMessage(beachMarker, "漢口路,中清路");



   var myLatC2 = new google.maps.LatLng(24.199520959325895,120.65563201904297 );//環中路(入)
  var beachMarker = new google.maps.Marker({
      position: myLatC2,
      map: map,
      icon: Drd
  });

    attachMessage(beachMarker, "環中路,中清路");
  
   var myLatC3 = new google.maps.LatLng(24.159264691835148, 120.67580223083496);//健行路(出)
  var beachMarker = new google.maps.Marker({
      position: myLatC3,
      map: map,
      icon: Drd
  });
  attachMessage(beachMarker, "健行路,中清路");
  
   var myLatC4 = new google.maps.LatLng(24.199591907979883, 120.65578758716583);//環中路(出)
  var beachMarker = new google.maps.Marker({
      position: myLatC4,
      map: map,
      icon: Drd
  });
  attachMessage(beachMarker, "環中路,中清路");
   var myLatC5 = new google.maps.LatLng(24.162955133570744,120.67448794841766);//忠明路(入)
  var beachMarker = new google.maps.Marker({
      position: myLatC5,
      map: map,
      icon: Drd
  });
  attachMessage(beachMarker, "忠明路,中清路");
   var myLatC6 = new google.maps.LatLng(24.173888787095343, 120.67126393318176);//文心路(出)
  var beachMarker = new google.maps.Marker({
      position: myLatC6,
      map: map,
      icon: Drd
  });
    attachMessage(beachMarker, "文心路,中清路");
   var myLatC7= new google.maps.LatLng(24.17381048314763, 120.67145705223083);//文心路(入)
  var beachMarker = new google.maps.Marker({
      position: myLatC7,
      map: map,
      icon: Drd
  });
    attachMessage(beachMarker, "文心路,中清路");
   var myLatC8 = new google.maps.LatLng(24.162881717334432, 120.67445039749146);//忠明路(出)
  var beachMarker = new google.maps.Marker({
      position: myLatC8,
      map: map,
      icon: Drd
  });
    attachMessage(beachMarker, "忠明路,中清路");
  var myLatC9 = new google.maps.LatLng( 24.16689018207709, 120.67324876785278);//漢口路(入)
  var beachMarker = new google.maps.Marker({
      position: myLatC9,
      map: map,
      icon: Drd
  });
    attachMessage(beachMarker, "漢口路,中清路");
  
  //*****************
  
  var myLatB = new google.maps.LatLng(24.140165, 120.657126);//
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
  attachMessage(beachMarker, "忠明南路, 五權西路");

  
  var myLatB = new google.maps.LatLng(24.140033, 120.646488);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "文心路一段,五權西路");

  var myLatB = new google.maps.LatLng(24.142453, 120.637607);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "黎明路二段,五權西路");

  var myLatB = new google.maps.LatLng(24.145645, 120.632337);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "五權西路二段,向上路三段");

  var myLatB = new google.maps.LatLng(24.149779, 120.623153);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "五權西路二段, 環中路四段");

  var myLatB = new google.maps.LatLng(24.145381, 120.632546);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "五權西路二段,向上路三段");

  var myLatB = new google.maps.LatLng(24.142324, 120.637999);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
    attachMessage(beachMarker, "黎明路二段 五權西路二段");

  var myLatB = new google.maps.LatLng(24.140035, 120.647011);//xxxx
  var beachMarker = new google.maps.Marker({
      position: myLatB,
      map: map,
      icon: Wrd
  });
   attachMessage(beachMarker, "五權西路, 文心路一段");
 
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>

<body>
<form name="myform" action="point_map.php" method="post" enctype="multipart/form-data" />
<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
<input type="hidden" name="proj_id" id="proj_id" value="<?=$proj_id?>"  />
<input type="hidden" name="event_id" id="event_id" value="<?=$event_id?>"  />
<input type="hidden" name="employ" id="employ" /><!--使用編號-->
<input type="hidden" name="fid" id="fid" /><!--function內部切換-->
<input type="hidden" name="act" id="act" /><!--function第二階段切換-->
<input type="hidden" name="param1" id="param1" />
<input type="hidden" name="param2" id="param2" /><!--新增影片事件-->
<input type="hidden" name="param3" id="param3" value="<?=$param3?>"/><!--檔案上傳檔名-->
<input type="hidden" name="param4" id="param4" value="<?=$param4?>"/> <!--拖曳上傳檔名-->
<input type="hidden" name="param5" id="param5" value="<?=$param5?>"/> <!--選檔上傳檔名-->
<div class="container"><!--響應式網頁S-->
<div class="row">
      <h1>
            etag
            <small>點位分佈圖</small>
          </h1> 

<table width='100%' border='1' align='center' >
    <tr>
    	<td width="700px" height="700px">
      	<div id="map-canvas" style="width:100%; height:100%"></div>
    	</td>        
     
    </tr>
</table>
<br>
</div>
</div><!--響應式網頁E-->
</body>
</html>

