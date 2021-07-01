<?php
	session_start();
	@$username=$_POST["username"];
	@$password=$_POST["password"];
	@$valider=$_POST["valider"];
	$message="";

	if(isset($valider)){
		if(empty($username)) $message.="<li>Username invalide!</li>";
		if(empty($password)) $message.="<li>Mot de passe invalide!</li>";
		if(empty($message)){

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
}
}
?>
<!DOCYTPE html>
	    <header>
            <div id="header">
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="css/index.css" />
                <link rel="stylesheet" media="(max-width: 575.98px)" href="css/media.css" />
                <link rel="stylesheet" media="smartphones(max-width: 767.98px)" href="css/media.css" />
                <link rel="stylesheet" media="tablets(max-width: 991.98px)" href="css/media.css" />
                <link rel="stylesheet" media="desktops(max-width: 1199.98px)" href="css/media.css" />

                            <a class="logoh" href="page_daccueil.php"><img alt="logo" src="images/logo_gbaf.png" width="100px" height="100px"></a><span style="font-weight: bold ; font-size: 26px;">  Connexion</span>
    </header>

	<body>
				<form class="formu" name="fo" method="post" action="">
		            <label>Username (email)</label>
					<input class="forml" type="text" name="username" autofocus value="<?php echo $username?>" />
					<label>Mot de passe</label>
					<input class="forml" type="password" name="password" />
					<input class="formn" type="submit" name="valider" value="Je me connecte" /><br>
					<a class="red" href="inscription.php">S'inscrire</a>
					<a class="red" href="motdepasseoublie.php">Mot de passe oublié</a>
				</form>
							<?php if(!empty($message)){ ?>
				<div class="message"><?php echo $message ?></div>
			<?php } ?>
	</body>
</html>