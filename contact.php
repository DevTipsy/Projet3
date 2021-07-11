<?php
session_start();
   if(@$_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
?>
<!DOCTYPE html>
<html lang="fr">
    <title>Page contact</title>
         <div id="header">
            <meta charset="utf-8"> 
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="css/index.css" />
            <link rel="stylesheet" media="(max-width: 767px)" href="css/media.css" />
        </div>
<header>
                        <a class="logoh" href="page_daccueil.php"><img alt="logo" src="images/logo_gbaf.png" width="100" height="100"></a>
                        <a class="bonjour" href="update.php"><img alt="profil" src="images/profil.png" width="30" height="30"></a> <?=$_SESSION["nomPrenom"]?>
</header>


        	<h1>Formulaire de contact</h1><br/>Veuillez taper votre Pseudo :
            <form action="cible.php" method="post">
            			<p>
            			<input type="text" name="username" placeholder="Votre pseudo" />
            			</p>
            </form>
            <textarea name="message" rows="8" cols="35" placeholder="Votre message ici">
            </textarea><br/>
    </body>
</html>
