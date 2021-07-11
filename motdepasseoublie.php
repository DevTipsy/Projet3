<?php
include("connexion.php");
session_start();
@$username=$_POST["username"];
@$reponse=$_POST["reponse"];
@$password=$_POST["password"];
@$valider=$_POST["valider"];
$message="";

if(isset($valider)){
	if(empty($username)) $message.="<li>Username invalide!</li>";
	if(empty($reponse)) $message.="<li>Réponse secrète invalide!</li>";
	if(empty($password)) $message.="<li>Mot de passe invalide!</li>";
	if(empty($message)){
			
		$sql = "SELECT id_user, username, reponse FROM account WHERE username = :username AND reponse = :reponse";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':reponse', $reponse, PDO::PARAM_STR);
		$execute = $stmt->execute();
        $count = $stmt->rowCount();

		if($count == 1) {
			$query = "UPDATE account SET password = :password WHERE username = :username";
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', md5($password), PDO::PARAM_STR);
			$execute = $stmt->execute();
			session_destroy();
			session_start();
			$_SESSION["success"] = "Mot de passe mis à jour avec succès";
			header("location:login.php");
			exit();
		} else {
			$message = "Nom d'utilisateur ou réponse à la question secrète invalide";
		}	
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
	         <title>Header</title>
	         <div id="header">
	         	<meta charset="utf-8"> 
            	<meta name="viewport" content="width=device-width, initial-scale=1">
	            <link rel="stylesheet" type="text/css" href="css/index.css" />
	            <link rel="stylesheet" media="(max-width: 767px)" href="css/media.css" />
	        </div>
	<header>
				<a class="logoh" href="page_daccueil.php"><img alt="logo" src="images/logo_gbaf.png" width="100" height="100"></a><span style="font-weight: bold ; font-size: 26px;">  Réinitialisation du mot de passe</span>
	</header>
		<form class="formu" method="post">
			<div class="label">Nom d'utilisateur</div>
			<input  class="forml" type="text" name="username" value="" />
			<div class="label">Réponse à la question secrète</div>
			<input  class="forml" type="text" name="reponse" />
			<div class="label">Nouveau mot de passe</div>
			<input  class="forml" type="password" name="password" />
			<input class="formn" type="submit" name="valider" value="Envoyer le nouveau mot de passe" /><br>
		</form>
		<?php if(!empty($message)){ ?>
			<div class="message"><?php echo $message ?></div>
		<?php } ?>
	</body>
</html>