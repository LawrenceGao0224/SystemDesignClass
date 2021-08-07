<?php
    session_start();
	
	require_once 'db.php';
	require_once 'function.php';
    
	$sql = "select `count` from `count`";
	$result = mysqli_query($link,$sql);
	if($result){
	  while($row = mysqli_fetch_array($result)){
      	$count = $row['count'];
  	  }
	  mysqli_free_result($result);
    }
	
	$count++;
	$sql = "update `count` set `count` = '{$count}' where `id` = '1'"; 
    $result = mysqli_query($link,$sql);
	
	if(isset($_POST['u']) && isset($_POST['p'])){
		$has_user = login($link,$_POST['u'], $_POST['p']);
		if($has_user){			
			$_SESSION["is_login"] = TRUE;	
			$_SESSION["name"]=getloginusername();
			$_SESSION["id"] = getloginuserid();
			header('Location:../index.php');			
		}
		else{
			$_SESSION['is_login'] = FALSE;
			$_SESSION['msg'] = '登錄失敗，請重新輸入帳號密碼';
			header('Location:../login.php');									
		}
	}
?>