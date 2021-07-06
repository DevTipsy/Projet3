<?php
session_start();
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
?>