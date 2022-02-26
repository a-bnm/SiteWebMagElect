<!DOCTYPE html>
<html>
 <head>
   <title>Inscription</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
    <link rel="stylesheet" href="../css/InscriptionEmp.css">
 </head>
 <body>
   <?php
        session_start();
        include '../GestionAcces/DatabaseConnect.php';
      ?>
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
            if(isset($_SESSION['poste']) and   $_SESSION['poste']!='client'){
          ?>
              <a href="../Menu/Menu.php">Menu</a>
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
       <a href="deconnexion.php?<?php echo session_id();?>">Déconnexion</a>
      </li>
      <?php
       }
      ?>

      </ul>
     </li>
    </ul>

   </header>

  <div class="main">
  <div class="operation">
   <?php
    if(!isset($_POST['data'])){
   ?>
    <div class="formulaire">
     <form name="InsCl"  method="post" action="InscriptionEmp.php" enctype="multipart/form-data">
      <input name="data" type="hidden" value="oui" required/>
      <input class="nom" name="nom" type="text" placeholder="Nom" required/>
      <input class="prenom" name="prenom" type="text" placeholder="Prenom" required/>
      <input class="naiss" name="DateNaiss" type="text" placeholder="Date de naissance" required />
      <input class="lnaiss" name="LieuNaiss" type="text" placeholder="Lieu de naissance" required />
      <TextArea class="adr" name="adresse" placeholder="Aresse" required></TextArea>
      <select class="pst" name="Poste" required>
       <option disabled>Poste</option>
       <option value="Administarteur">Administarteur</option>
       <option value="Vendeur">Vendeur</option>
       <option value="Réparateur">Réparateur</option>
      </select>
      <TextArea class="dplm" name="Diplome" placeholder="Diplome ou formation" required></TextArea>
      <TextArea class="exp" name="experience" placeholder="Experience" required></TextArea>
      <input class="DateEmb" name="DateEmb" type="text" placeholder="Date d'embuache" required/>
      <input class="Salaire" name="Salaire" type="text" placeholder="Salaire" required/>
      <input class="mail" name="Email" type="text" placeholder="Email"required />
      <input class="mdp" name="mdp" type="password" placeholder="Mot de passe"required />
      <input class="mdp1" name="mdp1" type="password" placeholder="Confirmer le mot de passe" required/>
      <input class="tel" name="tel" type="text" placeholder="Numéro de téléphone" required/>
      <input name="EmpImg" type="file"  class="pic" id="file" />
      <label for="file" >Importer une image</label>
      <input class="btn" type="submit" value="Confirmer"/>
   </form>
  </div>
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
     $pst=$_POST['Poste'];
     $mail=$_POST['Email'];
     $mdp=$_POST['mdp'];
     $mdp1=$_POST['mdp1'];
     $Diplome=$_POST['Diplome'];
     $exp=$_POST['experience'];
     $datemb=$_POST['DateEmb'];
     $sal=$_POST['Salaire'];
     $tel=$_POST['tel'];
     $destination="../ImageEnregistre/";
     $nameFile=$_FILES['EmpImg']['name'];
     $tempName=$_FILES['EmpImg']['tmp_name'];
     if(!move_uploaded_file($tempName,$destination.$nameFile)){
       echo"Erreur lors de la sauvegarde de l'image.\n";
     }
     $err=false;
     //connexion au serveur
     $connexion=new mysqli("localhost","root","");

     if($connexion){
      $requete="USE TechStore";
      $resultat=$connexion->query($requete);

      if(!$resultat){
        $err=true;
        echo("Erreur lors de l'utilisation de la base de donnée. ");
      }

      //insertion de l'employe
      $requete="insert into employe (Email,nom,prenom,DateNaiss,LieuNaiss,Adresse,Poste,dateEmbauche,DiplomeFormation,Experience,Salaire,MotDePasse,EmployePic,tel)
       values('".$mail."','".$nom."','".$prenom."',".$naiss.",'".$lnaiss."','".$adr."','".$pst."','".$datemb."','".$Diplome."',
       '".$exp."',".$sal.",'".$mdp."','".$destination.$nameFile."','".$tel."')";
      $resultat=$connexion->query($requete);
      if(!$resultat){
        $err=true;
        $m=$connexion->error;
        echo("Erreur lors de l'enregistrement des données.".$m);
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
    <a href="InscriptionEmp.php">Réessayer</a>
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
