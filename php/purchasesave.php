<?php
     session_start();
	require_once 'db.php';
	require_once 'function.php';
    
	if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE) {
		$saveresult = purchasesave($_POST,$link); //這邊才對
		if($saveresult){
			echo "儲存成功";
			//echo "<script>alert('商品新增成功~~');</script>";
		}
		else{
			//echo "<script>alert('商品新增失敗QQ');</script>";
		}
	}
	
	
	
	
	header('Location: ../purchase.php');
?>