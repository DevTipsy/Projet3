<?php


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

                            <a class="logoh" href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="100px" height="100px"></a><span style="font-weight: bold ; font-size: 26px;">  Réinitialisation du mot de passe</span>

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