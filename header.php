    <!--Démarrage de la session-->
<?php
   session_start();
   if(@$_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
?>
    <header>
                <meta charset="utf-8" />
                <link rel="stylesheet" type="text/css" href="css/index.css" />
                <link rel="stylesheet" media="(max-width: 575.98px)" href="css/media.css" />
                <link rel="stylesheet" media="smartphones(max-width: 767.98px)" href="css/media.css" />
                <link rel="stylesheet" media="tablets(max-width: 991.98px)" href="css/media.css" />
                <link rel="stylesheet" media="desktops(max-width: 1199.98px)" href="css/media.css" />
                    
                    <span class="head2"><a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="100px" height="100px"></a></span>
                    <span><a class="bonjour" href="update.php"><img alt="profil" src="images/profil.png" width="30px" height="30px"></a><?=$_SESSION["nomPrenom"]?></span>

    </header>