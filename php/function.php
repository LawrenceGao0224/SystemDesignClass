<?php

     //管理員登錄
    function mlogin($link,$username = null, $password = null){
		$has_user = FALSE;
	    $sql = "SELECT * FROM `manager` WHERE `account` = '$username' AND `password` = '$password';";
        $result = mysqli_query($link,$sql);
        if($result){
	   	   while($row = mysqli_fetch_array($result)){
      				  $has_muser = TRUE;
			          $mloginusername = $row['username'];
					  $mloginuserid = $row['id'];
				      $GLOBALS[mloginusername] = $mloginusername;
					  $GLOBALS[mloginuserid] = $mloginuserid;
  		   }
	   				    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $has_muser;
	}
    if(!isset($mloginusername)){
    	$mloginusername = "null";
    }
	
	if(!isset($mloginuserid)){
    	$mloginuserid = "null";
    }
	
	function getmloginusername(){
		
		return $GLOBALS[mloginusername];
	}
	
	function getmloginuserid(){
		
		return $GLOBALS[mloginuserid];
	}
	 
    //會員登錄
    function login($link,$username = null, $password = null){
		$has_user = FALSE;
	    $sql = "SELECT * FROM `member` WHERE `username` = '$username' AND `password` = '$password';";
        $result = mysqli_query($link,$sql);
        if($result){
	   	   while($row = mysqli_fetch_array($result)){
      				  $has_user = TRUE;
			          $loginusername = $row['username'];
					  $loginuserid = $row['id'];
				      $GLOBALS[loginusername] = $loginusername;
					  $GLOBALS[loginuserid] = $loginuserid;
  		   }
	   				    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $has_user;
	}
	if(!isset($loginusername)){
    	$loginusername = "null";
    }
	
	if(!isset($loginuserid)){
    	$loginuserid = "null";
    }
	
	function getloginusername(){
		
		return $GLOBALS[loginusername];
	}
	
	function getloginuserid(){
		
		return $GLOBALS[loginuserid];
	}
	
	//儲存服務滿意度調查表
	function servicesave($data,$link){
		$saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		if($data['opinion']){
		    $sql = "INSERT INTO `service` (`name` , `assessment` ,`proj_con`, `sle_a` , `sle_b` , `sle_c` , `sle_d` , `sle_e` , `sle_f` , `opinion` , `ser_time` ) value ('{$data['name']}' , '{$data['assessment']}' , '{$data['proj_con']}' , '{$data['sle_a']}'
		                                       , '{$data['sle_b']}' , '{$data['sle_c']}' , '{$data['sle_d']}' , '{$data['sle_e']}' , '{$data['sle_f']}' , '{$data['opinion']}' , '{$time}')";
	    }
		else{
			$sql = "INSERT INTO `service` (`name` , `assessment` , `sle_a` , `sle_b` , `sle_c` , `sle_d` , `sle_e` , `sle_f` , `ser_time` ) value ('{$data['name']}' , '{$data['assessment']}' , '{$data['sle_a']}'
		                                       , '{$data['sle_b']}' , '{$data['sle_c']}' , '{$data['sle_d']}' , '{$data['sle_e']}' , '{$data['sle_f']}' , '{$time}')";
		}
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤";
		}
		return $saveresult;
	} 
	
	//儲存計劃性進貨申請表
    function purchasesave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$deadline = $data['date'] . ' ' . $data['time'];
		$sql = "INSERT INTO `sell` (`content` , `base` , `seller` , `expire`) value ('{$data['content']}' , '{$data['base']}' , '{$data['seller']}','{$deadline}')"; 
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤";
		}
		return $saveresult;
	}
	
	function buysave($data, $link) {
        $saveresult = 0;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		
		$sql = "select `money` from `member` where `username` = '{$data['buy']}'";
        $result = mysqli_query($link,$sql);
        if($result){
	      while($row = mysqli_fetch_array($result)){
            $money1 = $row['money'];
     	  }
	      mysqli_free_result($result);
        }
		
		$sql = "select `money`,`base` from `sell`";
        $result = mysqli_query($link,$sql);
        if($result){
	      while($row = mysqli_fetch_array($result)){
            $money = $row['money'];
			  $base = $row['base'];
     	  }
	      mysqli_free_result($result);
        }
		$sql = "select `money` from `sell` where `buy` = '{$data['buy']}'";
        $result = mysqli_query($link,$sql);
        if($result){
          $total_money = 0;
	      while($row = mysqli_fetch_array($result)){
            $total_money += $row['money'];
			   
			  //$base = $row['base'];
     	  }
		  echo $money1;
	      mysqli_free_result($result);
        }
		$money2 = $data['money'] + $total_money;
		if($money1 >= $money2){
		  $saveresult = 4;
		  return $saveresult;
		  if($data['money'] > $money && $data['money'] > $base && $data['money'] <= $money1){
		  	$sql = "update `sell` set `money` = '{$data['money']}' , `buy` = '{$data['buy']}' where `id` = '{$data['id']}'"; 
		    $result = mysqli_query($link,$sql);
		    if($result){
			  if(!isset($data['id'])){
			    $new_id = mysqli_insert_id($link);
			    echo "執行成功，新增後的ID為{$new_id}";
			  }
			  $saveresult = 0;
		    }
		    else{
			  echo "{$sql}語法執行錯誤";
		    }
		  }	  	
		}
		if($data['money'] < $money){
		  $saveresult = 1;
		}
		if($data['money'] < $base){
		  $saveresult = 2;
		}
		if($data['money'] > $money1){
		  $saveresult = 3;
		}
		if($money1 >= $money2){
		  $saveresult = 4;
		}
		return $saveresult;
	}

    function gift($data, $link) {
        $saveresult = 0;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		
		$sql = "select * from `card` where `index` = '{$data['index']}'";
        $result = mysqli_query($link,$sql);
        if($result){
          foreach($result as $key => $row){
            $content[$key] = $row['content'];
			$num[$key] = $row['num']-1;
     	  }
	      mysqli_free_result($result);
        }
		
		for($i = 0;$i < 8;$i++){
		  $sql = "update `card` set `num` = '{$num[$i]}' where `content` = '{$content[$i]}' && `index` = '{$data['index']}'";
		  $result = mysqli_query($link,$sql);
		}
		
		$sql = "select `money` from `member` where `id` = '{$data['index']}'";
        $result = mysqli_query($link,$sql);
        if($result){
	      while($row = mysqli_fetch_array($result)){
            $money = $row['money']+1000;
     	  }
	      mysqli_free_result($result);
        }
		
		$sql = "update `member` set `money` = '{$money}' where `id` = '{$data['index']}'";
		$result = mysqli_query($link,$sql);
		if($result){
			$saveresult = 0;
		}
		else{
			$saveresult = 1;
		}
		
		return $saveresult;
	}

	//儲存顧問服務需求單
    function listsave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		if($data['other']){
		    $sql = "INSERT INTO `list` (`dep_name` , `ask_name` ,`client`, `proj_name` , `client_name` , `client_title` , `phone` , `mail` , `client_address`, `money` , `deadline` , `other` , `pur_time` ) value ('{$data['dep_name']}' , '{$data['ask_name']}' , '{$data['client']}', '{$data['proj_name']}' , '{$data['client_name']}' , '{$data['client_title']}' , '{$data['phone']}' , '{$data['mail']}' , '{$data['client_address']}', '{$data['money']}' , '{$data['deadline']}' , '{$data['other']}' , '{$time}')";
	    }
		else{
			 $sql = "INSERT INTO `list` (`dep_name` , `ask_name` ,`client`, `proj_name` , `client_name` , `client_title` , `phone` , `mail` , `client_address`, `money` , `deadline` , `pur_time` ) value ('{$data['dep_name']}' , '{$data['ask_name']}' , '{$data['client']}', '{$data['proj_name']}' , '{$data['client_name']}' , '{$data['client_title']}' , '{$data['phone']}' , '{$data['mail']}' , '{$data['client_address']}', '{$data['money']}' , '{$data['deadline']}' , '{$time}')";
		}
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤";
		}
		return $saveresult;
	}

	function casesave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$sql = "INSERT INTO `case` (`case_date` , `case_time` , `dep_name` , `ask_name` ,`client`, `proj_name` , `client_name` , `client_title` , `phone` , `casemoney`, `hwmoney` , `deadline` , `describe` , `pur_time` , `city` , `client_address` , `charge` , `progress` , `hardware` , `status`,`mail`) value ('{$data['case_date']}' , '{$data['case_time']}' , '{$data['dep_name']}' , '{$data['ask_name']}' , '{$data['client']}', '{$data['proj_name']}' , '{$data['client_name']}' , '{$data['client_title']}' , '{$data['phone']}' , '{$data['casemoney']}' , '{$data['hwmoney']}' , '{$data['deadline']}' , '{$data['describe']}' , '{$time}', '{$data['city']}', '{$data['client_address']}', '{$data['charge']}', '{$data['progress']}', '{$data['hardware']}', '{$data['status']}', '{$data['mail']}')";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤";
		}
		return $saveresult;
	}

	//儲存產品報備表
    function productsave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$sql = "INSERT INTO `products` (`sle_a` , `proj_cash` , `product_cash` , `product_text` , `proj_status` , `proj_support` , `sle_b` , `single_date` , `bus_name` , `mail` , `bus_phone` , `proj_name` , `com_name` , `person_name` , `person_branch` , `person_title` , `person_mail` , `person_phone` , `person_address` , `prod_time`) value ( '{$data['sle_a']}' , '{$data['proj_cash']}' , '{$data['product_cash']}' , '{$data['product_text']}' , '{$data['proj_status']}' , '{$data['proj_support']}' , '{$data['sle_b']}' , '{$data['date']}' , '{$data['bus_name']}' ,  '{$data['mail']}' , '{$data['bus_phone']}' , '{$data['proj_name']}' , '{$data['com_name']}' , '{$data['person_name']}' , '{$data['person_branch']}' , '{$data['person_title']}' , '{$data['person_mail']}' , '{$data['person_phone']}' , '{$data['person_address']}' , '{$time}')";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤";
		}
		return $saveresult;
	}
	
	//取得所有的產品報備表
	function getallproduct($link){
        $datas = array();
	    $sql = "SELECT * FROM `products` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }
	
	//取單一產品報備表
	function getproduct($link,$id){
        $product = null;
	    $sql = "SELECT * FROM `products` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $product = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $product;
    }
	//取計劃進貨申請表
	function getallpurchase($link){
        $datas = array();
	    $sql = "SELECT * FROM `purchase` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }
	
	function getallsell($link){
        $datas = array();
	    $sql = "SELECT * FROM `sell` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }

    //取案件
	function getallcase($link){
        $datas = array();
	    $sql = "SELECT * FROM `case` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }
	
	//取單一計劃進貨申請表
	function getpurchase($link,$id){
        $product = null;
	    $sql = "SELECT * FROM `purchase` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $product = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $product;
    }
    //取單一案件
	function getcase($link,$id){
        $product = null;
	    $sql = "SELECT * FROM `case` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $product = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $product;
    }
	
	//取報價清單
	function getallquoted($link){
        $datas = array();
	    $sql = "SELECT * FROM `quoted_pricea` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }
	
	//取單一報價清單
	function getquoted($link,$id){
        $product = null;
	    $sql = "SELECT * FROM `quoted_pricea` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $product = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $product;
    }
	
	//取得所有專案名稱
	function getprojectinfo($link){
		$datas = array();
		$sql = "SELECT * FROM `proj_info`;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
	}
	
	//取單一專案資料
	function getthisprojectinfo($link,$id){
        $project = null;
	    $sql = "SELECT * FROM `proj_info` WHERE `proj_id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $project = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $project;
    }
	
	//取單ㄧ專案圖片
	function getthisevent($link,$id){
        $datas = array();
	    $sql = "SELECT * FROM `event` WHERE `postindex` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $datas;
    }
	
	//取得所有的會員資料
	function getallmember($link){
        $datas = array();
	    $sql = "SELECT * FROM `member` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }
	
	//取單一會員資料
	function getthisuser($link,$id){
        $user = null;
	    $sql = "SELECT * FROM `member` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $user = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $user;
    }
	
	//取單一爆架清單資料
	function getthisquote($link,$id){
        $quote = null;
	    $sql = "SELECT * FROM `quoted_pricea` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $quote = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $quote;
    }
	
	//取管理員資料
	function getthismanager($link,$id){
        $user = null;
	    $sql = "SELECT * FROM `manager` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $user = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $user;
    }
	
	//儲存會員
    function usersave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$sql = "INSERT INTO `member` (`chinesename` , `username` , `password` , `createtime` , `email`  , `height`, `weight` , `gender` , `marriage` , `phone` , `address`  , `englishname` 
				) value ( '{$data['chinese_name']}' , '{$data['user_name']}' , '{$data['password']}' , '{$time}' , '{$data['mail']}' , '{$data['height']}' , '{$data['weight']}' , '{$data['gender']}' , '{$data['marriage']}' ,  '{$data['phone']}' , '{$data['address']}' , '{$data['english_name']}' 
				)";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		return $saveresult;
	}
	
	//儲存會員修改資料
		function useredit($link,$data) {
			$edit_result = false;	
			date_default_timezone_set('Asia/Taipei');
		    $time = date("Y-m-d H:i:s");
			//print_r($id);	
			$sql = "UPDATE `member` SET `chinesename` = '{$data['chinese_name']}' , `username` = '{$data['user_name']}' 
			, `password` =  '{$data['password']}'  , `modifytime` = '{$time}' , `email` ='{$data['mail']}' , `height` = '{$data['height']}' 
			, `weight` = '{$data['weight']}' , `gender` = '{$data['gender']}' , `marriage` = '{$data['marriage']}' , `phone` = '{$data['phone']}' 
			, `address` = '{$data['address']}' , `englishname` = '{$data['english_name']}' , `birthday` = '{$data['birthday']}'  where `id` = '{$data['id']}';";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$edit_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $edit_result;
		}
	
	//取得所有的專案
	function getallproject($link){
        $datas = array();
	    $sql = "SELECT * FROM `proj_info` order by `proj_id` desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }
	
	//取單一專案資料
	function getthisproject($link,$id){
        $project = null;
	    $sql = "SELECT * FROM `proj_info` WHERE `proj_id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $project = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $project;
    }
	
	//儲存專案修改資料
		function projectedit($link,$data) {
			$edit_result = false;	
			date_default_timezone_set('Asia/Taipei');
		    $time = date("Y-m-d H:i:s");
			//print_r($id);	
			$sql = "UPDATE `proj_info` SET `proj_name` = '{$data['proj_name']}' , `proj_data` = '{$data['proj_data']}' 
			, `modifytime` = '{$time}'  where `proj_id` = '{$data['proj_id']}';";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$edit_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $edit_result;
		}
		
		//儲存專案
    function projectsave($data, $link,$name) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO `proj_info` (`proj_name` , `proj_data` , `proj_time` , `proj_user` ) value ( '{$data['proj_name']}' , '{$data['proj_data']}' , '{$time}' , '{$name}' )";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		//return $saveresult;
	}
	
	//專案封鎖
		function closeproject($link,$id) {
			$closeresult = false;	
				
			$sql = "UPDATE `proj_info` SET `status` = '1' where `proj_id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$closeresult = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $closeresult;
		}
		
		//專案開通
		function openproject($link,$id) {
			$openresult = false;	
				
			$sql = "UPDATE `proj_info` SET `status` = '0' where `proj_id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$openresult = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $openresult;
		}
		
		//取得所有的消息
	function getallnews($link){
        $datas = array();
	    $sql = "SELECT * FROM `news_all` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }
	
	//新聞隱藏
		function closenews($link,$id) {
			$closeresult = false;	
				
			$sql = "UPDATE `news_all` SET `power` = '1' where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$closeresult = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $closeresult;
		}
		
		//專案開通
		function opennews($link,$id) {
			$openresult = false;	
				
			$sql = "UPDATE `news_all` SET `power` = '0' where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$openresult = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $openresult;
		}
		
		//消息刪除
		function del_news($link,$id) {
			$del_result = false;	
				
			$sql = "DELETE FROM `news_all` where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$del_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $del_result;
		}
		
		//儲存新聞
    function newssave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$uid = $_SESSION["mname"];
		//echo $uid;
		$sql = "INSERT INTO `news_all` ( `news_data` , `news_time` , `user_account` , `power` ) value (  '{$data['news_data']}' , '{$time}' , '{$uid}' , '0' )";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		return $saveresult;
	}
	
	//取得所有的專案服務之調查統計總表
	function getallservice($link){
        $datas = array();
	    $sql = "SELECT * FROM `service` order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }
	
	//取得專案服務之調查統計總表的數量
	function getservicenum($link){
		$num = null;
		$sql = "SELECT * FROM `service` order by id desc;";
		$result = mysqli_query($link,$sql);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$num = mysqli_num_rows($result);
			}
			mysqli_free_result($result);
		}
		else{
			echo "{$sql}語法直行失敗，錯誤訊息：" . mysqli_error($link);
		}
		return $num;
	}
	
	//取得計畫性進貨報表的數量
	function getpurchasenum($link){
		$num = null;
		$sql = "SELECT * FROM `purchase` order by id desc;";
		$result = mysqli_query($link,$sql);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$num = mysqli_num_rows($result);
			}
			mysqli_free_result($result);
		}
		else{
			echo "{$sql}語法直行失敗，錯誤訊息：" . mysqli_error($link);
		}
		return $num;
	}

	//取得案件的數量
	function getcasenum($link){
		$num = null;
		$sql = "SELECT * FROM `case` order by id desc;";
		$result = mysqli_query($link,$sql);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$num = mysqli_num_rows($result);
			}
			mysqli_free_result($result);
		}
		else{
			echo "{$sql}語法直行失敗，錯誤訊息：" . mysqli_error($link);
		}
		return $num;
	}
	
	//取得產品報備表的數量
	function getproductnum($link){
		$num = null;
		$sql = "SELECT * FROM `products` order by id desc;";
		$result = mysqli_query($link,$sql);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$num = mysqli_num_rows($result);
			}
			mysqli_free_result($result);
		}
		else{
			echo "{$sql}語法直行失敗，錯誤訊息：" . mysqli_error($link);
		}
		return $num;
	}
	
	//專案服務之調查統計總表刪除
		function del_service($link,$id) {
			$del_result = false;	
				
			$sql = "DELETE FROM `service` where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$del_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $del_result;
		}

		//專案服務之調查統計總表刪除
		function del_case($link,$id) {
			$del_result = false;	
				
			$sql = "DELETE FROM `case` where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$del_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $del_result;
		}
		
		//取單一專案資料
	function getthisservice($link,$id){
        $service = null;
	    $sql = "SELECT * FROM `service` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $service = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $service;
    }
	
	function getmycard($link,$index){
        $datas = array();
	    $sql = "SELECT * FROM `card` where `index` = {$index} order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }
	
	function getmyshop($link,$index){
        $datas = array();
	    $sql = "SELECT * FROM `sell` where `seller` = {$index} order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		return $datas;
    }

    //取單一案件
	function getthiscase($link,$id){
        $service = null;
	    $sql = "SELECT * FROM `case` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $service = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $service;
    }
	
	//取單一計劃進貨申請表
	function getthispurchase($link,$id){
        $purchase = null;
	    $sql = "SELECT * FROM `purchase` WHERE `id` = {$id};";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) == 1){
   		        $purchase = mysqli_fetch_assoc($result);
		    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
        }	
		
		return $purchase;
    }
	
	//消息計劃進貨申請表
		function del_purchase($link,$id) {
			$del_result = false;	
				
			$sql = "DELETE FROM `purchase` where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$del_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $del_result;
		}
	
	//消息刪除
		function del_product($link,$id) {
			$del_result = false;	
				
			$sql = "DELETE FROM `products` where `id` = {$id};";
			$result = mysqli_query($link,$sql);
			if ($result) {
				$del_result = true;
				//mysql_free_result($result);
			} else {
				echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
			}
			
			return $del_result;
		}
		//專案權驗增加
	function memberadd($id,$link,$p_id)  {
		$add = false;	
		$proid = "pro_" .  $p_id;
		$user = getthisuser($link,$id);
		if(!isset($user['{$proid}'])){
			$sql1 = "ALTER TABLE `member` ADD `$proid` INT(11) NULL AFTER `pro_4`;";
		    $result1 = mysqli_query($link,$sql1);
			$sql = "UPDATE `member` SET `$proid` = '1'  WHERE `id` = {$id};";
		    $result = mysqli_query($link,$sql);
		}
		else{
		    $sql = "UPDATE `member` SET `$proid` = '1'  WHERE `id` = {$id};";
		    $result = mysqli_query($link,$sql);
		}
		if ($result) {
			$add = true;
			//mysql_free_result($result);
		} else {
			echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
		}
			
		return $add;
	}
		
		//踢出群組
	function remove($link,$id,$pid) {
		$remove = false;	
		$str = "pro_" . $pid;
			
		$sql = "UPDATE `member` SET `$str` = '0' where `id` = {$id};";
		$result = mysqli_query($link,$sql);
		if ($result) {
			$remove = true;
			//mysql_free_result($result);
		} else {
			echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
		}
		
		return $remove;
	}
		
		//儲存發文
    function articlesave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$uid = $_SESSION["name"];
		//echo $uid;
		$sql = "INSERT INTO `article` ( `writer` , `time` , `content` , `postindex`) value ('{$uid}' , '{$time}' , '{$data['content']}' , '{$data['postindex']}')";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		return $saveresult;
		$saveresult = false;
		date_default_timezone_set('Asia/Taipei');
        $time = date("Y-m-d H:i:s");
		$uid = $_SESSION["name"];
		/*$sql = "SELECT `name` FROM `user` WHERE `id` = {$uid}";
		$result = mysql_query($sql);
		$id = mysql_fetch_assoc($result);*/
        //新增
        $field = array();
		$fieldvalue = array();
		foreach($data as $key => $value){
			$field[] = "`{$key}`";
			$fieldvalue[] = "'{$value}'";
		}
		$field[] = "`time`";
		$fieldvalue[] = "'{$time}'";
		$field[] = "`writer`";
		$fieldvalue[] = "'{$uid}'";
        $sql = "INSERT INTO `article` (" . join(", " , $field) . ")
                      VALUE (" . join(", " , $fieldvalue) . ");";
		
		
		//echo $sql;
		$result = mysqli_query($link,$sql);
		if ($result) {
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
			    echo "執行成功，新增後的id為{$new_id}";
			}

			$saveresult =TRUE;
		} else {
			echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
		}
        return $saveresult;
	}
	
	//取單一專案po文
	function getthisarticle($link,$id){
        $article = array();
	    $sql = "SELECT * FROM `article` WHERE `postindex` = {$id} order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $article[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		
		return $article;
    }
	
	//刪除發文
	function removearticle($link,$id) {
		$remove = false;				
		$sql = "DELETE FROM `article` WHERE `id` = {$id};";
		$result = mysqli_query($link,$sql);
		if ($result) {
			$remove = true;
			//echo $id;
			//mysql_free_result($result);
		} else {
			echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
		}
		
		return $remove;
	}
	
	//刪除報價清單
	function del_quoted($link,$id) {
		$remove = false;				
		$sql = "DELETE FROM `quoted_pricea` WHERE `id` = {$id};";
		$result = mysqli_query($link,$sql);
		$sql = "DELETE FROM `quoted_priceb` WHERE `qpid` = {$id};";
		$result2 = mysqli_query($link,$sql);
		if ($result && $result2) {
			$remove = true;
			//echo $id;
			//mysql_free_result($result);
		} else {
			echo "{$sql}語法執行失敗，錯誤訊息：" . mysqli_error($link);
		}
		
		return $remove;
	}
	
	
		//儲存留言
    function msgsave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$uid = $_SESSION["name"];
		//echo $uid;
		$sql = "INSERT INTO `msg` ( `writer` , `time` , `content` , `postindex`) value ('{$uid}' , '{$time}' , '{$data['msg']}' , '{$data['article_id']}')";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		return $saveresult;
	}
	
	//圖片留言
    function imagesave($data, $link) {
        $saveresult = false;
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		//echo $uid;
		$sql = "INSERT INTO `event` ( `path` , `time` , `postindex`) value ('{$data['imagepath']}' , '{$time}' , '{$data['postindex']}')";
		$result = mysqli_query($link,$sql);
		if($result){
			if(!isset($data['id'])){
				$new_id = mysqli_insert_id($link);
				echo "執行成功，新增後的ID為{$new_id}";
			}
			$saveresult = true;
		}
		else{
			echo "{$sql}語法執行錯誤" . mysqli_error($link);
		}
		return $saveresult;
	}
	
	//取得所有的留言
	function getmsg($link,$pid){
        $datas = array();
	    $sql = "SELECT * FROM `msg` WHERE `postindex` = '$pid' order by id desc;";
        $result = mysqli_query($link,$sql);
        if($result){
   	        if(mysqli_num_rows($result) > 0){
   		        while($row = mysqli_fetch_assoc($result)){
		     	    $datas[] = $row;
	   		    }
    	    }
	   	    mysqli_free_result($result);
        }
        else{
    	    echo "{$sql}語法執行失敗，錯誤訊息：" . mysql_error($link);
        }	
		return $datas;
    }
	
?>