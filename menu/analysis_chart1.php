<!DOCTYPE html>

<?php
session_start();
$_SESSION["pass"] = "this is my password"; 

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
$nowtime70=date("H:i:s",strtotime($nowtime."-70 min"));//現在時間往前40分
$nowtimestr = substr($nowtime, 0, -2);
$nowtimestr = $nowtimestr."00"; //xx:xx:00

//echo $nowtime5;
$mydataarray = array();
$mytime = "3:00:00";
$mytime2 = "4:00:00";

$sql = "SELECT * FROM `total_data2` where `Time` between '$nowtime70' and '$nowtime' ORDER BY `Primarynumber` DESC LIMIT 13  " ;
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) { //檢查是否有資料  
    // output data of each row
    $number =0;
    while($row = mysqli_fetch_array($result)) {

        $singlearray = array();
        $singlearray['Date'] = $row['Date'];
        $singlearray['Time'] = $row['Time'];

        $singlearray['timeC1']=$row['AveragetimeC1'];//忠明文心
        $singlearray['timeC2']=$row['AveragetimeC2'];//文心黎明
        $singlearray['timeC3']=$row['AveragetimeC3'];//黎明向上
        $singlearray['timeC2r']=$row['AveragetimeC2r'];//黎明文心
        $singlearray['timeC3r']=$row['AveragetimeC3r'];//向上黎明
        $singlearray['timeD1']=$row['AveragetimeD1'];
      

       
        $singlearray['totalC1']=$row['AveragetotalC1'];        
        $singlearray['totalC2']=$row['AveragetotalC2'];
        $singlearray['totalC3']=$row['AveragetotalC3'];
        $singlearray['totalC4']=$row['AveragetotalC4'];
        $singlearray['totalC2r']=$row['AveragetotalC2r'];
        $singlearray['totalC3r']=$row['AveragetotalC3r'];
        $singlearray['totalC4r']=$row['AveragetotalC4r'];
        $singlearray['totalD1']=$row['AveragetotalD1'];
        $singlearray['totalD2']=$row['AveragetotalD2'];
        $mydataarray[$number] = $singlearray;


        $number ++;
    }
} else {    
    echo "something error  : no data <br> ";
}
//取出值的方法   ==>   QAQ>  $mydataarray[0]['totalA1'] 取出值的方法 
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>


$(document).ready(function(){ //http://jsfiddle.net/kwtZr/1/
    //http://jsfiddle.net/jugal/4Skzq/



      var nowtime = new Date();
       nowtime.setHours(nowtime.getHours()+8);
     var chartoptions = {
        chart: {
        type:'spline',
        renderTo:'containerchart',
        animation: Highcharts.svg,
        
              events: {
                    load: function () {
                        //this can set up outside either
                        //Don't need to set here 
                        //chart
                        // set up the updating of the chart each second
                        // chart.series[0].addPoint({
                        //     x: x[i],
                        //     y: y[i],
                        //     id: id[i]
                        // },false);
                        // chart.redraw();

                        var series0 = this.series[0];
                        var series1 = this.series[1];
                        var series2 = this.series[2];
                        var series3 = this.series[3];
                        var series4 = this.series[4];
                        var series5 = this.series[5];

                         
                       setInterval(function () {


                    
                        //         var x = new Date().getTime(), // current time
                        //         y = Math.random();
                        //    series0.addPoint([x, y], false, true);
                        //     y = Math.random();
                        //    series1.addPoint([x, y], false, true);
                        //     y = Math.random();
                        //    series2.addPoint([x, y], false, true);
                        //     y = Math.random();
                        //    series3.addPoint([x, y], false, true);
                        //    series4.addPoint([x,122],false,true);
                        // series5.addPoint([x,123],true,true);
   //ajax begin
                           $.ajax({
                               type: "POST",
                               url: "http://210.65.139.17/tom/menu/echodata2.php",
                               data:{
                                  Hi: "yoyyo",
                                  Yoo: "yoooo"

                              },
                               //contentType: "application/json",
                               dataType: 'json', //datatype是指他回船後的東西
                               success: function(request){
                              //  var myResult = $.parseJSON(data);
                                //var  myResult = JSON.parse(data);
                                       // myResult.timeC1
                                    //   alert(data);
                                  
                                   //      alert(data['Datetime']);
                                       var x = request['Datetime'];
                                       x=x + (1000*60*60*8);
                                       var xx = new Date(x);


                                  //     alert(request['Datetime'] + " and " + request['timeA1']);
                                    //  var xx = new Date().getTime();

                             
                                       var timeC1 = request['timeC1'];
                                       var timeC2 = request['timeC2'];
                                       var timeC3 = request['timeC3'];
                                   
                                       var timeC2r = request['timeC2r'];
                                       var timeC3r = request['timeC3r'];
                      
                                       var timeD1 = request['timeD1'];
                        
                                   



                                     series0.addPoint({x:xx,y:Number(timeC1)},false,true);
                                     series1.addPoint({x:xx,y:Number(timeC2)},false,true);
                                     series2.addPoint({x:xx,y:Number(timeC3)},false,true);
                                     series3.addPoint({x:xx,y:Number(timeC2r)},false,true);
                                     series4.addPoint({x:xx,y:Number(timeC3r)},false,true);
                                     series5.addPoint({x:xx,y:Number(timeD1)},true,true);


                                     // series0.addPoint({x:xx,y:Number()},false,true);
                                     // series1.addPoint({x:xx,y:2222},false,true);
                                     // series2.addPoint({x:xx,y:321},false,true);
                                     // series3.addPoint({x:xx,y:222},false,true);
                                     // series4.addPoint({x:xx,y:2},false,true);
                                     // series5.addPoint({x:xx,y:321},true,true);

                                   
                                    

                                   },
                               error: function(){
                                alert('更新交通資料失敗!');
                            }

                        });
                        
},1000*60*5);//setinterval end
                    }
                }
        },
    title: {
      text: '旅行時間分析圖',
      x: -20 //center
    },
    credits: {
      enabled: false
   },
   
    subtitle: {
      text: '中港路',
      x: -20
    },
    xAxis: {
        type:'datetime'
 //     categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
//        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
      title: {
        text: '花費總時間'
      },
      plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip: {
      valueSuffix: 'sec'
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
    },
    series: [{
            name: '忠明往文心路',
           
            data: 
           // [nowtime.getTime()- 300*1000*12, 1.18],
           //
      
           <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                     echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeC1']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";
//{x:1451505900000,y:209.54},
                
                }  
                 echo "]";


                ?>
        }, {
            name: '文心往環中路',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                    // echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeC2']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeC2']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '環中往東大路',
            data: 
              <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                          echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeC3']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '台中交流道往文心',
            data:   <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                          echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeC2r']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>
        }, {
            name: '東大往台中交流道',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
      //                     echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeC2r']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeC3r']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '龍門往惠文路(在市政路上)',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                    // echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeC3r']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeD1']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }]
  };
    //$('#containerchart').chart(chartoptions);
 //   chart1 = new Highcharts.Chart(chartOptions);
 // chartoption = jQuery.extend(true, {}, options, chart1Options);
    var chart1 = new Highcharts.Chart(chartoptions);
   // var chart1 = new Highcharts.StockChart( $.extend(true, {}, chartoptions) );
//    var chart2 = new Highcharts.Chart(chartoptions);






// <div><img src="images/etagb.jpg" width="600" height="200" alt="" align = "center" longdesc="images/etagb.jpg"></div>
//   <div> <img src="images/etaga.jpg" width="600" height="200" alt="" longdesc="images/etaga.jpg">
// </div>   for html @_@


    //加點點在這裡加 chart1.
});
</script>

</head>
<body>
  
<div id="containerchart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<div id="containerchart2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>
</html>
