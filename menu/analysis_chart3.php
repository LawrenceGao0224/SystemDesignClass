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

$sql = "SELECT * FROM `total_data` where `Time` between '$nowtime70' and '$nowtime' ORDER BY `Primarynumber` DESC LIMIT 13  " ;
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) { //檢查是否有資料  
    // output data of each row
    $number =0;
    while($row = mysqli_fetch_array($result)) {

        $singlearray = array();
        $singlearray['Date'] = $row['Date'];
        $singlearray['Time'] = $row['Time'];

        $singlearray['timeA1']=$row['AveragetimeA1'];//忠明文心
        $singlearray['timeA2']=$row['AveragetimeA2'];//文心黎明
        $singlearray['timeA3']=$row['AveragetimeA3'];//黎明向上
        $singlearray['timeA4']=$row['AveragetimeA4'];//向上環中
        $singlearray['timeA2r']=$row['AveragetimeA2r'];//黎明文心
        $singlearray['timeA3r']=$row['AveragetimeA3r'];//向上黎明
        $singlearray['timeB1']=$row['AveragetimeB1'];
        $singlearray['timeB2']=$row['AveragetimeB2'];
        $singlearray['timeB3']=$row['AveragetimeB3'];
        $singlearray['timeB4']=$row['AveragetimeB4'];
        $singlearray['timeB2r']=$row['AveragetimeB2r'];
        $singlearray['timeB3r']=$row['AveragetimeB3r'];
        $singlearray['timeB4r']=$row['AveragetimeB4r'];

       
        $singlearray['totalA1']=$row['AveragetotalA1'];        
        $singlearray['totalA2']=$row['AveragetotalA2'];
        $singlearray['totalA3']=$row['AveragetotalA3'];
        $singlearray['totalA4']=$row['AveragetotalA4'];
        $singlearray['totalA5']=$row['AveragetotalA5'];
        $singlearray['totalA2r']=$row['AveragetotalA2r'];
        $singlearray['totalA3r']=$row['AveragetotalA3r'];
        $singlearray['totalA4r']=$row['AveragetotalA4r'];
        $singlearray['totalB1']=$row['AveragetotalB1'];
        $singlearray['totalB2']=$row['AveragetotalB2'];
        $singlearray['totalB3']=$row['AveragetotalB3'];
        $singlearray['totalB4']=$row['AveragetotalB4'];
        $singlearray['totalB5']=$row['AveragetotalB5'];
        $singlearray['totalB2r']=$row['AveragetotalB2r'];
        $singlearray['totalB3r']=$row['AveragetotalB3r'];
        $singlearray['totalB4r']=$row['AveragetotalB4r'];
        $singlearray['totalB5r']=$row['AveragetotalB5r'];

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
                        var series6 = this.series[6];

                         
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
                               url: "http://210.65.139.17/tom/menu/echodata.php",
                               data:{
                                  Hi: "yoyyo",
                                  Yoo: "yoooo"

                              },
                               //contentType: "application/json",
                               dataType: 'json', //datatype是指他回船後的東西
                               success: function(request){
                              //  var myResult = $.parseJSON(data);
                                //var  myResult = JSON.parse(data);
                                       // myResult.timeA1
                                    //   alert(data);
                                  
                                   //      alert(data['Datetime']);
                                       var x = request['Datetime'];
                                       x=x + (1000*60*60*8);
                                       var xx = new Date(x);


                                  //     alert(request['Datetime'] + " and " + request['timeA1']);
                                    //  var xx = new Date().getTime();

                             
                                       var timeA1 = request['timeA1'];
                                       var timeA2 = request['timeA2'];
                                       var timeA3 = request['timeA3'];
                                       var timeA4 = request['timeA4'];
                                       var timeA2r = request['timeA2r'];
                                       var timeA3r = request['timeA3r'];
                                       var timeB1 = request['timeB1'];
                                       var timeB2 = request['timeB2'];
                                       var timeB3 = request['timeB3'];
                                       var timeB4 = request['timeB4'];
                                       var timeB2r = request['timeB2r'];
                                       var timeB3r = request['timeB3r'];
                                       var timeB4r = request['timeB4r'];
                                      //x=x + (1000*60*60*8);
                                      



                                     series0.addPoint({x:xx,y:Number(timeB1)},false,true);
                                     series1.addPoint({x:xx,y:Number(timeB2)},false,true);
                                     series2.addPoint({x:xx,y:Number(timeB3)},false,true);
                                     series3.addPoint({x:xx,y:Number(timeB4)},false,true);
                                     series4.addPoint({x:xx,y:Number(timeB2r)},false,true);
                                     series5.addPoint({x:xx,y:Number(timeB3r)},false,true);
                                     series6.addPoint({x:xx,y:Number(timeB4r)},true,true);
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
      text: '中清路',
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
            name: '健行往忠明路',
           
            data: 
           // [nowtime.getTime()- 300*1000*12, 1.18],
           //
      
           <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                     echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB1']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";
//{x:1451505900000,y:209.54},
                
                }  
                 echo "]";


                ?>
        }, {
            name: '忠明往漢口路',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                    // echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeB2']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB2']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '漢口往文心路',
            data: 
              <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                          echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB3']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '文心往環中路',
            data:   <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                          echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB4']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>
        }, {
            name: '漢口往忠明路',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
      //                     echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeB2r']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB2r']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '文心往漢口路',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                    // echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeB3r']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB3r']. "}";
                     if ($i != 0 ){
                        echo ",";
                     }
                     echo "\n";

                
                }  
                 echo "]";


                ?>

        }, {
            name: '環中往文心路',
            data:     <?php   
            echo "[";
           for($i = count($mydataarray)-1; $i>=0;$i-- ){
                $mDate = $mydataarray[$i]['Date']; 
                $mTime =  $mydataarray[$i]['Time']; 
                $myDatetime = strtotime($mDate. " ". $mTime) * 1000 + 8*60*60*1000;
                    // echo "[".  $myDatetime. "," .  $mydataarray[$i]['timeB3r']. "]";
                    echo "{x:".  $myDatetime. ",y:".  $mydataarray[$i]['timeB4r']. "}";
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
// </div>    // for html @_@




    //加點點在這裡加 chart1.
});
</script>

</head>
<body>

<div id="containerchart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<div id="containerchart2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>
</html>
