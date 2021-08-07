<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eTag資訊網</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    
    
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<!--<link rel="stylesheet" href="css/googlemap.css"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style type="text/css">
/*body,html,.main-display-area,.col-md-7 {
   height:100%;
}*/
 .myframediv { position: relative; padding-bottom: 100%; height: 0; overflow: hidden; max-width: 100%; min-height: 100%; } 
 .myframediv iframe, .myframediv object, 
 .myframediv embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
</style>
	<script type="text/javascript">
    //     window.setInterval(SetCwinHeight, 500); //定時執行
    
    //     function SetCwinHeight()
    //     {
    // var iframeid=document.getElementById("mainframe"); //iframe id

    // if (document.getElementById)
    // {   
    //     if (iframeid && !window.opera)
    //     {   
    //         if (iframeid.contentDocument && iframeid.contentDocument.body.offsetHeight)
    //         {   
    //            iframeid.height = iframeid.contentDocument.body.offsetHeight;  
                 
    //         }else if(iframeid.Document && iframeid.Document.body.scrollHeight)
    //         {   
    //           iframeid.height = iframeid.Document.body.scrollHeight;                 
    //         }   
    //     }
    // }
    // }

    </script>
    
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                            |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="starter.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>eTag</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>eTag資訊網</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
           
              <!-- Notifications Menu -->
     
              <!-- Tasks Menu -->
      
              <!-- User Account Menu -->
             
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">eTag資訊</li>
            <!-- Optionally, you can add icons to the links -->
             <li class="active">
                <a href="?page=menu/point_map.php"><!--?page=app_operating.php-->
                    <i class="fa fa-link"></i>
                   <span>點位分佈圖</span>
                </a>
             </li>  
                      		
             <li class="active">
             	<!--<a href="menu/point_map.php"><i class="fa fa-link"></i> <span>點位分布圖</span></a>-->
                <a href="?page=menu/result_inquiry.php">
                    <i class="fa fa-link"></i>
                   <span>旅行時間查詢</span>
                </a>
             </li>
            <li class="treeview active">

              <a href="#">
                <i class="fa fa-dashboard"></i> <span>旅行時間分析圖</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="?page=menu/analysis_chart1.php"><i class="fa fa-circle-o"></i> 中港路分析圖</a></li>
                <li><a href="?page=menu/analysis_chart2.php"><i class="fa fa-circle-o"></i> 五權路分析圖</a></li>
                    <li><a href="?page=menu/analysis_chart3.php"><i class="fa fa-circle-o"></i> 中清路分析圖</a></li>
              </ul>
            </li>





           

       

                
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
     
          <section>
			<div id="content-wrapper" class = "myframediv">
			<?php
                if (isset($_GET["page"])){
                    $page = $_GET["page"];
                    $proj_id = $_GET["proj_id"];
                    $page=$page."?proj_id=".$proj_id;
                 }
                    echo "<iframe src=\"$page\" name=\"mainframe\"  width = \"100\" height = \"100%\" frameborder=\"0\" style=\"position:absolute\"  scrolling=\"yes\" frameborder=\"0\" id=\"mainframe\"  ></iframe>";
            ?>    
			</div>  
      <!-- 上面是連到frame的地方 這裡有問題@O.O QAQ  -->
          
        </section>

        <!-- Main content -->
        <section class="content">
			<div id="googleMap"></div>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
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
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
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
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- Include Google Maps API (Google Maps API v3 已不需使用 API Key) -->



</body>
</html>
