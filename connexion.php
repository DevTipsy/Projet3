<?php
	try{
		$pdo=new PDO("mysql:host=localhost;dbname=projet3","root","root");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>