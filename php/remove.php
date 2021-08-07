<?php
    session_start();
	require_once "db.php";
	require_once "function.php";
	
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
		//print_r($_GET['id']);
		//print_r($_GET['pid']);
		 $saveresult = removearticle($link,$_GET['id']);
		// if($saveresult){
			// echo "刪除成功";
		// }
		// else{
			// echo "刪除失敗";
		// }
	}
	
	$str = "../show_project.php?id=" . $_GET['pid'];
	$tomstr = "Location:".$str ;
	header($tomstr);
?>