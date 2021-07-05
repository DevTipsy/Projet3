<?php
	include("connexion.php");

	try{
		$pdoConnect=new PDO("mysql:host=localhost;dbname=projet3","root","root");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

	$username=$_POST["username"];
	$reponse=$_POST["reponse"];

	try {
            $sql = "SELECT id_user, username, reponse FROM account WHERE username = :username AND reponse = :reponse";
            $stmt = $pdoConnect->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':reponse', $reponse, PDO::PARAM_STR);
            $execute = $stmt->execute();
            $count = $stmt->rowCount();
if($count == 1) {
                $query = "UPDATE account SET password = :password WHERE username = :username";
                $stmt = $pdoConnect->prepare($query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $execute = $stmt->execute();
                session_destroy();
                session_start();
                $_SESSION["success"] = "Mot de passe mis à jour avec succès";

  		header("location: login.php");
                exit();
            } else {
                $login_err = "Nom d'utilisateur ou réponse à la question secrète invalide";
            }
        } catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
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
		<form class="formu" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="label">Username (email)</div>
			<input  class="forml" type="text" name="username" value="" />
			<div class="label">Réponse secrète</div>
			<input  class="forml" type="text" name="reponse" />
			<div class="label"> Mot de passe</div>
			<input  class="forml" type="text" name="motdepasse" value="" />

			<input class="formn" type="submit" name="valider" value="Envoyer le nouveau mot de passe" /><br>
		</form>
			<?php if(!empty($message)){ ?>
				<div class="message"><?php echo $message ?></div>
			<?php } ?>
	</body>
</html>