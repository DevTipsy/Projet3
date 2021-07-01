<?php
	session_start();
	@$username=$_POST["username"];
	@$question=$_POST["question"];
	@$reponse=$_POST["reponse"];
	@$valider=$_POST["valider"];
	$message="";

	if(isset($valider)){
		if(empty($username)) $message.="<li>Username invalide!</li>";
		if(empty($question)) $message.="<li>Question secrète invalide!</li>";
		if(empty($reponse)) $message.="<li>Réponse secrète invalide!</li>";
		if(empty($message)){
			
	if(isset($valider)){
		include("connexion.php");
		$res=$pdo->prepare("select * from account where username=? question=? and reponse=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($username,$question,$reponse));
		$tab=$res->fetchAll();
		if(count($tab)==0)
			$message="<li>Mauvais username, question ou réponse secrète!</li>";
		else{
			$_SESSION["autoriser"]="oui";
			$_SESSION["nomPrenom"]=strtoupper($tab[0]["prenom"]." ".$tab[0]["nom"]);
			$_SESSION["id"] = $tab[0]["id_user"];
			header("location:login.php");
		}
	}
}
}
?>
<!DOCYTPE html>
<html>
	    <header>
            <div id="header">
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="css/index.css" />
                <link rel="stylesheet" media="(max-width: 575.98px)" href="css/media.css" />
                <link rel="stylesheet" media="smartphones(max-width: 767.98px)" href="css/media.css" />
                <link rel="stylesheet" media="tablets(max-width: 991.98px)" href="css/media.css" />
                <link rel="stylesheet" media="desktops(max-width: 1199.98px)" href="css/media.css" />

                            <a class="logoh" href="page_daccueil.php"><img alt="logo" src="images/logo_gbaf.png" width="100px" height="100px"></a><span style="font-weight: bold ; font-size: 26px;">  Réinitialisation du mot de passe</span>

    </header>

	<body onLoad="document.fo.username.focus()">
		<form class="formu" name="fo" method="post" action="">
			<div class="label">Username (email)</div>
			<input  class="forml" type="text" name="username" value="" />
			<div class="label">Question secrète</div>
			<input  class="forml" type="text" name="text" />
			<div class="label">Réponse secrète</div>
			<input  class="forml" type="text" name="text" />
			<input class="formn" type="submit" name="valider" value="Envoyer le nouveau mot de passe" /><br>
		</form>
			<?php if(!empty($message)){ ?>
				<div class="message"><?php echo $message ?></div>
			<?php } ?>
	</body>
</html>