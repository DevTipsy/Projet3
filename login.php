<?php
	session_start();
	@$username=$_POST["username"];
	@$password=$_POST["password"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		include("connexion.php");
		$res=$pdo->prepare("select * from account where username=? and password=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($username,md5($password)));
		$tab=$res->fetchAll();
		if(count($tab)==0)
			$message="<li>Mauvais username ou mot de passe</li>";
		else{
			$_SESSION["autoriser"]="oui";
			$_SESSION["nomPrenom"]=strtoupper($tab[0]["prenom"]." ".$tab[0]["nom"]);
			$_SESSION["id"] = $tab[0]["id_user"];
			header("location:page_daccueil.php");
		}
	}
?>
<!DOCYTPE html>
<html>
	<header>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
        <a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
			Connexion
			<a class="red" href="inscription.php">S'inscrire</a>
	</header>
		<body>
				<form class="formu" name="fo" method="post" action="">
		            <label>Username (email)</label>
					<input class="forml" type="text" name="username" autofocus value="<?php echo $username?>" />
					<label>Mot de passe</label>
					<input class="forml" type="password" name="password" />
					<input class="formn" type="submit" name="valider" value="Je me connecte" /><br>
					<a class="red" href="motdepasseoublie.php">Mot de passe oublié</a>
				</form>
		</body>
</html>