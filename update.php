<?php
include("connexion.php");
session_start();
 
if(isset($_POST['update']))
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];

    $query = "UPDATE account SET nom=:nom, prenom=:prenom, username=:username, password=:password, question=:question, reponse=:reponse WHERE id_user=:id_user";    
    $pdoResult = $pdo->prepare($query);
    $pdoResult->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
    $pdoResult->bindParam(':nom', $nom, PDO::PARAM_STR);
    $pdoResult->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $pdoResult->bindParam(':username', $username, PDO::PARAM_STR);
    $pdoResult->bindParam(':password', md5($password), PDO::PARAM_STR);
    $pdoResult->bindParam(':question', $question, PDO::PARAM_STR);
    $pdoResult->bindParam(':reponse', $reponse, PDO::PARAM_STR);
    $pdoExec = $pdoResult->execute();

    if($pdoExec)
    {
        $message = "Mise à jour effectuée";
    } else {
        $message = "Echec de la mise à jour";
    }
}
    $query = "SELECT * FROM account WHERE id_user = :id_user";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
    $execute = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <header>
        <div id="header">
            <meta charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="css/index.css" />
            <link rel="stylesheet" media="(max-width: 575.98px)" href="css/media.css" />
            <link rel="stylesheet" media="smartphones(max-width: 767.98px)" href="css/media.css" />
            <link rel="stylesheet" media="tablets(max-width: 991.98px)" href="css/media.css" />
            <link rel="stylesheet" media="desktops(max-width: 1199.98px)" href="css/media.css" />
            <a class="logoh" href="page_daccueil.php"><img alt="logo" src="images/logo_gbaf.png" width="100px" height="100px"></a>
            <a class="bonjour" href="update.php"><img alt="profil" src="images/profil.png" width="30px" height="30px"></a> <?=$_SESSION["nomPrenom"]?><br>
            <a style="color: black;" href="deconnexion.php">Me déconnecter</a>
        </div>
    </header>

    <body>
        <div align="center">
            <form class="formu" action="" method="post">
                <label>Nom</label>
                <input class="forml" type="text" value="<?php echo $row['nom']; ?>" name="nom">
                <label>Prénom</label>
                <input class="forml" type="text" value="<?php echo $row['prenom']; ?>" name="prenom">
                <label>Username (email)</label>
                <input class="forml" type="text" value="<?php echo $row['username']; ?>" name="username">
                <label>Nouveau mot de passe</label>
                <input class="forml" type="password" value="" name="password">
                <label>Question secrète</label>
                <input class="forml" type="text" value="<?php echo $row['question']; ?>" name="question">
                <label>Réponse secrète</label>
                <input class="forml" type="text" value="<?php echo $row['reponse']; ?>" name="reponse"><br>                
                <input class="formn" type="submit" name="update" value="Mettre à jour mon profil" />
            </form>
            <?php if(!empty($message)){ ?>
			    <div class="message"><?php echo $message ?></div>
		    <?php } ?>
        </div>
    </body>
</html>