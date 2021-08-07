<?php
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';
  $user = getthisuser($link,$_SESSION['id']);
  //$project_info = getprojectinfo($link);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>競標平台</title>
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
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true):?>
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <span class="logo-lg">競標平台</span>
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
              <a href="index.php"><img src="1481117726_go-home.png" width="26" height="26" alt="1"> <span>首頁</span>
              </a>
            </li>
            <li>
              <a href="purchase.php"><img src="1481117390_auction_hammer_gavel.png" width="26" height="26" alt="2"><span>競標</span></a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>新增商品</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <form id="myform" action="php/purchasesave.php" method="post" enctype="multipart/form-data" >							
			<hr>
			<div class="form-group">
			    卡片名稱
			</div>
			<div class="form-group">
			  <select name="content">
				<?php
                  $str1 = "SELECT * FROM `card` where `index` = {$_SESSION['id']} order by id desc;";
                  $res1 = mysqli_query($link,$str1);
                  if (!$res1) {
                    echo $str1;
                    die('Invalid query: ' . mysqli_error($link));
                  }
                  $num1 = mysqli_num_rows($res1);
                  if($num1 != 0){
                    for($j=0;$j<$num1;$j++){
                      $arr1 = mysqli_fetch_array($res1);
					  if($arr1['num'] > 1){
					  	$content = $arr1["content"];
					  }
					  if($content != null){
                ?>
                        <option value="<?php echo $content;?>"><?php echo $content;?></option>
                <?php
                        $content = null;
					  }
                    }
									  }
									  else{
									  	echo "echo <option value='0'>您沒有卡片喔~</option>";
									  }
                                    ?>
                                    </select>
								</div>

								<div class="form-group">
									底價
								</div>
								<div class="form-group">
									<input type="text" cols="30" id="base" name="base" placeholder="底價" >
								</div>
								<div class="form-group">
									截止日期
								</div>
								<div class="form-group">
									<input type="date" id="date" name="date" >
									<input type="time" id="time" name="time" >
								</div>
                                <input type="hidden" id="seller" name="seller" value="<?php echo $user['id'];?>">

								<div class="form-group">
									&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">
								        送出
							        </button>
								</div>
								</form>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- <footer class="main-footer">
        <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
      </footer> -->
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
