<?php
     session_start();
	require_once 'db.php';
	require_once 'function.php';
    
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {
		print_r($_POST);
		$saveresult = buysave($_POST,$link); //這邊才對
		echo $saveresult;
		if($saveresult==0){
			echo "儲存成功";
			$good = 1;
			//echo "<script>alert('商品新增成功~~');</script>";
		}
		elseif($saveresult==1){
			$good = 2;
		}
		elseif($saveresult==2){
			$good = 3;
		}
		elseif($saveresult==3){
			$good = 4;
		}
		elseif($saveresult==4){
			$good = 5;
		}
	}
	
	
	
	
	header('Location: ../purchase.php?good='.$good);
?>