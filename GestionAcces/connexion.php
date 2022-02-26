<?php
 session_start();

 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Connexion</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/connexion.css">
 </head>
 <body>
  <header>

   <ul class="menu">
    <li class="items1">
     <ul class="interieur">
      <li class="one">
        <a href="../index.php?<?php echo session_id();?> ">Acceuil</a>
        <hr width="50%" size="1" color="black" >
      </li>
      <li>
        <a href="../GestionProduit/Recherche.php?<?php echo session_id();?>">Recherche Avancée</a>
        <hr width="50%" size="1" color="black" >
      </li>
      <li>
        <a href="">Atelier de réparation</a>
        <hr width="50%" size="1" color="black" >
      </li>
      <li>
        <a href="">Commandes spéciales</a>
        <hr width="50%" size="1" color="black" >
      </li>
      <li>
        <?php
          if(isset(  $_SESSION['poste']) and   $_SESSION['poste']!='client'){
        ?>
            <a href="../Menu/Menu.php">Menu</a>
        <?php
          }elseif(isset(  $_SESSION['poste']) and   $_SESSION['poste']=='client'){
         ?>
              <a href="../Histroique/HistoriqueCl.php">Mon historique</a>
        <?php
          }
        ?>
       </li>
      </ul>
     </li>
    </ul>

    <div class="titre_page">
     <font size="6" color="white">Connexion</font>
    </div>
   </header>

   <div class="main">
    <?php
     //connexion au serveur
     include 'DatabaseConnect.php';
     if(!isset($_POST['erreurCon']) ||  $_POST['erreurCon']=="none"){
    ?>
      <div class="connexion">
       <form action="connexion.php?<?php echo session_id();?>" method="post">
         <input  type="hidden" name="erreurCon" value="done"/>
         <input class="mail" type="text" name="email" placeholder="Votre email"/>
         <input class="mdp" type="password" name="mdp" placeholder="Mot de passe"/>
         <input class="btn" type="submit" value="Envoyer" />
      </form>
      <a href="../GestionClient/InscriptionClient.php?<?php echo session_id();?>">Vous n'avez pas de compte,inscrivez-vous.</a>
     </div>

   <?php
     $_POST['erreurCon']="done";
    }else{
   ?>
      <div class="ConnCheck">
   <?php
      if(isset($_POST['email']) and isset($_POST['mdp'])){
        $mail=$_POST['email'];
        $mdp=$_POST['mdp'];


        //verification des données
        $requete="select nom,prenom,IdentifiantCl from client where Email='".$mail."' and MotDePasse='".$mdp."'";
        $resultat=$connexion->query($requete);
        $ligne=$resultat->fetch_row();

        $requete="select nom,prenom,IdentifiantEmp,poste from employe where Email='".$mail."' and MotDePasse='".$mdp."'";
        $resultat=$connexion->query($requete);
        $ligne1=$resultat->fetch_row();
        if($ligne==null and $ligne1==null){
            $_POST['erreurCon']="none";
            echo "Aucun resultat n'a été trouvé veuillez Vous inscrire. ";
            echo "<br/>";

      ?>
            <br/>
            <img src="../pics/error.png" alt="photo introuvable"/>
            <br/>

            <a href="connexion.php?<?php echo session_id();?>">Réessayer</a>

      <?php
        }else{

            echo"Connexion établie avec succés";
            if($ligne==null){
              $_SESSION['etat']='connecte';
              $_SESSION['nom']=$ligne1[0];
              $_SESSION['prenom']=$ligne1[1];
              $_SESSION['id']=$ligne1[2];
              $_SESSION['table']="employe";
              $_SESSION['mail']=$mail;
              if(isset($ligne1[2])){
                $_SESSION['poste']=$ligne1[3];
              }
            }else{
              $_SESSION['etat']='connecte';
              $_SESSION['nom']=$ligne[0];
              $_SESSION['prenom']=$ligne[1];
              $_SESSION['poste']='client';
              $_SESSION['id']=$ligne[2];
              $_SESSION['table']="client";
            }
      ?>
          <br/>
          <img src="../pics/done.png" alt="photo introuvable"/>
          <br/>

          <a href="../index.php?<?php echo session_id();?>">Revenir à l'acceuil</a>
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
        <div class="txt"><a href='Info.php'>Plus...</a></div>
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
