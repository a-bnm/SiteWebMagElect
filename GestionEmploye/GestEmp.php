<!DOCTYPE html>
<html>
 <head>
   <title>Menu de la gestion des employés</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/GestionEmp.css">
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
     <font size="6" color="white">Gestion Employés</font>
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
    <div class="options">
     <?php
      //connexion au serveur
      $connexion=new mysqli("localhost","root","");

      if($connexion){
       $requete="USE TechStore";
       $resultat=$connexion->query($requete);

       if(!$resultat){
        $err=true;
       }

       //recuperation du nom et du prenom
       $requete="Select nom,prenom from employe";
       $resultat=$connexion->query($requete);
       $err=false;
       if(!$resultat){
         $err=true;
       }

     }else{
       $err=true;
     }

     if(!$err){//si il n y a aucune erreur

       $nb=$resultat->num_rows;
       $i=0;
       $k=0;
       //on met les infos récupéré dasn deux tableaux pour les utiliser dans toute la page
       while($i<$nb){
        $ligne=$resultat->fetch_row();
        $nom[$k]=$ligne[0];
        $prenom[$k]=$ligne[1];

        $i=$i+1;
        $k=$k+1;
      }
    }else{
  ?>
      <div class="reponse">
        <p>Erreur !!</p>
        <img src="../pics/error.png" alt="photo introuvable"/>
        <br/>
        <a href="GestEmp.php?<?php echo session_id();?>">Réessayer?</a>
      </div>
  <?php } ?>

  <!--Ajouter un employé-->
   <p class="titre1">Ajouter un nouvel employé</p>
   <form method="post" action="InscriptionEmp.php?<?php echo session_id();?>">
    <input class="btn1" type="submit" value="Choisir" />
   </form>


  <!--Supprimer un employé -->
   <p class="titre2">Supprimer un employé</p>
   <form class="SuppEmp" method="post" action="SuppEmploye.php?<?php echo session_id();?>">
    <select class="choix1" name="employe">
      <option  disabled>Employé</option>
      <?php
       if(!$err){
        $k=0;
        while($k<$nb){
       ?>
         <option value="<?php echo "$nom[$k] $prenom[$k]"; ?>"><?php echo "$nom[$k] $prenom[$k] "; ?></option>
       <?php
         $k=$k+1;
        }
       }
        ?>
    </select>
    <input class="btn2" type="submit" value="Choisir" />
   </form>

   <!--Affichage des information d'un employé-->
   <p class="titre3">Afficher les informations d'un employé</p>
   <form class="SuppEmp" method="post" action="AfficheEmp.php?<?php echo session_id();?>">
    <select class="choix2" name="info">
      <option  disabled>Employé</option>
      <?php
       if(!$err){
        $k=0;
        while($k<$nb){
       ?>
         <option value="<?php echo "$nom[$k] $prenom[$k]"; ?>"><?php echo "$nom[$k] $prenom[$k] "; ?></option>
       <?php
         $k=$k+1;
        }
       }
       ?>
    </select>
    <input class="btn3" type="submit" value="Choisir" />
   </form>

  <!--Ajouter un retard ,congés ou une absence-->
   <p class="titre4">Gestion congés,retards et absences</p>
   <form class="SuppEmp" method="post" action="GestionPresence.php?<?php echo session_id();?>">
    <select class="choix3" name="employe">
     <option  disabled>Employé</option>
     <?php
      if(!$err){
        $k=0;
        while($k<$nb){
     ?>
         <option value="<?php echo "$nom[$k] $prenom[$k]"; ?>"><?php echo "$nom[$k] $prenom[$k] "; ?></option>
     <?php
         $k=$k+1;
        }
       }
     ?>
    </select>
    <!--Permet de choisir l'operation-->
    <select class="choix4" name="operation">
      <option  disabled>Choix</option>
      <option value="conge">Congé</option>
      <option value="retard">Retard</option>
      <option value="absence">Absence</option>
    </select>
    <input class="btn4" type="submit" value="Choisir" />
   </form>

   <!--Affichage des retard,congés et absences-->
   <p class="titre5">Afficher Congés,retards et absences</p>
   <form class="SuppEmp" method="post" action="AffichagePr.php?<?php echo session_id();?>">
    <select name="employe" class="choix5">
     <option  disabled>Employé</option>
     <?php
       if(!$err){
        $k=0;
        while($k<$nb){
     ?>
         <option value="<?php echo "$nom[$k] $prenom[$k] "; ?>"><?php echo "$nom[$k] $prenom[$k] "; ?></option>
     <?php
         $k=$k+1;
        }
       }
     ?>
    </select>
   <!--choix de l'operation-->
    <select name="operation" class="choix6">
      <option  disabled>Choix</option>
      <option value="conge">Congé</option>
      <option value="retard">Retard</option>
      <option value="absence">Absence</option>
    </select>
    <input class="btn5" type="submit" value="Choisir" />
   </form>
  </div>

  <footer>
    <div class="part1">
     <?php
        include "../HeaderFooter/footerInfo.php ";
     ?>
     <p class="titre">Nos addresses</p>
     <div class="info">

      <div class="element1">
       <div class="mini_icon"><img src="pics/pointer.png"/></div>
       <div class="txt"><?php echo $adresses[1];?></div>
      </div>
   <?php
     if(count($adresses)>1){
   ?>
      <div class="element2">
       <div class="mini_icon"><img src="pics/pointer.png"/></div>
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
        <div class="mini_icon"><img src="pics/pointer.png"/></div>
        <div class="txt"><a href="">A propos de nous</a></div>
       </div>
       <div class="element2">
         <div class="mini_icon"><img src="pics/pointer.png"/></div>
         <div class="txt"> <a href="">Légales</a></div>
       </div>
       <div class="element3">
         <div class="mini_icon"><img src="pics/pointer.png"/></div>
         <div class="txt"> <a href="">Conditions d'utilisations et confdentialités</a></div>
       </div>
       <div class="element4">
         <div class="mini_icon"><img src="pics/pointer.png"/></div>
         <div class="txt"><a href="">Attributions </a></div>
       </div>
      </div>
     </div>

     <div class="part3">
       <p class="titre">Nous contacter</p>
        <div class="info">
         <div class="element1">
           <div class="mini_icon"><img src="pics/pointer.png"/></div>
           <div class="txt"><?php echo $numeros[0]; ?></div>
         </div>
     <?php
      if(count($numeros)>1){
     ?>
        <div class="element2">
           <div class="mini_icon"><img src="pics/pointer.png"/></div>
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
        <div class="mini_iconRS1"><img src="pics/facebook.png"/></div>

       </a>
       <a href="<?php echo $reseau2;?>">
        <div class="mini_iconRS2"><img src="pics/instagram.png"/></div>

       </a>
       <a href="<?php echo $reseau3;?>">
        <div class="mini_iconRS3"><img src="pics/twitter.png"/></div>
       </a>
     </div>
    </div>
   </footer>
  </div>
 </body>
</html>
