<?php
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';
   
  $user = getthisuser($link,$_SESSION['id']);
  $project_info = getprojectinfo($link);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>盟立自動化-產品技術支援處協作平台</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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
          <h1>產品報備表</h1>
					<h5>請各位業務同仁對於要報備的案件，完成以下文件之填寫
							<br>
							『※』為必須完成的，若有資訊不齊，將影響整個報備流程之申請與案件之價格優勢。</h5>
							<span class="redt">*必填</span>
        </section>

        <!-- Main content -->
        <section class="content">					    	
					    <form id="myform" action="php/productsave.php" method="post" enctype="multipart/form-data" >
								<hr>
								<div class="form-group">
									報備產品 *
									<br>
									請填寫您要報備的產品內容
								</div>

								<div class="form-group">
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="1" checked>
											IBM </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="2">
											HP </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="3">
											Dell </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="4">
											NetApp </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="5">
											EMC </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="6">
											VMware </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="7">
											賽門鐵克 </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_a" id="sle_a" value="8">
											CISCO </label>
									</div>
									
								</div>

								<div class="form-group">
									整案預估金額 *
									<br>
									整案的總金額
								</div>

								<div class="form-group">
									<input type="text" id="proj_cash" name="proj_cash" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									相關產品金額 *
									<br>
									報備相關產品的總金額
								</div>

								<div class="form-group">
									<input type="text" id="product_cash" name="product_cash" placeholder="請輸入.." >
								</div>
								<div class="form-group">
									報備產品 *
									<br>
									整案需要報備的產品內容(例如:料號: 425322V_品名:IBM System x3100 M3_數量:100)<br>
									<textarea cols="150" rows="4" name="product_text" id="product_text"></textarea>
								</div>

								<div class="form-group">
									目前案件狀態 *<br>
									<textarea cols="150" rows="4" name="proj_status" id="proj_status"></textarea>
								</div>

								<div class="form-group">
									專案支援理由 *<br>
									<textarea cols="150" rows="4" name="proj_support" id="proj_support"></textarea>
								</div>
                                <div class="form-group">
									此案銷售類型 *
								</div>

								<div class="form-group">
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_b" id="sle_b" value="1" checked>
											新購 </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_b" id="sle_b" value="2">
											升級 </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_b" id="sle_b" value="3">
											增購 </label>
									</div>
									<div class="radio">
										&nbsp;&nbsp;&nbsp;&nbsp;<label>
											<input type="radio" name="sle_b" id="sle_b" value="4">
											維護合約 </label>
									</div>
								</div>

								<div class="form-group">
									預計下單日 *<br>
								</div>

								<div class="form-group">
									<input type="date" id="date" name="date" />
								</div>

								<div class="form-group">
									盟立業務人員 *<br>
									<input type="text"  id="bus_name" name="bus_name" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									盟立業務電子郵件 *<br>
									<input type="text"  id="mail" name="mail" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									盟立業務電話 *<br>
									<input type="text"  id="bus_phone" name="bus_phone" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									專案名稱 *
									<br>
									此案的專案名稱<br>
									<input type="text"  id="proj_name" name="proj_name" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									使用單位 *
									<br>
									請敘述完整公司名稱<br>
									<input type="text"  id="com_name" name="com_name" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人姓名 *
									<br>
									請填寫中文姓名<br>
									<input type="text"  id="person_name" name="person_name" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人部門單位 *
									<br>
									例如:資訊室/電腦室<br>
									<input type="text"  id="person_branch" name="person_branch" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人部門職稱 *
									<br>
									例如:總裁/董事長/主任.....等<br>
									<input type="text" id="person_title" name="person_title" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人電子郵件 *<br>
									<input type="text" id="person_mail" name="person_mail" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人聯絡電話 *
									<br>
									手機/市話<br>
									<input type="text"  id="person_phone" name="person_phone" placeholder="請輸入.." >
								</div>

								<div class="form-group">
									承辦人單位地址 *
									<br>
									請填寫完整中文地址<br>
									<input type="text"  id="person_address" name="person_address" placeholder="請輸入.." >
								</div>
								<div class="form-group">
									&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">
								        送出
							        </button>
								</div>
							</form>				    
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
