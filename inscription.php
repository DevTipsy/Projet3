<?php
	@$nom=$_POST["nom"];
	@$prenom=$_POST["prenom"];
	@$username=$_POST["username"];
	@$password=$_POST["password"];
	@$question=$_POST["question"];
	@$reponse=$_POST["reponse"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		if(empty($nom)) $message="<li>Nom invalide!</li>";
		if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
		if(empty($username)) $message.="<li>Login invalide!</li>";
		if(empty($password)) $message.="<li>Mot de passe invalide!</li>";
		if(empty($message)){
			include("connexion.php");
			$req=$pdo->prepare("select id_user from account where username=? limit 1");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($username));
			$tab=$req->fetchAll();
			if(count($tab)>0)
				$message="<li>Login existe déjà!</li>";
			else{
				$ins=$pdo->prepare("insert into account(nom,prenom,username,password,question,reponse) values(?,?,?,?,?,?)");
				$ins->execute(array($nom,$prenom,$username,md5($password),$question,$reponse));
				header("location:login.php");
			}
		}
	}
?>
<!DOCYTPE html>
<html>
	<header>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
        	<a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
			Inscription
			<a class="red" href="login.php">Déja inscrit</a>
	</header>

	<body>
		<form class="formu" name="fo" method="post" action="" enctype="multipart/form-data">
			<div class="label">Nom</div>
			<input class="forml" type="text" name="nom" autofocus value="<?php echo $nom?>" />
			<div class="label">Prénom</div>
			<input class="forml" type="text" name="prenom" value="<?php echo $prenom?>" />
			<div class="label">Username</div>
			<input class="forml" type="text" name="username" value="<?php echo $username?>" />
			<div class="label">Mot de passe</div>
			<input class="forml" type="password" name="password" />
			<div class="label">Question</div>
			<input class="forml" type="text" name="question" value="" />
			<div class="label">Réponse</div>
			<input class="forml" type="text" name="reponse" value="" />
			<div class="label"></div>
			<input class="formn" type="submit" name="valider" value="Je m'inscris" /><br>
		</form>
			<?php if(!empty($message)){ ?>
				<div class="message"><?php echo $message ?></div>
			<?php } ?>
	</body>
</html>