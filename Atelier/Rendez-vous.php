<?php
 session_start();
 include '../GestionAcces/DatabaseConnect.php';
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Prendre un rendez-vous</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/CommandeSpecial.css">
 </head>

 <body>
   <header>
    <ul class="menu">
      <li class="items1">
       <ul class="interieur">
        <li class="one">
          <a href="../index.php?<?php echo session_id();?>">Acceuil</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="../GestionProduit/Recherche.php?<?php echo session_id();?>">Recherche Avancée</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="Rendez-vous.php<?php echo session_id();?>">Réparation</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="CommandeSpecial.php?<?php echo session_id();?>">Commandes spéciales</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <?php
            if(isset($_SESSION['poste']) and   $_SESSION['poste']!='client'){
          ?>
              <a href="../Menu/Menu.php?<?php echo session_id();?>">Menu</a>
          <?php
           }
          ?>
        </li>
       </ul>
      </li>
     </ul>

    <div class="titre_page">
     <font size="6" color="white">Prendre un rendez-vous</font>
    </div>

    <ul class="compte">
     <li class="items2">
      <ul class="interieur">
      <?php
        if(!isset($_SESSION['etat'])){
          echo"<br/><br/><br/><br/>";
          echo"Vous n'étes pas connecté";
          echo"<br/>";
          echo"<br/>";

       ?>
          <a href="../GestionAcces/connexion.php?<?php echo session_id();?>" >Se connecter?</a>

      <?php

       }else{
      ?>
      <li>
       <div class="image1"><img src="../pics/compte1.png" alt="No pic found"/></div>
      </li>
      <li class="nompr">
       <?php
        echo $_SESSION['nom']."  ".$_SESSION['prenom'];
       ?>
       <hr width="50%" size="1" color="black" >
      </li>
      <li class="params">
        <a href="../GestionCompte/ParametreCompte.php?<?php echo session_id();?>">Paramétres du compte</a>
        <hr width="50%" size="1" color="black" >
      </li>
      <li class="dec">
       <a href="../GestionAcces/deconnexion.php?<?php echo session_id();?>">Déconnexion</a>
      </li>
      <?php
       }
      ?>
      </ul>
     </li>
    </ul>
   </header>
   <div class="main">
    <div class="pagep">
    <?php
      if(!isset($_SESSION['etat'])){

    ?>
          <div class="reponse">
            <br/>
            <br/>
            <br/>
            Vous n'étes pas connecté!
            <br/><br/><br/>
            <a href="../GestionAcces/connexion.php?<?php echo session_id();?>" >Se connecter?</a>
          </div>
    <?php
      }else{
       if(!isset($_POST['Sauvegarde'])){
    ?>
        <div class="formulaire">
          <form method="post" action="Rendez-vous.php?<?php echo session_id();?>">
            <input type="hidden" name="Sauvegarde" value="oui" />
            <input type="text" class="type" name="type" placeholder="Type de l'objet" required />
            <input type="text" class="marque" name="marque" placeholder="Marque" required />
            <input type="text" class="modele" name="modele" placeholder="Modéle" required />
            <input type="text" class="mail" name="mail" placeholder="Votre e-mail" required />
            <input type="text" class="num" name="num" placeholder="Votre numéro de téléphone" required />
            <textArea class="desc" name="description" >Description de la panne</textArea>
            <input type="submit" class="btn" value="Envoyer" />
          </form>
        </div>
    <?php
      }else{
        $type=$_POST['type'];
        $marque=$_POST['marque'];
        $modele=$_POST['modele'];
        $mail=$_POST['mail'];
        $tel=$_POST['num'];
        $desc=$_POST['description'];

        $requete="insert into rendezvousreparation (Email,identifiantCl,typeObj,marque,modele,descriptionpanne,daterendezvous,etat,numero) values
                  ('".$mail."','".$_SESSION['id']."','".$type."','".$marque."','".$modele."','".$desc."',NULL,'Envoye','".$tel."')";
        $resultat=$connexion->query($requete);
        if(!$resultat){
      ?>
          <div class="reponse">
            <br/><br/>
            Erreur!!
            <br/>
            <img src="../pics/error.png" alt="photo introuvable"/>
            <br/>
            <a href="../index.php">Revenir à l'acceuil</a>
          </div>
      <?php
      }else{
      ?>
         <div class="reponse">
          <br/>
          Un email vous sera envoyé pour avoir votre rendez-vous.
          <br/>  <br/>
          <img src="../pics/done.png" alt="photo introuvable"/>
          <br/>
          <a href="../index.php">Revenir à l'acceuil</a>
        </div>
      <?php
      }
      }
    }
      ?>
     </div>
     <footer>
       <div class="part1">
        <?php
           include "../HeaderFooter/footerInfo.php ";
        ?>
        <p class="titre">Nos addresses</p>
        <div class="info">

         <div class="element1">
          <div class="mini_icon"><img src="../pics/pointer.png"/></div>
          <div class="txt"><?php echo $adresses[1];?></div>
         </div>
      <?php
        if(count($adresses)>1){
      ?>
         <div class="element2">
          <div class="mini_icon"><img src="../pics/pointer.png"/></div>
          <div class="txt"><a href='../HeaderFooter/Info.php'>Plus...</a></div>
         </div>
        <?php
          }
        ?>
        </div>
       </div>

       <div class="part2">
        <p class="titre">Informations</p>
        <div class="info">
          <div class="element1">
           <div class="mini_icon"><img src="../pics/pointer.png"/></div>
           <div class="txt"><a href="">A propos de nous</a></div>
          </div>
          <div class="element2">
            <div class="mini_icon"><img src="../pics/pointer.png"/></div>
            <div class="txt"> <a href="">Légales</a></div>
          </div>
          <div class="element3">
            <div class="mini_icon"><img src="../pics/pointer.png"/></div>
            <div class="txt"> <a href="">Conditions d'utilisations et confdentialités</a></div>
          </div>
          <div class="element4">
            <div class="mini_icon"><img src="../pics/pointer.png"/></div>
            <div class="txt"><a href="">Attributions </a></div>
          </div>
         </div>
        </div>

        <div class="part3">
          <p class="titre">Nous contacter</p>
           <div class="info">
            <div class="element1">
              <div class="mini_icon"><img src="../pics/pointer.png"/></div>
              <div class="txt"><?php echo $numeros[0]; ?></div>
            </div>
        <?php
         if(count($numeros)>1){
        ?>
           <div class="element2">
              <div class="mini_icon"><img src="../pics/pointer.png"/></div>
              <div class="txt"><a href='../HeaderFooter/Info.php'>Plus...</a></div>
           </div>
       <?php
          }
        ?>
       </div>
      </div>

      <div class="part4">
        <p class="titre">Nos réseaux sociaux</p>
        <div class="info">
          <a href="<?php echo $reseau1;?>">
           <div class="mini_iconRS1"><img src="../pics/facebook.png"/></div>

          </a>
          <a href="<?php echo $reseau2;?>">
           <div class="mini_iconRS2"><img src="../pics/instagram.png"/></div>

          </a>
          <a href="<?php echo $reseau3;?>">
           <div class="mini_iconRS3"><img src="../pics/twitter.png"/></div>
          </a>
        </div>
       </div>
     </footer>
    </div>
  </body>
 </html>
