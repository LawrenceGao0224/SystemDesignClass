<?php
    session_start();
	require_once 'db.php';
	require_once 'function.php';
    
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {
		$saveresult = msgsave($_POST,$link); //這邊才對
		// if($saveresult){
			// echo "留言成功";
		// }
		// else{
			// echo "留言失敗";
		// }
		// //print_r($_POST);
	}
	
	
	$str = "../show_project.php?id=" . $_POST['proj_id'];
	$tomstr = "Location:".$str ;
	header($tomstr);
?>