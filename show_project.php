<?php
  session_start();
	
  require_once 'php/db.php'; 
  require_once 'php/function.php';
	
  $user = getthisuser($link,$_SESSION['id']);
  $project_info = getprojectinfo($link);
  if(isset($_GET["id"])){
    $data = getthisprojectinfo($link,$_GET["id"]);
	$article = getthisarticle($link,$_GET["id"]);
  }
  //print_r($_GET["id"]);
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
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/dropzone.css" />
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style type="text/css">
    .tabs {
      width: 100%;
      display: inline-block;
    }

    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
      display: block;
      clear: both;
      content: '';
    }

    .tab-links li {
      margin: 0px 5px;
      float: left;
      list-style: none;
    }

    .tab-links a {
      padding: 9px 15px;
      display: inline-block;
      border-radius: 3px 3px 0px 0px;
      background: #ffffff;
      font-size: 16px;
      font-weight: 600;
      color: #4c4c4c;
      transition: all linear 0.15s;
    }

    .tab-links a:hover {
      background: #a7cce5;
      text-decoration: none;
    }

    li.active a, li.active a:hover {
      background: #fff;
      color: #4c4c4c;
    }

    /*----- Content of Tabs -----*/
    .tab-content {
      padding: 15px;
      border-radius: 3px;
      box-shadow: -1px 1px 1px rgba(0,0,0,0.15);
      background: #fff;
    }

    .tab {
      display: none;
    }

    .tab.active {
      display: block;
    }
    form.dropzone{
      width: 700px;
            
      background-color:#FFFFFF;
      border-style:solid;
      border-width:1px; 
      border-style:solid;
      border-color:#000000; 
    }
        
        #drop_zone {
          height:250px;
            border: 2px dashed #bbb;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            font: 15pt bold 'Vollkorn';
            color: #bbb;
        }
    </style>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <script>
      jQuery(document).ready(function() {
        jQuery('.tabs .tab-links a').on('click', function(e)  {
          var currentAttrValue = jQuery(this).attr('href');
 
          // Show/Hide Tabs
          jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
          // Change/remove current tab to active
          jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
          e.preventDefault();
        });
      });
      
      function dragoverHandler(evt) {
            evt.preventDefault();
        }
        function dropHandler(evt) {//evt 為 DragEvent 物件
            evt.preventDefault();
            var files = evt.dataTransfer.files;//由DataTransfer物件的files屬性取得檔案物件
            var fd = new FormData();
            var xhr = new XMLHttpRequest();
            var up_progress = document.getElementById('up_progress');
            xhr.open('POST', 'php/imagesave.php');//上傳到imagesave.php
            xhr.onload = function() {
                //上傳完成
                up_progress.innerHTML = '100 %, 上傳完成';
            };
            xhr.upload.onprogress = function (evt) {
              //上傳進度
              if (evt.lengthComputable) {
                var complete = (evt.loaded / evt.total * 100 | 0);
                if(100==complete){
                    complete=99.9;
                }
                up_progress.innerHTML = complete + ' %';
              }
            }
 
         
            for (var i in files) {
                if (files[i].type == 'image/jpeg') {
                    //將圖片在頁面預覽
                    var fr = new FileReader();
                    fr.onload = openfile;
                    fr.readAsDataURL(files[i]);
                     
                    //新增上傳檔案，上傳後名稱為 ff 的陣列
                    fd.append('ff[]', files[i]);
                }
            }
            xhr.send(fd);//開始上傳
        }
        function openfile(evt) {
            var img = evt.target.result;
            var imgx = document.createElement('img');
            imgx.style.margin = "10px";
            imgx.src = img;
            document.getElementById('imgDIV').appendChild(imgx);
        }
    </script>
    
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
          <h2><?php echo $data['proj_name'];?></h2>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="tabs">
            <ul class="tab-links">
             <li class="active">
              <a href="#tab1">專題資訊</a>
            </li>
            <li>
              <a href="#tab2">撰寫貼文</a>
            </li>
          </ul>

						<div class="tab-content">
							<div id="tab1" class="tab active">
								<p><?php echo $data['proj_data'];?></p><br><hr>			
							</div>
							<div id="tab2" class="tab">

								<input type="image" src="images/1428315062_user-group-128.png" class="img-circle" width="50" height="50" disabled>
								<?php echo $user['chinesename'];?>
								<form method="post" action="php/articlesave.php" enctype="multipart/form-data" id="formm">
									<div class="form-group">
										<textarea class="form-control" row="5" cols="50" id="content" name="content" placeholder="在想些什麼?"></textarea>
									</div>
									<div class="form-group">
                    <input type="hidden"  name="postindex" value="<?php echo $data['proj_id'];?>"  >
                  </div>
                  <div id="drop_zone" ondragover="dragoverHandler(event)" ondrop="dropHandler(event)">
                    拖曳圖片到此處上傳
                    <div id="up_progress"></div>
                  </div>
                  <div id="imgDIV"></div>

                  <div class="form-group">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-default" id="submitbtn">發文</button>
                  </div>
                </form>
                <br><br>									
              </div>														
            </div>
					</div> 
					<?php if(isset($article)):?>										
						<?php foreach($article as $row):?>
							<?php 
             $event = getthisevent($link,$row["id"]);
             ?>
             <h2>
              <table width="100%" border="0" align="top" bgcolor="#F5F5F5">
                <tbody>
                  <tr>
                   <td align="left" width="5%"><input type="image" src="images/1428315062_user-group-128.png" class="img-circle" width="50" height="50" disabled></td>
                   <td align="left" width="80%"><b><?php echo $row['writer'];?></b></td>
                   <td align="right" width="15%"><a href="php/remove.php?id=<?php echo $row['id'] ;?>&pid=<?php echo $data['proj_id'];?>"><img src="images/del.png" height="20" width="20" ></a></td>
                 </tr>
               </tbody>
             </table>
           </h2>	
           <input type="image" src="images/下載.png" class="img-circle" width="15" height="15" disabled>
           <?php echo $row['time'];?>	
           <br><br>			            
           &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['content'];?>
           <br>
           <?php if(isset($event)):?>
             <?php foreach($event as $row1):?>

               <input type="image" src="<?php echo $row1['path'];?>" data-toggle="modal" data-target="#<?php echo $row1['id'];?>" width="200" height="200">
               <div class="modal fade" id="<?php echo $row1['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <img src="<?php echo $row1['path']; ?>" width="700" height="700">
                 </div>
               </div>
             </div>
           <?php endforeach;?>

         <?php endif;?>
         <br><br>
         <form action="php/msgsave.php" method="post" enctype="mutipart/form-data">
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="msg" name="msg">
          <input type="hidden" id="proj_id" name="proj_id" value="<?php echo $data['proj_id'];?>">
          <input type="hidden" id="article_id" name="article_id" value="<?php echo $row['id'];?>">
          <button type="submit" class="btn btn-default" id="submitbtn">留言</button>
        </form>	
        <?php $msg=getmsg($link,$row['id']);?>	

        <?php if(isset($msg)):?>
          <hr>
          <?php foreach($msg as $row):?>
           <table style="margin-left:50px">
            <tbody>
             <tr>
              <td align="left" width="10%"><input type="image" src="images/1428315062_user-group-128.png" class="img-circle" width="40" height="40" disabled></td>
              <td colspan="2">
               <b><?php echo $row['writer'];?></b>：<?php echo $row['content'];?><br>
               <?php echo $row['time'];?>
             </td>
           </tr>
         </tbody>
       </table>
     <?php endforeach;?>   
   <?php endif;?>	
 <?php endforeach;?>					                
<?php endif;?>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
      </footer>

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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src='main.js'></script>
    <script>
        $(function() {
            $( "#tabs" ).tabs();
        });
    </script>
  </body>
</html>
