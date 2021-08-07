<?php
    session_start();
	require_once 'db.php';
	require_once 'function.php';
	
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {		
        set_time_limit(0);
        $pic_name = array();//上傳後,所有圖片檔名
        $uploads_dir = '../files';//存放上傳檔案資料夾
        if(is_array($_FILES["ff"]["error"]) && !empty($_FILES["ff"]["error"])){
            foreach ($_FILES["ff"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["ff"]["tmp_name"][$key];
                    $name = $_FILES["ff"]["name"][$key];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    if($ext !== 'jpg' && $ext !== 'jpeg'){
                        continue;
                    }
                    $name = time() . rand(10, 99) . "." . $ext; // 新檔名
                    $res = move_uploaded_file($tmp_name, "$uploads_dir/$name");
                    if($res){
                        $pic_name [] = $name;
                    }
					$uploads_dir = 'files';
					$_POST['imagepath']	 = 	$uploads_dir.'/'.$name;	
					$sql = "SELECT `id` FROM `article` order by id asc;";	
					$result = mysqli_query($link,$sql);
		            if($result){
   	                    if(mysqli_num_rows($result) > 0){
   		                    foreach($result as $row){
   		                    	$postindex = $row['id'];								
   		                    }
    	                }
						$_POST['postindex'] = $postindex + 1;
	   	                mysqli_free_result($result);
                    }
                }
            }
		}
		//print_r($_POST);
		$saveresult = imagesave($_POST,$link); 
	}		
	// $str = "../show_project.php?id=" . $_POST['postindex'];
	// $tomstr = "Location:".$str ;
	// header($tomstr);
?>