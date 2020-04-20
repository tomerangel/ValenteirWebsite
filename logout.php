<?php
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['massage']="You are logged out";
	header("location: home.php");
?>