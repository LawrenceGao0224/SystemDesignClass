<?php
	require_once '../php/db.php';

	$branch = array();
	$branch['date'] = array();
	$branch['money'] = array();
	
	$sql = "SELECT * FROM `products` order by id asc;";
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
    $i = 0;
    foreach($datas as $row){
        $branch['date'][$i] = $row['prod_time'];
        if($i > 0){
            $branch['money'][$i] = $branch['money'][($i-1)] + $row['proj_cash'];
        }
        else{
            $branch['money'][$i] += $row['proj_cash'];
        }
        $i++;
    }
		
	echo json_encode($branch);
	
?>