<?php
    session_start();
	
	require_once 'php/db.php'; 
	require_once 'php/function.php';
	

	$user = getthisuser($link,$_SESSION['id']);
	//print_r($user);
	// $project_info = getprojectinfo($link);
	$card = getmycard($link,$_SESSION['id']);
	$sell = getmyshop($link,$_SESSION['id']);
	
	foreach($card as $row){
	  if($row['num'] <= 0){
		$sql = "delete FROM `card` where `id` = {$row['id']};";
        $result = mysqli_query($link,$sql);
	  }
	}
	if(isset($_GET['good']) && $_GET['good'] == 1){
		echo "<script>alert('集滿8張卡片，恭喜獲得獎金ㄧ千元~~~');</script>";
	}
	//print_r($news);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>競標平台</title>


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
          
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;你好</h1>
           <h4> &nbsp;&nbsp;歡迎使用競標平台</h4>
         
        </section>

        <!-- Main content -->
        <section class="content">
          <table class="table table-bordered table-hover dataTable" style="width:80%;background-color: #ffffff">
            <tr>
              <td><b>您目前擁有的卡片</b></td>	
              <td><b>您正在競標的卡片</b></td>
              <td><b>您目前擁有的錢</b></td>
            </tr>
            <?php
              $num = count($card);
			  $count = 1;
			  $haveallcard = 0;
			  echo"<tr>";
			  echo"<td style='width:10%'>";
			  if($card != null){
			    foreach($card as $row){
              	  if($count < $num){
              		echo $row['content'].'有'.$row['num'].'張,<br>';
              	  }
				  else{
					echo $row['content'].'有'.$row['num'].'張';
			  	  }   	
				  $count++;
				  if($row['content'] == 1 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 2 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 3 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 4 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 5 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 6 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 7 && $row['num'] > 0){
				  	$haveallcard++;
				  }
				  if($row['content'] == 8 && $row['num'] > 0){
				  	$haveallcard++;
				  }
                }	
			  }
			  else{
			  	echo "您沒有卡片喔！";
			  }
			  echo"</td>";
			  echo"<td style='width:10%'>";
			  $num = count($sell);
			  $count = 1;
			  if($sell != null){
			  	foreach($sell as $row){
              	  if($count < $num){
              		echo $row['content'].',';
              	  }
				  else{
					echo $row['content'];
				  }   	
				  $count++;
                }
			  }
			  else{
			  	echo "您沒有拍賣喔！";
			  }
			  echo"</td>";
			  echo"<td style='width:80%'>";
				echo '您現在有'.$user['money'].'元';
			  echo"</td>";
			  echo"</tr>";
            ?>
          </table>
          <?php if($haveallcard == 8):?>
          	<button type="button" onclick="location.href='php/gift.php?index=<?php echo $user['id']?>'">兌換獎品</button>
          <?php endif;?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      
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
