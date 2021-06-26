<?php
	session_start();
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}

$bdd = new PDO('mysql:host=localhost;dbname=projet3','root','root');
 
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM account WHERE id_user = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   }
   if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $user['username']) {
      $newusername = htmlspecialchars($_POST['newusername']);
      $insertmail = $bdd->prepare("UPDATE account SET username = ? WHERE id_user = ?");
      $insertmail->execute(array($newusername, $_SESSION['id']));
      header('Location: modifpro.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['password1']) AND !empty($_POST['password1']) AND isset($_POST['password2']) AND !empty($_POST['password2'])) {
      $mdp1 = sha1($_POST['password1']);
      $mdp2 = sha1($_POST['password2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE account SET password = ? WHERE id_user = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: modifpro.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<!DOCYTPE html>
<html>
   <header>
      <title></title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/index.css" />
      <a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
      		Mon compte
   </header>

   <body>
      <div align="center">
            <form class="formu" method="POST" action="" enctype="multipart/form-data">
               <label>Username (email):</label>
               <input class="forml" type="text" name="username" value="<?php echo $user['username']; ?>" /><br/>
               <label>Mot de passe :</label>
               <input class="forml" type="password" name="password"/><br/>
               <label>Confirmation du mot de passe :</label>
               <input class="forml" type="password" name="password"/><br/>
               <input class="formn" type="submit" value="Mettre à jour mon profil" />
            </form>
      </div>
   </body>
</html>

