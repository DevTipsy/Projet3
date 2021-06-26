<?php
	session_start();
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
?>
<!DOCYTPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<header>
			<img src="logo_gbaf.jpeg" alt=Logo width="4%" height="6%">
			Espace personnel 
			<a href="monprofil.php">Mon compte</a>
			<a href="deconnexion.php">Me déconnecter</a>

		</header>
		<h1>
		<?php 
			echo ("Bonjour");
		?>
		<span>
		<?=$_SESSION["nomPrenom"]?>
		</span>
		</h1>
	</body>
</html>