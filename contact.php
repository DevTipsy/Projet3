<!DOCTYPE html>
<html>
        <?php include("header.php"); ?> 

    <body>
        	<h1>Formulaire de contact</h1><br/>Veuillez taper votre Pseudo :</p>
            <form action="cible.php" method="post">
            			<p>
            			<input type="text" name="username" placeholder="Votre pseudo" />
            			</p>
            </form>

            <!--Grande zone de texte-->
            <textarea name="message" rows="8" cols="35" placeholder="Votre message ici">
            </textarea><br/>

    </body>
</html>
