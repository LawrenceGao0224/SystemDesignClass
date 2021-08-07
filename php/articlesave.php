<?php
    session_start();
	require_once 'db.php';
	require_once 'function.php';
	
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {		
		$saveresult = articlesave($_POST,$link); 
	}		
	$str = "../show_project.php?id=" . $_POST['postindex'];
	$tomstr = "Location:".$str ;
	header($tomstr);
?>