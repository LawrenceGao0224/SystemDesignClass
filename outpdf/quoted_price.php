<!doctype html>
<?php
require("../link.php");
require("../mirle_func.php");
require("../sql_func.php");
require("../config.php");
load_variables();
date_default_timezone_set("Asia/Taipei");//時間用
$today=date("Y-m-d");//今天

//quoted_price 報價清單

/**** 執行SQL ****/
if($fid=="sqlNewQuoted"){ //新增
	$done=sqlNewQuoted();
}

?>
<html>
<head>
<meta charset="utf-8">
<title>產品報備表</title>

<script src='../js_func.js' type=text/javascript></script><!--載入javascript方法-->

<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!--****jquery-日期選擇器套件(S)****-->
<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>
$(function() {
  $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
});
</script>
<!--****jquery-日期選擇器套件(E)****-->  

<script>
//全局變量
var i=0;
/**增加一行記錄**/
function addMyRow(){
	var mytable = document.getElementById("mybody");   
	var mytr = mytable.insertRow();    //插入行
	mytr.setAttribute("id","tr"+i);    //設定行id
	//插入行單元格的值
	//mytr.insertCell(0).innerHTML = i+1;
	mytr.insertCell(0).innerHTML="<input type='text' class='form-control' name='name[]' id='name"+i+"' size='12' value='' />";
	mytr.insertCell(1).innerHTML="<input type='text' class='form-control' name='specification[]' id='specification"+i+"' size='25' value='' />";
	mytr.insertCell(2).innerHTML="<input type='text' class='form-control' name='quantity[]' id='quantity"+i+"' size='8' value=''  onChange='total("+i+")'/>";
	mytr.insertCell(3).innerHTML="<input type='text' class='form-control' name='money[]' id='money"+i+"' size='8' value=''  onChange='total("+i+")'/>";
	mytr.insertCell(4).innerHTML="<input type='text' class='form-control' name='sum_money[]' id='sum_money"+i+"' size='12' value=''  onChange='total("+i+")'/>";
	i++;
}

/**計算金額**/
function sumPrice(i){
	var sumprice=0;
	var quantity = document.getElementById ("quantity"+i).value;
	var money = document.getElementById ("money"+i).value;
	//alert("數量=="+num+" 價格=="+price);
	if(quantity!="" && money!=""){
	  sumprice =parseFloat(quantity) * parseFloat(money); 
	}
	 document.getElementById ("sum_money"+i).value = sumprice;  
}

/**合計數量、金額**/
function total(i){  
  sumPrice(i);
  var sum1 = 0;    //合計數量 
  var sum2 = 0;    //合計金額
  var sum3 = 0;    //含稅
  var obj = document.getElementById("mybody");   //取mybody對象
  var length = obj.rows.length ;   
  //alert("當前行數=="+length);
  for(var i=0; i<length; i++ ) {
	  /*if(document.getElementById ("num"+i).value!=""){
		 sum1 =parseFloat(sum1) + parseFloat(document.getElementById ("num"+i).value); 
	  }*/
	  if(document.getElementById ("sum_money"+i).value!=""){
		 sum2 =parseFloat(sum2) + parseFloat(document.getElementById ("sum_money"+i).value);
	  }
  }  
	sum3=sum2*1.05;
	//document.getElementById ("total_num").value = sum1;  
	document.getElementById ("total_sum").value = FormatNumber(sum2);
	document.getElementById ("tax_sum").value = FormatNumber(sum3);
}

/**加入千位數**/
function FormatNumber(n) {
    n += "";
    var arr = n.split(".");
    var re = /(\d{1,3})(?=(\d{3})+$)/g;
    return arr[0].replace(re,"$1,") ;
}
</script>


</head>

<body>
<form name="myform" action="quoted_price.php" method="post" enctype="multipart/form-data" />
<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
<input type="hidden" name="proj_id" id="proj_id" value="<?=$proj_id?>"  />
<input type="hidden" name="event_id" id="event_id" value="<?=$event_id?>"  />
<input type="hidden" name="employ" id="employ" /><!--使用編號-->
<input type="hidden" name="fid" id="fid" /><!--function內部切換-->
<input type="hidden" name="act" id="act" /><!--function第二階段切換-->
<input type="hidden" name="param1" id="param1" />
<input type="hidden" name="param2" id="param2" />
<input type="hidden" name="param3" id="param3" />
<input type="hidden" name="param4" id="param4" />
<input type="hidden" name="param5" id="param5" />

<div class="container"><!--響應式網頁S-->
<br><br>
	<div class="row">
		<div class="col-md-12">
        	<div class="form-group">
            	<center><img src="../images/mLogo.png" alt="盟立報價" title="盟立報價" class="img-responsive" ></center>
            </div>
            <div class="form-group">
        		<h4><p class="text-center">總公司 :新竹市科學工業園區30077研發二路3號TEL:03-578-3280  FAX:03-5782855</p>
                <p class="text-center">◎台北辦事處 ：台北市信義路四段138號3F TEL:02-27541369  FAX:02-27018037</p></h4>
        	</div>
            <div class="form-group">
            	<h3><p class="text-center">報價單</p></h3>
            </div>
            
		</div><!--<div class="col-md-3">-->
    </div><!--<div class="row">-->
    
    <div class="row">
    	<div class="col-xs-6">
        	<div class="form-group">
            	<label for="exampleInputName2">客戶名稱:</label>
                <input type="text"  id="client_name" name="client_name" placeholder="" size="10%">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">客戶地址:</label>
                <input type="text"  id="client_address" name="client_address" placeholder="" size="10%">
            </div>
            <div class="form-group">
            	<label for="exampleInputName2">連絡人／職稱:</label>
                <input type="text"  id="client_window" name="client_window" placeholder="" size="10%">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">電話:</label>
                <input type="text"  id="client_phone" name="client_phone" placeholder="" size="10%">
            </div>
		</div><!--<div class="col-xs-6">-->
        
        <div class="col-xs-6">
        	<div class="form-group">
            	<p class="text-right"><label for="exampleInputName2">報價日期:</label>                
                <input type="text"  id="client_date" name="client_date" placeholder="" value="<?=$today?>" size="10%" disabled ></p>
            </div>
            <div class="form-group">
                <p class="text-right"><label for="exampleInputName2">報價編號:</label>
                <input type="text"  id="client_num" name="client_num" placeholder="" size="10%"></p>
            </div>
            <div class="form-group">
            	<p class="text-right"><label for="exampleInputName2">E-mail:</label>
                <input type="text"  id="client_mail" name="client_mail" placeholder="" size="10%"></p>
            </div>
		</div><!--<div class="col-xs-6">-->
        
    </div><!--<div class="row">-->
    
    <div class="row">
    	<table class="table table-hover" id="mytable">
        	<tr class="success">
            	<td align="left">
                	項目
                </td>
                <td >
                	品    名  /  規    格
                </td> 
                <td >
                	數量
                </td>
                <td >
                	單價
                </td>
                <td >
                	小計
                </td>             
            </tr>
            <tbody id="mybody">
            <!--動態表格操作區域-->
            </tbody>
        </table>
        <input type="button" class="btn btn-primary" value="增加欄位" onclick="addMyRow()">
        <!--<input type="button" class="btn btn-danger" value="刪減欄位" onclick="remove_data()">-->
    </div><!--<div class="row">-->
    <br>
    <div class="row">
    <table class="table table-hover">
    	<tr>
        	<td align="right">
            	<span class="label label-default">Total (未稅)</span>
                <input type="text" id="total_sum" placeholder="" value="" size="16">
            </td>
        </tr>
        <tr>
        	<td align="right">
            	<span class="label label-success">Total (含稅)</span>
                <input type="text" id="tax_sum" placeholder="" value="" size="16">
            </td>
        </tr>
    </table>
	</div><!--<div class="row">--> 
    
    <hr>
    <div class="row">
    	<div class="col-xs-8">
        	<p class="text-left">交易條件:</p>
            <p class="text-left">1.交貨期限：自簽約日起XX天內交貨。</p>
            <p class="text-left">2.付款方式：交貨後即付總價100%。</p>
            <p class="text-left">3.保固期限：依原廠保固標準</p>
            <p class="text-left">4.本報價有效期限：10天。</p>
            <p class="text-left">5.其它未盡事宜雙方得另行協議之。</p>
            <p class="text-left">6.本報價單所列價格及條件倘蒙  閣下之認可簽署後，視同正式訂購單。</p>
            <p class="text-left">7.超過保固後,維護費依零件與工資合併計算。</p>
        </div><!--<div class="col-xs-6">-->
    </div><!--<div class="row">-->
    <br>
    <div class="row">
    	<table class="table table-hover">
			<tr>
            	<td ROWSPAN='5' align='left'>
                	<br>
                    <br>
                    <br>
                	<p class="text-left">客戶代表簽章:___________________</p>
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">盟立業務代表:</label>
                    <input type="text"  id="bus_name" name="bus_name" placeholder="" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">聯絡電話:</label>
                    <input type="text"  id="bus_phone" name="bus_phone" placeholder="" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">手機:</label>
                    <input type="text"  id="bus_cellphone" name="bus_cellphone" placeholder="" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">E-MAIL:</label>
                    <input type="text"  id="bus_mail" name="bus_mail" placeholder="" size="10%">
                </td>
            </tr>
        </table>
    </div><!--<div class="row">-->
	<div class="row">
    	<div class="col-xs-12">
        	<p class="text-center"><input type="button" class="btn btn-primary" value="送出" onclick="newQuoted('sqlNewQuoted')"></p>
        </div>
    </div>
    
</div><!--響應式網頁E-->
</body>
</html>

<?php
function sqlNewQuoted(){
global $client_name, $client_address, $client_window, $client_phone, $client_date, $client_num, $client_mail, $bus_name, $bus_phone, $bus_cellphone, $bus_mail, $qpid, $name, $specification, $quantity, $money, $sum_money;

//print_r($specification);

$sum=count($name);//計算陣列的元素數

$sqlup="insert into quoted_priceA (client_name, client_address, client_window, client_phone, client_date, client_num, client_mail, bus_name, bus_phone, bus_cellphone, bus_mail) values ('$client_name','$client_address','$client_window','$client_phone', NOW(),'$client_num','$client_mail','$bus_name','$bus_phone','$bus_cellphone','$bus_mail')";

	mysql_query($sqlup)or die($sqlup);
	if (mysql_affected_rows()>0){
	$newASid=mysql_insert_id();
		for($x=0;$x<$sum;$x++){
			$namev=$name[$x];		
			$specificationv=$specification[$x];
			$quantityv=$quantity[$x];
			$moneyv=$money[$x];
			$sum_moneyv=$sum_money[$x];
			
			if($namev=="" or $namev==NULL){
				$namev="0";
			}	
			
			if($specificationv=="" or $specificationv==NULL){
				$specificationv="0";
			}
			
			if($quantityv=="" or $quantityv==NULL){
				$quantityv="0";
			}
			
			if($moneyv=="" or $moneyv==NULL){
				$moneyv="0";
			}
			
			if($sum_moneyv=="" or $sum_moneyv==NULL){
				$sum_moneyv="0";
			}
			
			$sql="insert into quoted_priceB (qpid, name, specification, quantity, money, sum_money) values ('$newASid','$namev','$specificationv','$quantityv','$moneyv','$sum_moneyv')";
			mysql_query($sql)or die($sql);
			if (mysql_affected_rows()>0){
					
					}	
		}	
	$str="新增成功！";
	alert($str);
	}
	
}
?>