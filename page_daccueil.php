<?php
            $servername = 'localhost';
            $username = 'root';
            $password = 'root';
            
            try{
                $pdo = new PDO("mysql:host=localhost;dbname=projet3", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = 'SELECT  * FROM acteurs ORDER BY id_acteur';
                $q = $pdo->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo "Erreur : " . $e->getMessage();
            }
?>

<!DOCTYPE html>
<html>
            
<?php include("header.php"); ?>              


    <body>
        <div class="allbody">
                <div class="contenunobox">
                    <h1>Intranet GBAF</h1>
                        <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français : BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel-CIC, Société Générale et La Banque Postale.</p>
                            <img src="images/illustration.jpg" alt="Banque" height="300" width="100%"><br><br>
                                <section class="ligne"></section>
                                    <h2>Acteurs et partenaires historiques</h2>
                                        <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics. Le GBAF travaille avec 4 acteurs principaux dont vous pouvez voir la fiche ci-dessous.</p><br>  
                </div>
  
                <div class="container">
                    <?php while ($row = $q->fetch()): ?>
                        <tr><div class="enfant">
                            
                            <div class="minia">
                                <?php echo ('<img style="width:80px;height:40px;" src ="' .$row['logo'] .'"/><br/>'); ?>  
                            </div>
                                    <div class="ellipsis">
                                        <td><h3><?php echo htmlspecialchars($row['acteur']) ?></h3></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    </div>
                                        <div class="lirelasuite">
                                            <button onclick="window.location.href = 'article.php?id_acteur=<?= $row['id_acteur'] ?>';">lire la suite</button>
                                        </div>
                        </tr></div>
                    <?php endwhile; ?>
                </div>
        </div><br><br>            
    </body>
                <?php include("footer.php"); ?>
</html>
