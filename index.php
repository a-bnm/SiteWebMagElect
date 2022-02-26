<?php
 session_start();
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Acceuil</title>
   <meta charset="utf-8" >
   <meta name="viewport" content="width=device-width, initial-scale=1.0" >
   <link rel="stylesheet" href="css/HeaderFooter.css" >
   <link rel="stylesheet" href="css/Acceuil.css" >
 </head>
 <body>

   <header>

    <ul class="menu">
      <li class="items1">
       <ul class="interieur">
        <li class="one">
          <a href="index.php?<?php echo session_id();?>">Acceuil</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="GestionProduit/Recherche.php?<?php echo session_id();?>">Recherche Avancée</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="Atelier/Rendez-vous.php?<?php echo session_id();?>">Réparation</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <a href="GestionProduit/CommandeSpecial.php?<?php echo session_id();?>">Commandes spéciales</a>
          <hr width="50%" size="1" color="black" >
        </li>
        <li>
          <?php
            if(isset($_SESSION['poste']) and   $_SESSION['poste']!='client'){
          ?>
              <a href="Menu/Menu.php">Menu</a>
          <?php
           }elseif(isset(  $_SESSION['poste']) and   $_SESSION['poste']=='client'){
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
     <font color="white" size="6">Acceuil</font>
    </div>
    <div class="recherche">
      <form action="GestionProduit/Recherche.php?<?php echo session_id();?>" method="post">
        <input type="hidden" name="recherche" value="oui"/>
        <input type="text" placeholder="marque modéle" name="demande" required class="ChampRecherche"/>
        <input type="submit" class="BoutonRecherche" />
      </form>
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
          <a href="GestionAcces/connexion.php?<?php echo session_id();?>" >Se connecter?</a>

      <?php

       }else{
      ?>
      <li>
       <div class="image1"><img src="pics/compte1.png" alt="No pic found"/></div>
      </li>
      <li class="nompr">
       <?php
        echo $_SESSION['nom']."  ".$_SESSION['prenom'];
       ?>
       <hr width="50%" size="1" color="black" >
      </li>
      <li class="params">
       <a href="GestionCompte/ParametreCompte.php?<?php echo session_id();?>">Paramétres du compte</a>
       <hr width="50%" size="1" color="black" >
      </li>
      <li class="dec">
       <a href="GestionAcces/deconnexion.php?<?php echo session_id();?>">Déconnexion</a>
      </li>
      <?php
       }
      ?>

      </ul>
     </li>
    </ul>
    <hr class="ligne1" width="100%"  size="2" color="white" >
   </header>
   <main>
    <div class="Bienvenue">
     <p><br/>Bienvenue dans votre &nbsp;<br/> magasin tech &nbsp;</p>
    </div>
    <?php
      include 'GestionAcces/DatabaseConnect.php';
      $requete="select * from produitAcceuil";
      $resultat=$connexion->query($requete);
      $nb=$resultat->num_rows;
      $reponse=$resultat->fetch_row();

    ?>
    <div class="Nouveaute">
      <table cellspacing="20" cellpadding="10">
       <tr id="defilement">
        <?php
          $i=0;
          while($i<10 and $nb>0){
            //sert à identifier le nom de l'attribut idf de l'element
            if($reponse[2]=='telephone'){
              $NomIdf="identifiantTel";
            }elseif ($reponse[2]=='pc') {
              $NomIdf="identifiantpc";
            }elseif ($reponse[2]=='unitecentral') {
              $NomIdf="identifiantUnite";
            }elseif ($reponse[2]=='ecran') {
              $NomIdf="identifiantEc";
            }elseif ($reponse[2]=='accesoires') {
              $NomIdf="identifiantAcc";
            }
            $requete1="select marque,modele,Image1 from ".$reponse[2]." where ".$NomIdf."=".$reponse[1];
            $resultat1=$connexion->query($requete1);
            $nb1=$resultat1->num_rows;
            if($nb1>0){
              $reponse1=$resultat1->fetch_row();
            ?>
                <td >
                  <div class="imagesAppareil">
                    <img src="<?php echo explode("../",$reponse1[2])[1];?>" alt="No pic found" />
                    <form action="GestionProduit/AffichageComplet.php?<?php echo session_id();?>" method="post">
                     <input type="hidden" name="table" value="<?php echo $reponse[2];?>"/>
                     <input type="hidden" name="id" value="<?php echo $reponse[1];?>"/>
                     <input class="lien" type="submit" value="<?php echo $reponse1[0]." ".$reponse1[1];?>" />
                    </form>
                   </div>
                </td>
            <?php
            }


            $reponse=$resultat->fetch_row();
            $nb=$nb-1;
            $i=$i+1;
          }
        ?>
      </tr>
    </table>
   </div>
  </main>
  <footer>
   <hr class="ligne2"  size="2" color="white">
   <?php
     include 'HeaderFooter/footerInfo.php';
   ?>
   <div class="part1">
    <p class="titre">Nos addresses</p>
    <div class="info">

     <div class="element1">
      <div class="mini_icon"><img src="pics/pointer.png"/></div>
      <div class="txt"><?php echo $adresses[1];?></div>
     </div>
  <?php
    include 'HeaderFooter/footerInfo.php';
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
          <div class="txt"><a href='HeaderFooter/Info.php'>Plus...</a></div>
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
 </body>
</html>
