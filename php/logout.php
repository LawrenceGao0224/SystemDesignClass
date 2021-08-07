<?php
    session_start();
	session_unset("is_login");
	header("Location:../login.php");
?>