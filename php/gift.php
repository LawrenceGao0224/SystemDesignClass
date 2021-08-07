<?php
     session_start();
	require_once 'db.php';
	require_once 'function.php';
    
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {
		$saveresult = gift($_GET,$link); //這邊才對
		if($saveresult==0){
			echo "儲存成功";
			$good = 1;
		}
		elseif($saveresult==1){
			$good = 2;
		}
	}
	
	
	
	
	header('Location: ../index.php?good='.$good);
?>