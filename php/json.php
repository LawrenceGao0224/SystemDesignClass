<?php 
require "db.php";
$i=(int)$_POST["id"];
$newD = date("Y-m-d H:i:s",strtotime("+425 minutes"));
$sql="update card set expire ='$newD' where id=$i";
$res=mysqli_query($db,$sql) or die("db error");
echo $newD; //;
?>
