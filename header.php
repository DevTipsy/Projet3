    <!--Démarrage de la session-->
<?php
   session_start();
   if(@$_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
?>
    <header>
            <div id="header">
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="css/index.css" />
                <link rel="stylesheet" media="screen and (max-width: 1280px)" href="petite_resolution.css" />
                <a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
                            <div class="bonjour">
                            	<a href="update.php"><img alt="profil" src="images/profil.png" width="2%" height="2%"></a> <?=$_SESSION["nomPrenom"]?>
                            <div class="boutonheader"><a href="deconnexion.php">Me déconnecter</a></div> 
    </header>