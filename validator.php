<?php 
	require "init.php";
	if (empty($_SESSION['login'])) {
		header('Location:index.php');
	}
?>