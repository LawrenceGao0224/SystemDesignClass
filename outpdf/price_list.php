<!doctype html>
<?php
require("../link.php");
require("../mirle_func.php");
require("../sql_func.php");
require("../config.php");
load_variables();
date_default_timezone_set("Asia/Taipei");//時間用
$today=date("Y-m-d");//今天

//price_list 報價清單

/**** 執行SQL ****/
if($fid=="sqlSaveQuoted"){ //存檔
	//alert2($priceA_id);
	$done=sqlSaveQuoted($priceA_id);
}else if($fid=="sqlDelitems"){ //刪除品項
	$priceB_id=$param2;
	$done=sqlDelitems($priceB_id);
	$fid="price_edit";
}else if($fid=="jumpPreview"){ //轉跳至預覽
	$jump="http://".$localIP."/mirle/quoted/preview.php?priceA_id=".$priceA_id;
	header('Location:'.$jump);
}else if($fid=="sqlPriceDel"){
	$done=sqlPriceDel($priceA_id);
}

?>
<html>
<head>
<meta charset="utf-8">
<title>報價清單-列表</title>
<script src='../js_func.js' type=text/javascript></script><!--載入javascript方法-->

<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
//全局變量
var i=0;
/**增加一行記錄**/
function addMyRow(chk){
	//alert(name_old);
	var mytable = document.getElementById("mybody");   
	var mytr = mytable.insertRow();    //插入行
	mytr.setAttribute("id","tr"+i);    //設定行id
	//插入行單元格的值
	//mytr.insertCell(0).innerHTML = i+1;
	if(chk==88){
		mytr.insertCell(0).innerHTML="<input type='text' class='form-control' name='name[]' id='name"+i+"' size='12' value='' />";
		mytr.insertCell(1).innerHTML="<input type='text' class='form-control' name='specification[]' id='specification"+i+"' size='25' value='' />";
		mytr.insertCell(2).innerHTML="<input type='text' class='form-control' name='quantity[]' id='quantity"+i+"' size='8' value=''  onChange='total("+i+")'/>";
		mytr.insertCell(3).innerHTML="<input type='text' class='form-control' name='money[]' id='money"+i+"' size='8' value=''  onChange='total("+i+")'/>";
		mytr.insertCell(4).innerHTML="<input type='text' class='form-control' name='sum_money[]' id='sum_money"+i+"' size='12' value=''  onChange='total("+i+")'/>";
	}
	
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
  var sum_cash_o = 0;
  var sum_cash_tax_o =0;
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
	sum_cash_o = Number(document.getElementById ("sum_cash_o").value);
	sum_cash_tax_o = Number(document.getElementById ("sum_cash_tax_o").value);
	document.getElementById ("total_sum").value = FormatNumber(sum2+sum_cash_o);
	document.getElementById ("tax_sum").value = FormatNumber(sum3+sum_cash_tax_o);
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
<form name="myform" action="price_list.php" method="post" enctype="multipart/form-data" />
<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
<input type="hidden" name="proj_id" id="proj_id" value="<?=$proj_id?>"  />
<input type="hidden" name="priceA_id" id="priceA_id" value="<?=$priceA_id?>"  />
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

<p class="text-right">	
    <a href="quoted_price.php">
        <button type="button" class="btn btn-primary" >新增</button>
    </a>
</p>
<?php
		if($fid=="price_edit"){
			price_edit($sid,$priceA_id);//編輯
		}else{
			price_list($sid);//清單
		}
?> 
</div>
</body>
</html>

<?php
function price_list($sid){
?>
<div class="row">
	<table class="table table-hover">
        	<thead>
                <tr>
                  <th>客戶名稱</th>
                  <th>客戶電話</th>
                  <th>盟立業務姓名</th>
                  <th>報價編號</th>
                  <th>報價日期</th>
                  <th>動作</th>
                </tr>
            </thead>
            <tbody>
<?php
	$sql = "SELECT * FROM quoted_priceA ";
	$num = doSelect($sql,$re);
	while($row = mysql_fetch_array($re)){
		$priceA_id=$row['id'];//流水編號
		$client_name=$row['client_name']; //客戶名稱
		$client_address=$row['client_address']; //客戶地址
		$client_window=$row['client_window']; //聯絡人/職稱
		$client_phone=$row['client_phone']; //客戶電話
		$client_date=$row['client_date']; //報價日期
		$client_num=$row['client_num']; //報價編號
		$client_mail=$row['client_mail']; //客戶信箱
		$bus_name=$row['bus_name']; //盟立業務姓名
		$bus_phone=$row['bus_phone']; //盟立業務電話
		$bus_cellphone=$row['bus_cellphone']; //盟立業務手機
		$bus_mail=$row['bus_mail']; //盟立業務信箱
?>           
                <tr>
                    <td>
                        <?=$client_name?>
                    </td>
                    <td>
                        <?=$client_phone?>
                    </td>
                    <td>
                        <?=$bus_name?>
                    </td>
                    <td>
                        <?=$client_num?>
                    </td>
                    <td>
                        <?=$client_date?>
                    </td>
                    <td>
                    	<button type="button" class="btn btn-info" onClick="editPrice('price_edit','<?=$priceA_id?>')">編輯</button>
                        <button type="button" class="btn btn-danger" onClick="DelPrice('sqlPriceDel','<?=$priceA_id?>')">刪除</button>
                    </td>
                </tr>
<?php
	}
?>
            </tbody>
        </table>
</div>
<?php
}

//==================================================(我是分隔線)======

function price_edit($sid,$priceA_id){
	$sql = "SELECT * FROM quoted_priceA where id='$priceA_id' ";
	$num = doSelect($sql,$re);
	if($row = mysql_fetch_array($re)){
		$priceA_id=$row['id'];//流水編號
		$client_name=$row['client_name']; //客戶名稱
		$client_address=$row['client_address']; //客戶地址
		$client_window=$row['client_window']; //聯絡人/職稱
		$client_phone=$row['client_phone']; //客戶電話
		$client_date=$row['client_date']; //報價日期
		$client_num=$row['client_num']; //報價編號
		$client_mail=$row['client_mail']; //客戶信箱
		$bus_name=$row['bus_name']; //盟立業務姓名
		$bus_phone=$row['bus_phone']; //盟立業務電話
		$bus_cellphone=$row['bus_cellphone']; //盟立業務手機
		$bus_mail=$row['bus_mail']; //盟立業務信箱
	}	
?>
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
		</div>
    </div><!--<div class="row">-->
    
    <div class="row">
    	<div class="col-xs-6">
        	<div class="form-group">
            	<label for="exampleInputName2">客戶名稱:</label>
                <input type="text"  id="client_name" name="client_name" placeholder="" value="<?=$client_name?>" size="10%">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">客戶地址:</label>
                <input type="text"  id="client_address" name="client_address" placeholder="" value="<?=$client_address?>" size="10%">
            </div>
            <div class="form-group">
            	<label for="exampleInputName2">連絡人／職稱:</label>
                <input type="text"  id="client_window" name="client_window" placeholder="" value="<?=$client_window?>" size="10%">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">電話:</label>
                <input type="text"  id="client_phone" name="client_phone" placeholder="" value="<?=$client_phone?>" size="10%">
            </div>
		</div><!--<div class="col-xs-6">-->
        
        <div class="col-xs-6">
        	<div class="form-group">
            	<p class="text-right"><label for="exampleInputName2">報價日期:</label>                
                <input type="text"  id="client_date" name="client_date" placeholder="" value="<?=$client_date?>" size="10%" disabled ></p>
            </div>
            <div class="form-group">
                <p class="text-right"><label for="exampleInputName2">報價編號:</label>
                <input type="text"  id="client_num" name="client_num" placeholder="" value="<?=$client_num?>" size="10%"></p>
            </div>
            <div class="form-group">
            	<p class="text-right"><label for="exampleInputName2">E-mail:</label>
                <input type="text"  id="client_mail" name="client_mail" placeholder="" value="<?=$client_mail?>" size="10%"></p>
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
<?php
			$priceBid = array();
			$sqlb = "SELECT * FROM quoted_priceB where qpid='$priceA_id' ";
			$num = doSelect($sqlb,$reb);
			while($rob = mysql_fetch_array($reb)){
				$priceB_id=$rob['id'];//流水編號
				$name_old=$rob['name'];
				$specification_old=$rob['specification'];
				$quantity_old=$rob['quantity'];
				$money_old=$rob['money'];
				$sum_money_old=$rob['sum_money'];	
				$sum_cash=$sum_cash+$sum_money_old;
				$sum_cash_tax=$sum_cash*1.05;	
				$priceBid[]=$priceB_id;	
				echo "<tr>";
					echo "<td>";
					echo "<input type='text' class='form-control' name='name_old[]' id='name_old' size='12' value='$name_old' />";
					echo "</td>";
					echo "<td>";
					echo "<input type='text' class='form-control' name='specification_old[]' id='specification_old' size='25' value='$specification_old' />";
					echo "</td>";
					echo "<td>";
					echo "<input type='text' class='form-control' name='quantity_old[]' id='quantity_old' size='8' value='$quantity_old' />";
					echo "</td>";
					echo "<td>";
					echo "<input type='text' class='form-control' name='money_old[]' id='money_old' size='8' value='$money_old' />";
					echo "</td>";
					echo "<td>";
					echo "<input type='text' class='form-control' name='sum_money_old[]' id='sum_money_old' size='12' value='$sum_money_old' />";
					echo "</td>";
					echo "<td>";
					//echo "<input type='hidden' name='priceB_id' id='priceB_id' value='$priceB_id' />";
					echo "<button type='button' class='btn btn-danger' onClick=\"sqlDelitems('$priceA_id','$priceB_id')\" />Del</button>";
					echo "</td>";
				echo "</tr>";
			}	
			$priceBid=implode(" ",$priceBid);	
			echo "<input type='hidden' name='priceBid' id='priceBid' value='$priceBid' />";
			echo "<input type='hidden' name='sum_cash_o' id='sum_cash_o' value='$sum_cash' />";
			echo "<input type='hidden' name='sum_cash_tax_o' id='sum_cash_tax_o' value='$sum_cash_tax' />";
			$sum_cash=number_format($sum_cash); //加千分號
			$sum_cash_tax=number_format($sum_cash_tax,0); //加千分號
?>
            <tbody id="mybody">
            <!--動態表格操作區域-->
            </tbody>  
        </table>
        <input type="button" class="btn btn-primary" value="增加欄位" onclick="addMyRow('88')">
        <!--<input type="button" class="btn btn-danger" value="刪減欄位" onclick="remove_data()">-->
    </div><!--<div class="row">-->
    <br>
    <div class="row">
    <table class="table table-hover">
    	<tr>
        	<td align="right">
            	<span class="label label-default">Total (未稅)</span>
                <input type="text" id="total_sum" placeholder="" value="<?=$sum_cash?>" size="16">
            </td>
        </tr>
        <tr>
        	<td align="right">
            	<span class="label label-success">Total (含稅)</span>
                <input type="text" id="tax_sum" placeholder="" value="<?=$sum_cash_tax?>" size="16">
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
                    <input type="text"  id="bus_name" name="bus_name" placeholder="" value="<?=$bus_name?>" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">聯絡電話:</label>
                    <input type="text"  id="bus_phone" name="bus_phone" placeholder="" value="<?=$bus_phone?>" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">手機:</label>
                    <input type="text"  id="bus_cellphone" name="bus_cellphone" placeholder="" value="<?=$bus_cellphone?>" size="10%">
                </td>
            </tr>
            <tr>
            	<td align="right">
                    <label for="exampleInputName2">E-MAIL:</label>
                    <input type="text"  id="bus_mail" name="bus_mail" placeholder="" value="<?=$bus_mail?>" size="10%">
                </td>
            </tr>
        </table>
    </div><!--<div class="row">-->
	<div class="row">
    	<div class="col-xs-12">
        	<p class="text-center">
            	<input type="button" class="btn btn-primary" value="預覽" onclick="jumpPreview('jumpPreview','<?=$priceA_id?>')">
            	<input type="button" class="btn btn-primary" value="確認" onclick="saveQuoted('sqlSaveQuoted','<?=$priceA_id?>')">
            </p>
        </div>
    </div>

<?php
}

function sqlSaveQuoted($priceA_id){
global $client_name, $client_address, $client_window, $client_phone, $client_date, $client_num, $client_mail, $bus_name, $bus_phone, $bus_cellphone, $bus_mail, $qpid, $name, $specification, $quantity, $money, $sum_money;

global $name_old, $specification_old, $quantity_old, $money_old, $sum_money_old, $priceBid;
//alert2($priceBid[3]);
$priceBid = explode(" ",$priceBid);
$sum=count($name);//計算陣列的元素數
$suma=count($priceBid);//計算陣列的元素數

$sqlup="update quoted_priceA set client_name='$client_name', client_address='$client_address', client_window='$client_window', client_phone='$client_phone', client_date=NOW(), client_num='$client_num', client_mail='$client_mail', bus_name='$bus_name', bus_phone='$bus_phone', bus_cellphone='$bus_cellphone', bus_mail='$bus_mail' where id='$priceA_id'";

	mysql_query($sqlup)or die($sqlup);
	if (mysql_affected_rows()>0){
		
	}
	
	/*新增的品項*/
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
		
		$sql="insert into quoted_priceB (qpid, name, specification, quantity, money, sum_money) values ('$priceA_id','$namev','$specificationv','$quantityv','$moneyv','$sum_moneyv')";
		mysql_query($sql)or die($sql);
		if (mysql_affected_rows()>0){
				
				}	
	}
		
	/*更改的品項*/
	for($y=0;$y<$suma;$y++){
		$priceBido=$priceBid[$y];
		$nameo=$name_old[$y];		
		$specificationo=$specification_old[$y];
		$quantityo=$quantity_old[$y];
		$moneyo=$money_old[$y];
		$sum_moneyo=$sum_money_old[$y];
		
		if($nameo=="" or $nameo==NULL){
			$nameo="0";
		}	
		
		if($specificationo=="" or $specificationo==NULL){
			$specificationo="0";
		}
		
		if($quantityo=="" or $quantityo==NULL){
			$quantityo="0";
		}
		
		if($moneyo=="" or $moneyo==NULL){
			$moneyo="0";
		}
		
		if($sum_moneyo=="" or $sum_moneyo==NULL){
			$sum_moneyo="0";
		}
		$sqlupp="update quoted_priceB set name='$nameo', specification='$specificationo', quantity='$quantityo', money='$moneyo', sum_money='$sum_moneyo' where id='$priceBido' and qpid='$priceA_id' ";
		mysql_query($sqlupp)or die($sqlupp);
		if (mysql_affected_rows()>0){
			//alert2($nameo);
		}	
	}	
}

function sqlPriceDel($priceA_id){
	$sqld ="DELETE FROM quoted_priceA WHERE id='$priceA_id' ";
	mysql_query($sqld)or die($sqld);
		if (mysql_affected_rows()>0){
			$sqldd ="DELETE FROM quoted_priceB WHERE qpid='$priceA_id' ";
			mysql_query($sqldd)or die($sqldd);
				if (mysql_affected_rows()>0){
					alert2("刪除成功!");
				}
		}
}

?>