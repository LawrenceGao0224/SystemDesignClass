<?php
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';  
  $user = getthisuser($link,$_SESSION['id']);
  $project_info = getprojectinfo($link);
  if(isset($_GET["id"])){
    $data = getpurchase($link,$_GET["id"]);	
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
          <h1>計劃進貨申請表---<?php echo $data['proj_name']?></h1>
        </section>
         

        <!-- Main content -->
        <section class="content">
          <?php
					    if($data['sle_a'] == 1){
							$str1 = "0%";
			    	    }
						elseif($data['sle_a'] == 2){
							$str1 = "25%";
						}
						elseif($data['sle_a'] == 3){
							$str1 = "75%";
						}
						elseif($data['sle_a'] == 4){
							$str1 = "50%";
						}
						else{
							$str1 = "100%";
						}
								
						if($data['sle_b'] == 1){
							$str2 = "已收到訂單";
			    	    }
						elseif($data['sle_b'] == 2){
							$str2 = "無";
						}
						else{
							$str2 = "有訂單，尚在簽核中";
						}
						
						if($data['sle_c'] == 1){
							$str3 = "有，開立中";
			    	    }
						elseif($data['sle_c'] == 2){
							$str3 = "有，簽核中";
						}
						else{
							$str3 = "無";
						}		
			    	?>
		
						<form id="myform" enctype="multipart/form-data" >
							<hr>
							<div class="form-group">
								客戶名稱：<?php echo $data['user_name'];?>
								<br>
							</div>
							<div class="form-group">
								業務人員：<?php echo $data['bus_name'];?>
								<br>
							</div>
							<div class="form-group">
								案件狀態：<?php echo $str1;?>
								<br>
							</div>
							<div class="form-group">
								是否有客戶的訂單：<?php echo $str2;?>
								<br>
							</div>

							<div class="form-group">
								是否已開立銷貨清單：<?php echo $str3;?>
								<br>
							</div>
							<div class="form-group">
								預寄交貨日期：<?php echo $data['pur_date'];?>
							</div>
							<div class="form-group">
								本案負責之PM：<?php echo $data['proj_man'];?>
								<br>
							</div>
							<div class="form-group">
								預計下單設備規格：<?php echo $data['equip_spec'];?>
								<br>
							</div>
							<div class="form-group">
								其他：<?php echo $data['other'];?>
								<br>
							</div>
              <a href="purchase.php" class="btn btn-primary btn-xs">上一頁</a>
						</form>
		  <hr>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
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
