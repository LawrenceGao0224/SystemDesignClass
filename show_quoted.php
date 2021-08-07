<?php
session_start();
require_once 'php/db.php';
require_once 'php/function.php';   
$user = getthisuser($link,$_SESSION['id']);
$project_info = getprojectinfo($link);
load_variables();
if(isset($_GET["id"])){
    $sid = $_GET["id"]; 
  }else{
     if(isset($sid)){
      $_GET["id"] = $sid;
      

  }
  }
 
$localIP = "125.227.64.111";


if($fid=="sqlSaveQuoted"){ //存檔
  //alert2($priceA_id);
  $done=sqlSaveQuoted($priceA_id,$link);
}else if($fid=="sqlDelitems"){ //刪除品項
  $priceB_id=$param2;
  $done=sqlDelitems($priceB_id,$link);
  $fid="price_edit";
}else if($fid=="jumpPreview"){ //轉跳至預覽
  $jump="http://".$localIP."/mirle3/preview.php?priceA_id=".$sid;
  header('Location:'.$jump);
}else if($fid=="sqlPriceDel"){
  $done=sqlPriceDel($priceA_id,$link);
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>盟立自動化-產品技術支援處協作平台</title>



  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src='tom_func.js' type=text/javascript></script><!--載入javascript方法-->


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
<body class="hold-transition skin-blue sidebar-mini">
  <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true):?>
  <div class="wrapper">
    <form name="myform" action="show_quoted.php" method="post" enctype="multipart/form-data" />
<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
<input type="hidden" name="proj_id" id="proj_id" value="<?=$proj_id?>"  />
<input type="hidden" name="priceA_id" id="priceA_id" value="<?=$priceA_id?>"  />
<input type="hidden" name="employ" id="employ" /><!--使用編號-->
<input type="hidden" name="fid" id="fid" /><!--function內部切換-->
<input type="hidden" name="act" id="act" /><!--function第二階段切換-->


    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo">
        <span class="logo-lg">盟立自動化-產品技術支援處協作平台</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav nav-pills">
            <a href="php/logout.php" class="btn btn-primary btn-xs">會員登出</a> 
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>
          <li>
            <a href="index.php"><img src="images/index.png" width="26" height="26" alt="1"> <span>首頁</span>
            </a>
          </li>
          <li>
            <a href="service.php"><img src="images/1428237892_notepad-48.png" width="26" height="26" alt="2"><span>服務滿意調查表</span></a>
          </li>
          <li>
            <a href="purchase.php"><!--?page=app_operating.php--><img src="images/1428238027_678108-address-book-48.png" width="26" height="26" alt="3"><span>計劃進貨申請表</span></a>
          </li>
          <li>
            <a href="products.php"><!--?page=newsletters.php--><img src="images/1428237940_file-excel-alt-48.png" width="26" height="26" alt="4"><span>產品報備表</span></a>
          </li>
          <li>
            <a href="quoted.php"><!--?page=newsletters.php--><img src="images/1428239597_678135-sticky-note-48.png" width="26" height="26" alt="5"><span>報價清單內容</span></a>
          </li>
          <li>
              <a href="caselist.php"><!--?page=newsletters.php--><img src="images/1428239597_678135-sticky-note-48.png" width="26" height="26" alt="5"><span>Bid管制表</span></a>
            </li>
          <!-- <li>
            <a href="newsletters.php"><img src="images/1428239747_Graph-Magnifier-48.png" width="26" height="26" alt="6"><span>產品比較</span></a>
          </li>
          <li>
            <a href="http://aps2.uch.edu.tw/adm_unit/div_con/image/construction.gif"><img src="images/1428238051_678082-tag-48.png" width="26" height="26" alt="7"><span>預約支援</span></a>
          </li>
          <li>
            <a href="?page=user_conf.php"><img src="images/Configure.png" width="26" height="26" alt="7"><span>用戶設定</span></a>
          </li> -->
          <li class="header"></li>
          <?php if(!empty($project_info)):?>
          <?php foreach($project_info as $row):?>
          <?php $str = "pro_" . $row['proj_id'];?>
          <?php if($row['status'] == 0 && $user["{$str}"] == 1):?>                    
          <li>
            <a href="show_project.php?id=<?php echo $row['proj_id'];?>"><?php echo $row['proj_name'];?></a>
          </li>  
        <?php endif;?>
      <?php endforeach;?> 
    <?php endif;?>     
  </ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class = "pull-right">
      <ul class="nav nav-pills">
       <a href="new_quoted.php" class="btn btn-primary ">新增<span class="glyphicon glyphicon-plus"></span></a> 
     </ul>
   </div>
 </section>

 <!-- Main content -->
 <section class="content">
  <br><br>

  <?php
  //  if($fid=="price_edit"){
      price_edit($sid,$priceA_id,$link);//編輯
   //  }else{
   //    price_list($sid);//清單
   // }
      ?> 


          </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
          <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
        </footer>
      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  <?php else:?>
  <?php header("Location:login.php"); ?>
<?php endif;?>
</body>
</html>





<?php
//==================================================(我是分隔線)======

function price_edit($sid,$priceA_id,$link){//!!!!!!!!!!!!
  if(isset($_GET["id"])){
    $data = getquoted($link,$_GET["id"]); 
  }

  // $sql = "SELECT * FROM quoted_pricea where id='$id' ";
  // $re = mysqli_query($link, $sql);
  // if($row = mysqli_fetch_array($re)){
  //   $priceA_id=$row['id'];//流水編號
  //   $client_name=$row['client_name']; //客戶名稱
  //   $client_address=$row['client_address']; //客戶地址
  //   $client_window=$row['client_window']; //聯絡人/職稱
  //   $client_phone=$row['client_phone']; //客戶電話
  //   $client_date=$row['client_date']; //報價日期
  //   $client_num=$row['client_num']; //報價編號
  //   $client_mail=$row['client_mail']; //客戶信箱
  //   $bus_name=$row['bus_name']; //盟立業務姓名
  //   $bus_phone=$row['bus_phone']; //盟立業務電話
  //   $bus_cellphone=$row['bus_cellphone']; //盟立業務手機
  //   $bus_mail=$row['bus_mail']; //盟立業務信箱
  // } 
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <center><img src="images/mLogo.png" alt="盟立報價" title="盟立報價" class="img-responsive" ></center>
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
          <input type="text"  id="client_name" name="client_name" placeholder="" value="<?=$data['client_name']?>" size="10%">
        </div>
        <div class="form-group">
          <label for="exampleInputName2">客戶地址:</label>
          <input type="text"  id="client_address" name="client_address" placeholder="" value="<?=$data['client_address']?>" size="10%">
        </div>
        <div class="form-group">
          <label for="exampleInputName2">連絡人／職稱:</label>
          <input type="text"  id="client_window" name="client_window" placeholder="" value="<?=$data['client_window']?>" size="10%">
        </div>
        <div class="form-group">
          <label for="exampleInputName2">電話:</label>
          <input type="text"  id="client_phone" name="client_phone" placeholder="" value="<?=$data['client_phone']?>" size="10%">
        </div>
      </div><!--<div class="col-xs-6">-->

      <div class="col-xs-6">
        <div class="form-group">
          <p class="text-right"><label for="exampleInputName2">報價日期:</label>                
            <input type="text"  id="client_date" name="client_date" placeholder="" value="<?=$data['client_date']?>" size="10%" disabled ></p>
          </div>
          <div class="form-group">
            <p class="text-right"><label for="exampleInputName2">報價編號:</label>
              <input type="text"  id="client_num" name="client_num" placeholder="" value="<?=$data['client_num']?>" size="10%"></p>
            </div>
            <div class="form-group">
              <p class="text-right"><label for="exampleInputName2">E-mail:</label>
                <input type="text"  id="client_mail" name="client_mail" placeholder="" value="<?=$data['client_mail']?>" size="10%"></p>
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
              $id = $_GET["id"];

              $sqlb = "SELECT * FROM quoted_priceb where qpid='$id' ";

              $reb = mysqli_query($link, $sqlb);
              while($rob = mysqli_fetch_array($reb)){
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
          <input type="text"  id="bus_name" name="bus_name" placeholder="" value="<?=$data['bus_name']?>" size="10%">
        </td>
      </tr>
      <tr>
        <td align="right">
          <label for="exampleInputName2">聯絡電話:</label>
          <input type="text"  id="bus_phone" name="bus_phone" placeholder="" value="<?=$data['bus_phone']?>" size="10%">
        </td>
      </tr>
      <tr>
        <td align="right">
          <label for="exampleInputName2">手機:</label>
          <input type="text"  id="bus_cellphone" name="bus_cellphone" placeholder="" value="<?=$data['bus_cellphone']?>" size="10%">
        </td>
      </tr>
      <tr>
        <td align="right">
          <label for="exampleInputName2">E-MAIL:</label>
          <input type="text"  id="bus_mail" name="bus_mail" placeholder="" value="<?=$data['bus_mail']?>" size="10%">
        </td>
      </tr>
    </table>
  </div><!--<div class="row">-->
  <div class="row">
    <div class="col-xs-12">
      <p class="text-center">
        <input type="button" class="btn btn-primary" value="預覽" onclick="jumpPreview('jumpPreview','<?=$id?>')">
        <input type="button" class="btn btn-primary" value="確認" onclick="saveQuoted('sqlSaveQuoted','<?=$id?>')">
      </p>
    </div>
  </div>

  <?php
}

function sqlSaveQuoted($priceA_id,$link){
  global $client_name, $client_address, $client_window, $client_phone, $client_date, $client_num, $client_mail, $bus_name, $bus_phone, $bus_cellphone, $bus_mail, $qpid, $name, $specification, $quantity, $money, $sum_money;

  global $name_old, $specification_old, $quantity_old, $money_old, $sum_money_old, $priceBid;
//alert2($priceBid[3]);
  $priceBid = explode(" ",$priceBid);
$sum=count($name);//計算陣列的元素數
$suma=count($priceBid);//計算陣列的元素數

$sqlup="update quoted_pricea set client_name='$client_name', client_address='$client_address', client_window='$client_window', client_phone='$client_phone', client_date=NOW(), client_num='$client_num', client_mail='$client_mail', bus_name='$bus_name', bus_phone='$bus_phone', bus_cellphone='$bus_cellphone', bus_mail='$bus_mail' where id='$priceA_id'";

mysqli_query($link,$sqlup) or die($sqlup);
if (mysqli_affected_rows()>0){

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

  $sql="insert into quoted_priceb (qpid, name, specification, quantity, money, sum_money) values ('$priceA_id','$namev','$specificationv','$quantityv','$moneyv','$sum_moneyv')";
  mysqli_query($link,$sql)or die($sql);
  if (mysqli_affected_rows()>0){

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
  $sqlupp="update quoted_priceb set name='$nameo', specification='$specificationo', quantity='$quantityo', money='$moneyo', sum_money='$sum_moneyo' where id='$priceBido' and qpid='$priceA_id' ";
  mysqli_query($link,$sqlupp)or die($sqlupp);
  if (mysqli_affected_rows()>0){
      //alert2($nameo);
  } 
} 
  header("Location: http://125.227.64.111/mirle3/quoted.php");
}

function sqlPriceDel($priceA_id,$link){
  $sqld ="DELETE FROM quoted_pricea WHERE id='$priceA_id' ";
  mysqli_query($link,$sqld)or die($sqld);
  if (mysqli_affected_rows()>0){
    $sqldd ="DELETE FROM quoted_priceb WHERE qpid='$priceA_id' ";
    mysqli_query($link,$sqldd)or die($sqldd);
    if (mysqli_affected_rows()>0){
      alert2("刪除成功!");
    }
  }
}
function sqlDelitems($priceB_id,$link){ //報價清單刪除品項
  $sqld ="DELETE FROM quoted_priceb WHERE id='$priceB_id' ";
    mysqli_query($link,$sqld)or die($sqld);
    if (mysqli_affected_rows()>0){
      
    }

}
function load_variables()//免用POST跟GET的方法
{
  while (list ($_key_,$_val_) = each ($_GET)) {
    global  $$_key_;
    $$_key_ = $_val_;
  } 
  while (list ($_key_,$_val_) = each ($_POST)) {
    global  $$_key_;
    $$_key_ = $_val_;
  } 
}



?>

