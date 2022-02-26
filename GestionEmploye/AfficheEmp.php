<!DOCTYPE html>
<html>
 <head>
   <title>Affichage d'un employé</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/AfficheEmp.css">
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
        <a href="">Boutique</a>
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
    <font size="6" color="white">Affichage d'un employé</font>
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
      <li class="nompr" name="info">
       <?php
        echo $_SESSION['nom']."  ".$_SESSION['prenom'];
       ?>
       <hr width="50%" size="1" color="black" >
      </li>
      <li class="params">
       <a href="">Paramétres du compte</a>
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
   <div class="affichage">

    <?php
     include "../GestionAcces/DatabaseConnect.php";
     $info=explode(' ',$_POST['info']);
     //insertion de l'employe
     $requete="select * from employe where nom='".$info[0]."' and prenom='".$info[1]."'";
     $resultat=$connexion->query($requete);
     if(!$resultat){
       $err=true;
       echo("Erreur lors de la récupération des données.");
     }



   if(!$err){//si il n y a aucune erreur
     //recupertaion des résultats
     $ligne=$resultat->fetch_row();
  ?>


    <table  >
      <caption>Information de <?php echo"$ligne[2] $ligne[3]"?></caption>
      <tr>
       <th>Nom</th>
       <td><?php echo"$ligne[2]"?></td>
      </tr>
      <tr>
       <th>Prenom</th>
       <td><?php echo"$ligne[3]"?></td>
      </tr>
      <tr>
       <th>Email</th>
       <td><?php echo"$ligne[1]"?></td>
      </tr>
      <tr>
       <th>Date de naissance</th>
       <td><?php echo"$ligne[4]"?></td>
      </tr>
      <tr>
        <th>Lieu de naissance</th>
        <td><?php echo"$ligne[5]"?></td>
      </tr>
      <tr>
        <th>Adresse</th>
        <td><?php echo"$ligne[6]"?></td>
      </tr>
      <tr>
       <th>Poste</th>
       <td><?php echo"$ligne[8]"?></td>
      </tr>
      <tr>
       <th>Date d'embauche</th>
       <td><?php echo"$ligne[9]"?></td>
      </tr>
      <tr>
       <th>Diplomes et Formations</th>
       <td><?php echo"$ligne[10]"?></td>
      </tr>
      <tr>
       <th>Experience</th>
       <td><?php echo"$ligne[11]"?></td>
      </tr>
      <tr>
       <th>Salaire</th>
       <td><?php echo"$ligne[12]"?></td>
      </tr>
      <tr>
       <th>Numéro de téléphone</th>
       <td><?php echo"$ligne[14]"?></td>
      </tr>
    </table>
    <div class="image">
      <img src="<?php echo $ligne[7]; ?>" alt="No pic"/>
    </div>
   <?php
    }else{  ?>
     <div class="erreur">

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
