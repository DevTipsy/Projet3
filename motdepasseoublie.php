<?php


?>
<!DOCYTPE html>
<html>
	<header>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/index.css" />
        <a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
			Réinitialisation du mot de passe
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
		<div id="message"><?php echo $message ?></div>
		<?php } ?>
	</body>
</html>