<?php
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';  
  $user = getthisuser($link,$_SESSION['id']);
  $project_info = getprojectinfo($link);
  if(isset($_GET["id"])){
    $data = getcase($link,$_GET["id"]);	
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
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true):?>
    <div class="wrapper">

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
          <h1>Bid管制表---<?php echo $data['proj_name']?></h1>
        </section>

        <!-- Main content -->
        <section class="content">	
						<form id="myform" enctype="multipart/form-data" >
							<hr>
              <?php 
                    $str_date = $data['case_date'] . " " . $data['case_time'];
                  ?>
							<div class="form-group">
								時間戳記：<?php echo $str_date;?>
								<br>
							</div>
							<div class="form-group">
								業務利署部門(部門代碼)：<?php echo $data['dep_name'];?>
								<br>
							</div>
							<div class="form-group">
								申請人(中文全名)：<?php echo $data['ask_name'];?>
								<br>
							</div>
							<div class="form-group">
								客戶名稱：<?php echo $data['client'];?>
								<br>
							</div>

							<div class="form-group">
								專案名稱：<?php echo $data['proj_name'];?>
								<br>
							</div>
							<div class="form-group">
								預估全案金額(萬)：<?php echo $data['casemoney'];?>
							</div>
							<div class="form-group">
								預估硬體金額：<?php echo $data['hwmoney'];?>
								<br>
							</div>
							<div class="form-group">
								專案成案日(yyyy/mm)：<?php echo $data['deadline'];?>
								<br>
							</div>
							<div class="form-group">
								需求描述：<?php echo $data['describe'];?>
								<br>
							</div>
              <div class="form-group">
                客戶連絡人姓名(中文/英文)：<?php echo $data['client_name'];?>
                <br>
              </div>
              <div class="form-group">
                客戶連絡人職稱：<?php echo $data['client_title'];?>
                <br>
              </div>
              <div class="form-group">
                連絡電話：<?php echo $data['phone'];?>
                <br>
              </div>

              <div class="form-group">
                E-Mail：<?php echo $data['mail'];?>
                <br>
              </div>
              <div class="form-group">
                縣市：
                <?php
                  if($data['city'] == '1'){
                    echo "基隆市";
                  }
                  elseif($data['city'] == '2'){
                    echo "台北市";
                  }
                  elseif($data['city'] == '3'){
                    echo "新北市";
                  }
                  elseif($data['city'] == '4'){
                    echo "桃園市";
                  }
                  elseif($data['city'] == '5'){
                    echo "新竹市";
                  }
                  elseif($data['city'] == '6'){
                    echo "新竹縣";
                  }
                  elseif($data['city'] == '7'){
                    echo "苗栗縣";
                  }
                  elseif($data['city'] == '8'){
                    echo "台中市";
                  }
                  elseif($data['city'] == '9'){
                    echo "彰化縣";
                  }
                  elseif($data['city'] == '10'){
                    echo "南投縣";
                  }
                  elseif($data['city'] == '11'){
                    echo "雲林縣";
                  }
                  elseif($data['city'] == '12'){
                    echo "嘉義市";
                  }
                  elseif($data['city'] == '13'){
                    echo "嘉義縣";
                  }
                  elseif($data['city'] == '14'){
                    echo "台南市";
                  }
                  elseif($data['city'] == '15'){
                    echo "高雄市";
                  }
                  elseif($data['city'] == '16'){
                    echo "屏東縣";
                  }
                  elseif($data['city'] == '17'){
                    echo "台東縣";
                  }
                  elseif($data['city'] == '18'){
                    echo "花蓮縣";
                  }
                  elseif($data['city'] == '19'){
                    echo "宜蘭縣";
                  }
                  elseif($data['city'] == '20'){
                    echo "金門縣";
                  }
                  elseif($data['city'] == '21'){
                    echo "連江縣";
                  }
                  elseif($data['city'] == '22'){
                    echo "澎湖縣";
                  }
                ?>
              </div>
              <div class="form-group">
                客戶地址<?php echo $data['client_address'];?>
              </div>
              <div class="form-group">
                連絡電話：<?php echo $data['phone'];?>
              </div>
              <div class="form-group">
                擔當：<?php echo $data['charge'];?>
              </div>
              <div class="form-group">
                進度：<?php echo $data['progress'];?>
              </div>
              <div class="form-group">
                硬體規格及數量(品牌、規格、數量)：<?php echo $data['hardware'];?>
              </div>
              <div class="form-group">
                狀態：
                <?php 
                  if($data['status'] == '1'){
                    echo "進行中";
                  }
                  elseif($data['status'] == '2'){
                    echo "win";
                  }
                  elseif($data['status'] == '3'){
                    echo "lost";
                  }
                  elseif($data['status'] == '4'){
                    echo "cancel";
                  }
                  elseif($data['status'] == '5'){
                    echo "合作案件";
                  }
                ?>

              </div>
              <a href="caselist.php" class="btn btn-primary btn-xs">上一頁</a>
						</form>
		  <hr>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
      </footer>

      
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
