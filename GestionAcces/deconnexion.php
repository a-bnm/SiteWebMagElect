<?php
 session_start();
 $_SESSION['etat']=null;
 $_SESSION['poste']=null;
 $_SESSION['nom']=null;
 $_SESSION['prenom']=null;
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Deconnexion</title>
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
            if(isset($_SESSION['poste']) and   $_SESSION['poste']!='client'){
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
     <font size="6" color="white">Déconnexion</font>
    </div>
  </header>
  <div class="main">
   <div class="ConnCheck">
    Vous avez été déconnecté
    <br/>
    <img src="../pics/done.png" alt="photo introuvable"/>
    <br/>
    <a href="../index.php?<?php echo session_id();?>">Revenir à l'acceuil</a>
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
