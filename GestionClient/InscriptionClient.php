<!DOCTYPE html>
<html>
 <head>
   <title>Inscription</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
    <link rel="stylesheet" href="../css/InscriptionCl.css">
 </head>
 <body>
    <?php session_start();?>
   <header>
     <ul class="menu">
      <li class="items1">
       <ul class="interieur">
        <li class="a1">
          <a href="../index.php?<?php echo session_id()?>">Acceuil</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li class="a2">
          <a href="../GestionProduit/Recherche.php?<?php echo session_id();?>">Recherche Avancée</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li class="a3">
          <a href="">Atelier de réparation</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li class="a4">
          <a href="">Commandes spéciales</a>
          <hr width="50%" size="1" color="black" >
        </li >
        <li class="a5">

          <?php
           if(isset(  $_SESSION['poste']) and   $_SESSION['poste']=='client'){
           ?>
                  <a href="Histroique/HistoriqueCl.php">Mon historique</a>
          <?php
            }
          ?>
        </li>
       </ul>
      </li>
     </ul>

    <div class="titre_page">
     <font size="6" color="white">Inscription</font>
    </div>

   </header>
  <div class="operation">
   <div class="main">
   <?php
    if(!isset($_POST['data'])){
   ?>
     <form name="InsCl"  method="post" action="InscriptionClient.php">
      <input name="data" type="hidden" value="oui"/>
      <input class="nom" name="nom" type="text" placeholder="Nom" required />
      <input class="prenom" name="prenom" type="text" placeholder="Prenom" required />
      <input class="naiss" name="DateNaiss" type="text" placeholder="Date de naissance" required />
      <input class="lnaiss" name="LieuNaiss" type="text" placeholder="Lieu de naissance" required />
      <TextArea class="adr" name="adresse" placeholder="Votre adresse" required ></TextArea>
      <select class="act" name="activite"   >
       <option  disabled >Activité</option>
       <option value="etudiant">Etudiant</option>
       <option value="employe">Employé</option>
      </select>
      <input class="mail" name="Email" type="text" placeholder="Email"  required />
      <input class="mdp" name="mdp" type="password" placeholder="Mot de passe"  required />
      <input class="mdp1" name="mdp1" type="password" placeholder="Confirmer le mot de passe" required />
      <input class="tel" name="tel" type="text" placeholder="Numéro de téléphone" required/>
      <input class="btn" type="submit" value="Confirmer"/>
   </form>
  <?php
   }else{
  ?>
    <div class="remplissage">
  <?php
     $err=false;
     $nom=$_POST['nom'];
     $prenom=$_POST['prenom'];
     $naiss=$_POST['DateNaiss'];
     $lnaiss=$_POST['LieuNaiss'];
     $adr=$_POST['adresse'];
     $act=$_POST['activite'];
     $mail=$_POST['Email'];
     $mdp=$_POST['mdp'];
     $mdp1=$_POST['mdp1'];
     $tel=$_POST['tel'];
     //connexion au serveur
     $connexion=new mysqli("localhost","root","");

     if($connexion){
      $requete="USE TechStore";
      $resultat=$connexion->query($requete);
      if(!$resultat){
        $err=true;
        echo("Erreur lors de l'utilisation de la base de donnée. ");
      }

      //insertion du client
      $requete="insert into client (Email,nom,prenom,DateNaiss,LieuNaiss,Adresse,Activite,MotDePasse,tel)
       values('".$mail."','".$nom."','".$prenom."',".$naiss.",'".$lnaiss."','".$adr."','".$act."','".$mdp."','".$tel."')";
      $resultat=$connexion->query($requete);
      if(!$resultat){
        $err=true;
        echo("Erreur lors de l'enregistrement des données.");
      }

   }else{
     $err=true;
     echo("Erreur lors de la connexion à la base de donnée");
   }

   if(!$err){
     echo"Inscription réalisé avec succés";
  ?>
    <br/>
    <img src="../pics/done.png" alt="photo introuvable"/>
    <br/>
    <a href="../index.php">Revenir à l'acceuil</a>
  <?php
   }else{
     $_POST['data']=null;
   ?>
   <br/>
   <img src="../pics/error.png" alt="photo introuvable"/>
   <br/>
    <a href="InscriptionClient.php">Réessayer</a>
   <?php
   }
  ?>

  </div>
  <?php } ?>

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
