<!DOCTYPE html>
<html>
 <head>
   <title>Consultation de la présence des employés</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/AffichagePr.css">
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
     <font size="6" color="white">Affichage Présence</font>
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
   <div class="affichage">
     <?php
       $err=false;
       if(isset($_POST["operation"]) and isset($_POST["employe"])){
         $nom=explode(" ",$_POST["employe"])[0];
         $prenom=explode(" ",$_POST["employe"])[1];

         $err=false;
         //connexion au serveur
         $connexion=new mysqli("localhost","root","");

         if($connexion){
          $requete="USE TechStore";
          $resultat=$connexion->query($requete);

          if(!$resultat){
           $err=true;
          }

          //récuperation de l'identifiant de l'employé
          $requete="select IdentifiantEmp from employe where nom='".$nom."' and prenom='".$prenom."'";
          $resultat=$connexion->query($requete);
          $idf=$resultat->fetch_row();
         if($_POST["operation"]=="retard"){
           $requete="select dateret,duree,commentaire from retard where IdentifiantEmp=".$idf[0];
           $resultat=$connexion->query($requete);
           $nb=$resultat->num_rows;
           $retards=$resultat->fetch_row();
    ?>
           <table class="retard">
             <caption>Retards de <?php echo $nom." ".$prenom; ?></caption>
             <tr>
               <th>Date du retard</th>
               <th>Durée du retard</th>
               <th>Commentaire</th>
             </tr>
            <?php
              $i=0;
              while($i<$nb){
            ?>
             <tr>
              <td><?php echo $retards[0]; ?></td>
              <td><?php echo $retards[1]; ?></td>
              <td><?php echo $retards[2]; ?></td>
             </tr>
            <?php
              $i=$i+1;
              }
            ?>
           </table>
    <?php
         }elseif ($_POST["operation"]=="absence") {
           $requete="select dateAbs,commentaire from absence where IdentifiantEmp=".$idf[0];
           $resultat=$connexion->query($requete);
           $nb=$resultat->num_rows;
           $retards=$resultat->fetch_row();
      ?>
           <table class="absence">
             <caption>Absences de <?php echo $nom." ".$prenom; ?></caption>
             <tr>
               <th>Date de l'absence</th>
               <th>Commentaire</th>
             </tr>
            <?php
              $i=0;
              while($i<$nb){
            ?>
             <tr>
              <td><?php echo $retards[0]; ?></td>
              <td><?php echo $retards[1]; ?></td>
             </tr>
            <?php
              $i=$i+1;
              }
            ?>
           </table>

    <?php
         }elseif ($_POST["operation"]=="conge") {
           $requete="select dateDebut,DateFin,commentaire from conge where IdentifiantEmp=".$idf[0];
           $resultat=$connexion->query($requete);
           $nb=$resultat->num_rows;
           $retards=$resultat->fetch_row();
      ?>
           <table >
             <caption>Congés de <?php echo $nom." ".$prenom; ?></caption>
             <tr>
               <th>Date du debut</th>
               <th>Date de fin</th>
               <th>Commentaire</th>
             </tr>
            <?php
              $i=0;
              while($i<$nb){
            ?>
             <tr>
              <td><?php echo $retards[0]; ?></td>
              <td><?php echo $retards[1]; ?></td>
              <td><?php echo $retards[2]; ?></td>
             </tr>
            <?php
              $i=$i+1;
              }
            ?>
           </table>

   <?php
         }
       }
     }
     if($err){

    ?>
       <div class="erreur">
        <p class="erreur">Erreur !!</p>
        <img src="../pics/error.png" alt="photo introuvable"/>
        <br/>
        <a class="erreur" href="GestEmp.php?<?php echo session_id();?>">Réessayer?</a>
      </div>
     <?php
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
