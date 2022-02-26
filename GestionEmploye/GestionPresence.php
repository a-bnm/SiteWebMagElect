<!DOCTYPE html>
<html>
 <head>
   <title>Gestion de la présence des employés</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/GestionPresence.css">
 </head>

 <body>
  <?php
    session_start();
    include "../GestionAcces/DatabaseConnect.php";
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
     <font size="6" color="white">Gestion Présence</font>
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
   <div class="operation">
     <?php
       $err=false;
       if(isset($_POST["operation"]) and isset($_POST["employe"])){
         $nom=explode(" ",$_POST["employe"])[0];
         $prenom=explode(" ",$_POST["employe"])[1];
         if($_POST["operation"]=="retard"){
    ?>
          <div class="retard">
            <p class="titre1">Retard</p>
            <form method="post" action="GestionPresence.php?<?php echo session_id();?>">
              <input class="dater" type="text" name="date" placeholder="date du retard" required/>
              <input class="dureer" type="text" name="duree" placeholder="durée du retard" required/>
              <input type="hidden" name="operation1" value="retard"/>
              <input type="hidden" name="nom" value="<?php echo $nom;?>"/>
              <input type="hidden" name="prenom" value="<?php echo $prenom;?>"/>
              <textarea class="commentaire1" name="commentaire" placeholder="Commentaire" required></textarea>
              <input class="btn1" type="submit" value="Confirmer"/>
            </form>
          </div>
    <?php
         }elseif ($_POST["operation"]=="absence") {
    ?>
          <div class="absence">
            <p class="titre2">Absence</p>
            <form method="post" action="GestionPresence.php?<?php echo session_id();?>">
              <input class="datea" type="text" name="date" placeholder="date de l'absence" required/>
              <input type="hidden" name="operation1" value="absence"/>
              <input type="hidden" name="nom" value="<?php echo $nom;?>"/>
              <input type="hidden" name="prenom" value="<?php echo $prenom;?>"/>
              <textarea class="commentaire1" name="commentaire" placeholder="Commentaire" required></textarea>
              <input class="btn1" type="submit" value="Confirmer"/>
           </form>
         </div>
    <?php
         }elseif ($_POST["operation"]=="conge") {
    ?>
          <div class="conge">
           <p class="titre1">Congé</p>
           <form method="post" action="GestionPresence.php?<?php echo session_id();?>">
             <input class="dated" type="text" name="dated" placeholder="date du debut" required/>
             <input class="datef" type="text" name="datef" placeholder="date de fin" required/>
             <input type="hidden" name="operation1" value="conge"/>
             <input type="hidden" name="nom" value="<?php echo $nom;?>"/>
             <input type="hidden" name="prenom" value="<?php echo $prenom;?>"/>
             <textarea class="commentaire1" name="commentaire" placeholder="Commentaire" required></textarea>
             <input class="btn1" type="submit" value="Confirmer"/>
           </form>
         </div>
   <?php
         }
       }

       if(isset($_POST['operation1'])){

          //recuperation de l'identifiant
          $requete="select IdentifiantEmp from employe where nom='".$_POST['nom']."' and prenom='".$_POST['prenom']."'";
          $resultat=$connexion->query($requete);
          $idf=$resultat->fetch_row();
          if($_POST['operation1']=="conge"){

            //insertion de l'employe
            $requete="insert into conge(IdentifiantEmp,dateDebut,dateFin,Commentaire) values
                      ('".$idf[0]."','".$_POST['dated']."','".$_POST['datef']."','".$_POST['commentaire']."')";
            $resultat=$connexion->query($requete);

            if(!$resultat){
              $err=true;
            }
          }elseif ($_POST['operation1']=="absence") {
            //insertion de l'employe
            $requete="insert into absence(IdentifiantEmp,dateAbs,Commentaire) values
                      ('".$idf[0]."','".$_POST['date']."','".$_POST['commentaire']."')";
            $resultat=$connexion->query($requete);

            if(!$resultat){
              $err=true;
            }
          }elseif ($_POST['operation1']=="retard") {
            //insertion de l'employe
            $requete="insert into retard(IdentifiantEmp,dateret,duree,Commentaire) values
                      ('".$idf[0]."','".$_POST['date']."','".$_POST['duree']."','".$_POST['commentaire']."')";
            $resultat=$connexion->query($requete);

            if(!$resultat){
              $err=true;
            }
          }
          if(!$err){
        ?>
             <div class="reponse">
              <p>Insertion réalisée avec succés</p>
              <img src="../pics/done.png" alt="photo introuvable"/>
              <br/>
              <a href="GestEmp.php?<?php echo session_id();?>">Revenir à la gestion des employés?</a>
            </div>
         <?php
          }else{

         ?>
            <div class="reponse">
             <p class="erreur">Erreur !!</p>
             <img src="../pics/error.png" alt="photo introuvable"/>
             <br/>
             <a class="erreur" href="GestEmp.php?<?php echo session_id();?>">Réessayer?</a>
           </div>
          <?php
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
