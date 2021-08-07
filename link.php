<?php

/**********參數設定S***********/
$FileDir=$_SERVER["DOCUMENT_ROOT"]."/mirle/images";//圖檔目錄路徑
$url="125.227.217.160/mirle/images";//抓取URL路徑
$prjo_file_url=$_SERVER["DOCUMENT_ROOT"]."/mirle/project_file";//專案檔案目錄路徑
$event_file_url=$_SERVER["DOCUMENT_ROOT"]."/mirle/event_file";//事件檔案目錄路徑
$url_file="http://125.227.217.160/mirle/event_file";//事件檔案目錄路徑
$url_file="http://125.227.217.160/mirle/project_file";//專案檔案目錄路徑
/**********參數設定E***********/

$database = "etag" ;
$database_host = "localhost" ;
$database_user = "root";
$database_pass = "ursa0601";
$link = mysqli_connect($database_host,$database_user,$database_pass,$database);

//mysql_query("SET NAMES 'utf8mb4'");
//mysqli_select_db("$database",$link);

//Javascript警告訊息,回上一頁
function alert($str) {
echo "<script language = 'javascript'>";
echo "alert(\"$str\");";
echo "history.go(-1);";
echo "</script>";
exit;
}

//Javascript警告訊息
function alert2($str) 
{
	echo "<script language = 'javascript'>";
	echo "alert(\"$str\");";
	echo "</script>";
}

function doSelect($sql,&$result) {//計算資料筆數
	$result = mysqli_query($GLOBALS['link'],$sql) or die ($sql);
	$num = mysqli_num_rows($result);
	return $num;
}

function load_variables()//免用POST跟GET的方法
{
	while (list ($_key_,$_val_) = each ($_GET)) {
		global	$$_key_;
		$$_key_ = $_val_;
	} 
	while (list ($_key_,$_val_) = each ($_POST)) {
		global	$$_key_;
		$$_key_ = $_val_;
	} 
}

function countSelect($id,$show){ //搜尋筆數

	$sql ="SELECT * FROM mis_user_info WHERE id='$id' ";
	$num = doSelect($sql,$result);
	if($row=mysqli_fetch_array($GLOBALS['link'],$result)){
		if($show==1000){
			$x=$row['show_msg'];
			}else if($show==2000){
			$x=$row['show_eve'];
			}
		
		return $x;
		}
	}

function countPlus($id,$show){ //新增筆數時加1
	$x=countSelect($id,$show);
	$y=$x+1;
	if($show==1000){
		  $sql="update mis_user_info set show_msg='$y' where id='$id' ";
	  }else if($show==2000){
		  $sql="update mis_user_info set show_eve='$y' where id='$id' ";
	  }
	mysqli_query($GLOBALS['link'],$sql)or die($sql);
	if (mysqli_affected_rows()>0){
		
		}
	
	}
	
function countZero($id,$show){ //歸零筆數
	//$x=countSelect($id,$show);
	$x=0;
	if($show==1000){
		  $sql="update mis_user_info set show_msg='$x' where id='$id' ";
	  }else if($show==2000){
		  $sql="update mis_user_info set show_eve='$x' where id='$id' ";
	  }
	mysqli_query($GLOBALS['link'],$sql)or die($sql);
	if (mysqli_affected_rows()>0){
		
		}
	
	}
	
function chk_sessid($members_session_id,$account){ //判斷SESSION 有沒有ID值

	if ($_SESSION['sessions_id'] == $members_session_id){
			$account=$account;
			return $account;
		}else{
			$account="999";
			return $account;
			}	
	}

?>
