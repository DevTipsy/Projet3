<?php
    session_start();
    if(@$_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }

if(isset($_POST['update']))
{
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=projet3","root","root");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    

    $username = $_POST['username'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
        
    $query = "UPDATE `account` SET `prenom`=:prenom,`nom`=:nom,`password`=:password WHERE `username` = :username";    
    $pdoResult = $pdoConnect->prepare($query);    
    $pdoExec = $pdoResult->execute(array(":prenom"=>$prenom,":nom"=>$nom,":password"=>$password,":username"=>$username));

    if($pdoExec)
    {
        echo 'Mise à jour effectuée';
    }else{
        echo 'Echec de la mise à jour';
    }
}
?>

<!DOCTYPE html>
<html>
   <header>
      <title></title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/index.css" />
      <a href="page_daccueil.php"><img alt="logo" src="logo_gbaf.png" width="4%" height="7%"></a>
            Modification du profil
            <span class="boutonheader">
                Profil de <?=$_SESSION["nomPrenom"]?><br>
                <span class="boutonheader"><a href="deconnexion.php">Me déconnecter</a></span>
            </span>
   </header>
    <body>

        <div align="center">
            <form class="formu" action="update.php" method="post">
                <label>Email actuel :</label>
                <input class="forml" type="text" name="username" value="">
                <label>Prénom</label>
                <input class="forml" type="text" name="prenom">
                <label>Nom</label>
                <input class="forml" type="text" name="nom">
                <label>Nouveau mot de passe</label>
                <input class="forml" type="text" name="password"><br>
                <input class="formn" type="submit" value="Mettre à jour mon profil" />
            </form>
        </div>
    </body>
</html>