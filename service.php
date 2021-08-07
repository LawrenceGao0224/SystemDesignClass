<?php
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';	
  $user = getthisuser($link,$_SESSION['id']);
  $project_info = getprojectinfo($link);
  date_default_timezone_set('Asia/Taipei');//時間用
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
          <h1>資訊事業群3E0服務滿意度調查表</h1>
		  <h5>為了能提升及紮實我們的服務，我們非常重視您的意見，為了提供給您更好的服務品質，
 		  <br>
		      現在要耽誤您寶貴的時間，您的回饋與建議是我們進步的最大動力。
		  </h5>
        </section>

        <!-- Main content -->
        <section class="content">
          <span class="redt">*必填</span>
		  <br>
		  <form method="post" action="php/servicesave.php"  >
			<div class="form-group">
			  <input type="text" name="name" id="name" placeholder="您的大名" >
			</div>
			<hr>
			<div class="form-group">
		                  本次評核的3E0同仁 *
			  <br>
			      請點選此次提供服務的3E0同仁
			</div>
			<div class="form-group">
			  <div class="radio">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>
				  <input type="radio" name="assessment" id="assessment" value="劉瑞豐" checked>
				      劉瑞豐 
				</label>
			  </div>
			  <div class="radio">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>
				  <input type="radio" name="assessment" id="assessment" value="林靖雲">
				      林靖雲 
				</label>
			  </div>
			  <div class="radio">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>
				  <input type="radio" name="assessment" id="assessment" value="陳正龍">
				      陳正龍 
				</label>
			  </div>
			  <div class="radio">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>
				  <input type="radio" name="assessment" id="assessment" value="林裕哲">
				      林裕哲 
				</label>
			  </div>								
              </div>
				<div class="form-group">
				      本次服務的專案或內容 *
			      <br>
				  &nbsp;&nbsp;&nbsp;&nbsp;<textarea id="proj_con" name="proj_con" rows="3" cols="150"></textarea>
				</div>
				<hr>
				<div class="form-group">
		  		      <b>專案服務之調查</b>
				  <br>
				      請針對此次的服務，為我們做簡單的評核及意見回饋，非常感謝!
				</div>
				<div class="form-group">
				  1. 充份了解客戶/業務的問題並解決 *
				</div>
				<div class="form-group">
				     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
				    <input type="radio" name="sle_a" id="sle_a" value="1">
				    1 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_a" id="sle_a" value="2">
					2 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_a" id="sle_a" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_a" id="sle_a" value="4">
					4 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_a" id="sle_a" value="5">
					5 
				  </label>
					非常滿意
				</div>
				<div class="form-group">
			      2. 在客戶／業務期望的時間內回應服務 *
				</div>
				<div class="form-group">
				     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
					<input type="radio" name="sle_b" id="sle_b" value="1">
				    1 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_b" id="sle_b" value="2">
					2 
				  </label>
				  <label class="radio-inline">
				  <input type="radio" name="sle_b" id="sle_b" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_b" id="sle_b" value="4">
					4 
				  </label>
			      <label class="radio-inline">
					<input type="radio" name="sle_b" id="sle_b" value="5">
					5 
				  </label>
				      非常滿意
				</div>
				<div class="form-group">
				  3. 對客戶／業務的需求主動積極跟催 *
				</div>
				<div class="form-group">
				     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
				    <input type="radio" name="sle_c" id="sle_c" value="1">
				    1 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_c" id="sle_c" value="2">
					2 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_c" id="sle_c" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_c" id="sle_c" value="4">
					4 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_c" id="sle_c" value="5">
					5 
				  </label>
				      非常滿意
				</div>
				<div class="form-group">
	 			  4. 專業技術能力符合預期 *
				</div>
				<div class="form-group">
				     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
					<input type="radio" name="sle_d" id="sle_d" value="1">
					1 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_d" id="sle_d" value="2">
					2 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_d" id="sle_d" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_d" id="sle_d" value="4">
					4 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_d" id="sle_d" value="5">
					5 
				  </label>
				      非常滿意
				</div>
				<div class="form-group">
				  5. 交付的文件及回應，品質是否合乎預期 *
				</div>
				<div class="form-group">
				     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
					<input type="radio" name="sle_e" id="sle_e" value="1">
					1 
				  </label>
			      <label class="radio-inline">
					<input type="radio" name="sle_e" id="sle_e" value="2">
					2 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_e" id="sle_e" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_e" id="sle_e" value="4">
					4 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_e" id="sle_e" value="5">
					5 
				  </label>
				      非常滿意
				</div>
				<div class="form-group">
				  6. 此次的合作，整體的服務滿意程度 *
				</div>
				<div class="form-group">
			 	     &nbsp;&nbsp;&nbsp;&nbsp;很不滿意
				  <label class="radio-inline">
					<input type="radio" name="sle_f" id="sle_f" value="1">
					1 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_f" id="sle_f" value="2">
					2 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_f" id="sle_f" value="3">
					3 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_f" id="sle_f" value="4">
					4 
				  </label>
				  <label class="radio-inline">
					<input type="radio" name="sle_f" id="sle_f" value="5">
					5 
				  </label>
				      非常滿意
				</div>
				<hr>
				<div class="form-group">
				      意見回饋 *
				  <br>
				      謝謝你協助我們做調查，如果方便，請給我們一些建議及指正！感謝你的時間～
				  <br>
				  &nbsp;&nbsp;&nbsp;&nbsp;<textarea name="opinion" id="opinion" rows="4"  cols="150"></textarea>
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="alert('謝謝');">
				      送出
				</button>
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
