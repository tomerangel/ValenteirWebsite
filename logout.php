<?php
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['massage']="אתה כבר מנותק";
	header("location: home.php");
?>