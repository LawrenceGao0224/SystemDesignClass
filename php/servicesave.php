<?php
    session_start();
	require_once 'db.php';
	require_once 'function.php'; 
	
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true){
		$saveresult = servicesave($_POST,$link);
		// if($saveresult){
			// echo "儲存成功!";
		// }
		// else{
			// echo "儲存失敗!";
		// }
	}
	header('Location: ../service.php')
?>