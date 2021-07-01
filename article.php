      <!--Connexion à la BDD-->
      <?php
          session_start();
    if(@$_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
      try
      {
      $bdd = new PDO('mysql:host=localhost;dbname=projet3','root','root');
      }
      catch (Exception $e)
      {
             die('Erreur : ' . $e->getMessage());
      }
      ?>
            <!--Paramètres des fonctionnalités-->
            <?php
                  $now = date("Y-m-d H:i:s");
                  $currenturl = strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

                  if(isset($_POST['action']) && $_POST['action']=='avis-like'){
                     $query = "INSERT INTO vote (id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, 1)";
                     $stmt = $bdd->prepare($query);
                     $stmt->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
                     $stmt->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                     $execute = $stmt->execute();
                     unset($_POST);  
                     $avis_ok = "Votre avis a été ajouté avec succès"; 
                  }

                  if(isset($_POST['action']) && $_POST['action']=='avis-dislike'){
                     $query = "INSERT INTO vote (id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, -1)";
                     $stmt = $bdd->prepare($query);
                     $stmt->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
                     $stmt->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                     $execute = $stmt->execute();
                     unset($_POST);  
                     $avis_ok = "<span class='msgconfirm' style='color:greeen'>Votre avis a été ajouté avec succès</span>"; 
                  }

                     if(isset($_GET['id_acteur']) AND !empty($_GET['id_acteur'])) {
                        $getid = htmlspecialchars($_GET['id_acteur']);
                        $description = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur = ?');
                        $description->execute(array($getid));
                        $description = $description->fetch();
                  }

                     if(isset($_GET['id_acteur']) AND !empty($_GET['id_acteur'])) {
                        $getid = htmlspecialchars($_GET['id_acteur']);
                        $acteur = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur = ?');
                        $acteur->execute(array($getid));
                        $acteur = $acteur->fetch();
                  }

                     if(isset($_GET['id_acteur']) AND !empty($_GET['id_acteur'])) {
                        $getid = htmlspecialchars($_GET['id_acteur']);
                        $logo = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur = ?');
                        $logo->execute(array($getid));
                        $logo = $logo->fetch();
                  }
                       
                        if(isset($_POST['submit_commentaire'])) {
                        if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
                                  $post = htmlspecialchars($_POST['commentaire']);
                        if(strlen($id_user) < 25) {
                                  $ins = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES (?,?,?,?)');
                                  $ins->execute(array($_SESSION["id"],$getid,$now,$post));
                                  $c_msg = "<span class='msgconfirm' style='color:green'>Votre commentaire a bien été publié</span>";
                                       }
                                       else {
                                             $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
                                    }
                                       }
                                          else {
                                                $c_msg = "Erreur: Tous les champs doivent être complétés";
                                       }
                                          }
                                             $post = $bdd->prepare('SELECT * FROM post WHERE id_acteur = ? ORDER BY id_post DESC');
                                             $post->execute(array($getid));
            ?>


<!DOCTYPE html>
<html>

   <?php include("header1.php"); ?>              

<body>
   <div class="allbody">
   

               <!--Présentation du partenaire-->
               <div class="img_acteur">
                   <?php echo ('<img height="130" width="100%" " src ="' .$logo['logo'] .'"/><br>'); ?>
               </div>
               <h2><?= $acteur['acteur'] ?></h2>
               <p><?= $description['description'] ?></p><br>



               <div class="containerlikecom">
                                             <!--Nombre de commentaires-->
                                             <div class="comptecom" style="font-weight: bold";><?php $query = "SELECT * FROM post WHERE id_acteur = :id_acteur";
                                                                                                     $stmt = $bdd->prepare($query);
                                                                                                     $stmt->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                                                                                                     $execute = $stmt->execute();
                                                                                                     $count = $stmt->rowCount();
                                                                                                 if ($count <= 1) {
                                                                                                         echo "$count commentaire";
                                                                                                     } else {
                                                                                                         echo "$count commentaires";
                                                                                                       }
                                                                                                ?>
                                             </div>
                        <div class="react">
                                             <!--Mettre un commentaire (zone de texte+message statut du commentaire-->
                                             <?php $query = "SELECT * FROM post WHERE id_acteur = :id_acteur AND id_user = :id_user";
                                                   $stmt = $bdd->prepare($query);
                                                   $stmt->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
                                                   $stmt->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                                                   $execute = $stmt->execute();
                                                   $count = $stmt->rowCount();
                                                   if($count != 1)
                                             { ?>


                                                      <form method="POST">
                                                         <textarea type="submit" id="text" name="commentaire" placeholder="Votre commentaire ici" rows="2" cols="15"></textarea><br>
                                                         <input type="submit" value="Publier le commentaire" name="submit_commentaire" />
                                                      </form>
                                             
                                           <?php } else { ?>
                                                               <div class='msgconfirm' style="font-weight: bold;">Oups, vous avez déjà publié un commentaire!</div>
                                          <?php } ?>

                                                      <!--Like/dislike-->
                                                      <?php
                                                            if(!empty($comment_ok)){
                                                                            echo '<article><blockquote style="color:green;font-weight: bold">' . $comment_ok . '</blockquote></article>';
                                                         }
                                                            if(!empty($avis_ok)){
                                                                            echo '<article><blockquote style="color:green;font-weight: bold">' . $avis_ok . '</blockquote></article>';
                                                         }
                                                      ?>
                        
                                                            <?php $query = "SELECT * FROM vote WHERE id_acteur = :id_acteur AND id_user = :id_user";
                                                                     $stmt = $bdd->prepare($query);
                                                                     $stmt->bindParam(':id_user', $_SESSION["id"], PDO::PARAM_INT);
                                                                     $stmt->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                                                                     $execute = $stmt->execute();
                                                                     $count = $stmt->rowCount(); 
                                                            ?>
                                                                  
                                                                     <?php if($count != 1) { 
                                                                              $query_vote = "SELECT sum(vote) as point_vote FROM vote WHERE id_acteur = :id_acteur";
                                                                              $stmt_vote = $bdd->prepare($query_vote);
                                                                              $stmt_vote->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                                                                              $execute = $stmt_vote->execute();
                                                                              $data_vote = $stmt_vote->fetch();
                                                                     ?>
                                                                        <div class="likedislike">
                                                                                    <form action="<?php echo $currenturl; ?>" method="POST">
                                                                                       <input type="hidden" name="action" value="avis-like" />
                                                                                       <button name="like" type="submit"><img src="like.png" width="20px" height="20px"></button>
                                                                                    </form>


                                                                                          <?php echo $nbr = ($data_vote['point_vote'] == 0) ? 0 : $data_vote['point_vote'] ?>

                                                                                    <form action="<?php echo $currenturl; ?>" method="POST">
                                                                                          <input type="hidden" name="action" value="avis-dislike" />
                                                                                          <button name="dislike" type="submit"><img src="dislike.png" width="20px" height="20px"></button>
                                                                                    </form>
                                                                        </div>
                                     

                                                                     <?php } else {
                                                                                    $query_vote = "SELECT sum(vote) as point_vote FROM vote WHERE id_acteur = :id_acteur";
                                                                                    $stmt_vote = $bdd->prepare($query_vote);
                                                                                    $stmt_vote->bindParam(':id_acteur', $_GET['id_acteur'], PDO::PARAM_INT);
                                                                                    $execute = $stmt_vote->execute();
                                                                                    $data_vote = $stmt_vote->fetch();
                                                                     ?>
                                                                                    <div class='msgconfirm' style="font-weight: bold;">Oups, vous avez déjà voté!</div>
                                                                                    <?php echo $nbr = ($data_vote['point_vote'] == 0) ? 0 : $data_vote['point_vote'] ?>
                                                                     <?php } ?>
                        </div>


                                          <!--Commentaires+ID+date-->
                                                <?php if(isset($c_msg)) { echo $c_msg; } ?><br>
                                                <?php while($c = $post->fetch()) { ?>

                                                <?php
                                                            $infouser = $bdd->prepare('SELECT nom, prenom FROM account WHERE id_user = ?');
                                                            $infouser->execute(array($c['id_user']));
                                                            $infos = $infouser->fetch();
                                                ?>
                                          <div class="enfantn">
                                                      <div class="flux"><div style="font-weight: bold"><?php echo $infos['prenom'] .' '.$infos['nom'] ?></div>
                                                      <?= $c['date_add'] ?>:<br>
                                                      <?= $c['post'] ?><br>
                                                      </div><br>
                                                <?php } ?>
                                                <?php ?>
                                          </div>
               </div>


   </div>
</body><br><br>

                <?php include("footer.php"); ?>

</html>


