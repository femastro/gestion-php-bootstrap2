<?php 
	require "init.php";
	require "header.php";
	if (empty($_SESSION['login'])) {
		require "login.php";
	}else{
		require "home.php";
	}
 ?>
