<?php
 session_start();
 include "../GestionAcces/DatabaseConnect.php";
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Rechercher un produit</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css"/>
   <link rel="stylesheet" href="../css/Recherche.css"/>
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
          <a href="Recherche.php?<?php echo session_id();?>">Recherche Avancée</a>
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
              <a href="../Menu/Menu.php?<?php echo session_id();?>">Menu</a>
          <?php
           }
          ?>
        </li>
       </ul>
      </li>
     </ul>

    <div class="titre_page">
     <font size="6" color="white">Recherche</font>
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
    <div class="PartieRecherche">
      <form action="Recherche.php?<?php echo session_id();?>" method="post">
        <input type="hidden" name="operation" value="1"/>
        <input type="hidden" name="recherche" value="oui"/>
        <select name="produit" class="produit" required >
          <option  disabled>type de produit</option>
          <option value="telephone">Téléphone ou tablette</option>
          <option value="pc">Pc</option>
          <option value="unitecentral">Unité central</option>
          <option value="ecran">Moniteur</option>
          <option value="accesoires">Accésoire ou autre</option>
        </select>
        <input type="text" name="marque" placeholder="Marque" class="marque"/>
        <input type="text" name="modele" placeholder="Modéle" class="modele"/>
        <input type="range" min="0" max="500000"  step="500" name="budget" class="prix" />
        <input type="submit" value="Chercher" class="btn1"/>
      </form>
     </div>
     <div class="resultat">
      <?php
        if(isset($_POST['recherche'])){

         if(isset($_POST['operation'])){
          //c'est une recherche à partir de cette page

          $nb1=0; $nb2=0; $nb3=0 ; $nb4=0;


          if( $_POST['marque']!=NULL and $_POST['modele']!=NULL and $_POST['budget']!=NULL){
            //tous les champs remplis
            $requete="select * from ".$_POST['produit']." where marque='".$_POST['marque']."' and modele like '%".$_POST['modele']."%' and prix<=".$_POST['budget'];

          }elseif ( $_POST['marque']!=NULL and $_POST['modele']!=NULL and $_POST['budget']==NULL) {
            $requete="select * from ".$_POST['produit']." where marque='".$_POST['marque']."' and modele like '%".$_POST['modele']."%'";

          }elseif ( $_POST['marque']!=NULL and $_POST['modele']==NULL and $_POST['budget']!=NULL) {
            $requete="select * from ".$_POST['produit']." where marque='".$_POST['marque']."' and prix<=".$_POST['budget'];

          }elseif ($_POST['marque']!=NULL and $_POST['modele']==NULL and $_POST['budget']==NULL) {
            $requete="select * from ".$_POST['produit']." where marque='".$_POST['marque']."'";

          }elseif ( $_POST['marque']==NULL and $_POST['modele']!=NULL and $_POST['budget']!=NULL) {
            $requete="select * from ".$_POST['produit']." where modele like '%".$_POST['modele']."%' and prix<=".$_POST['budget'];

          }elseif ( $_POST['marque']==NULL and $_POST['modele']!=NULL and $_POST['budget']==NULL) {
            $requete="select * from ".$_POST['produit']." where  modele like '%".$_POST['modele']."%' ";

          }elseif ($_POST['marque']==NULL and $_POST['modele']==NULL and $_POST['budget']!=NULL) {
            $requete="select * from ".$_POST['produit']." where prix<=".$_POST['budget'];

          }elseif ($_POST['marque']==NULL and $_POST['modele']==NULL and $_POST['budget']==NULL) {
            $requete="select * from ".$_POST['produit'];

          }

          //envoi de la requéte
          $resultat=$connexion->query($requete);
          $nb=$resultat->num_rows;
          //récupération des résultats de la recherche
          $reponse=$resultat->fetch_assoc();
          $resultatR=$connexion->query($requete);
          $reponseR=$resultatR->fetch_row();
          $idf=$reponseR[0];
        ?>
          <table cellspacing="20px">
      <?php
            $x=0;
            while($nb>0){
              if($x==0){
        ?>
                 <tr>
      <?php
              }
      ?>
              <td>
               <img  src="<?php echo $reponse['Image1']; ?>" alt="Image introuvable"/>
               <form action="AffichageComplet.php?<?php echo session_id();?>" method="post">
                 <input type="hidden" name="table" value="<?php echo $_POST['produit']; ?>"/>
                 <input type="hidden" name="id" value="<?php echo $idf;?>"/>
                 <input class="lien" type="submit" value="<?php echo $reponse['Marque']." ".$reponse['modele'];?>" />
               </form>
              </td>
      <?php
              $nb=$nb-1;
              $x=$x+1;
              if($x==4){
                $x=0;
      ?>
                </tr>
      <?php
               }

           }
     ?>
        </table>
     <?php
        }else{
          //c'est une recherche à partir de l'acceuil

          //recuperation des inforamtions de la recherche
         $chaine=$_POST['demande'];
         $recu=explode(" ",$chaine,2);

         if(count($recu)>1){
           $marque=$recu[0];
           $modele=$recu[1];

           $requete1[0]="select * from telephone where marque='".$marque."' and modele like '%".$modele."%'";
           $requete1[1]="select * from pc where marque='".$marque."' and modele like '%".$modele."%'";
           $requete1[2]="select * from ecran where marque='".$marque."' and modele like '%".$modele."%'";
           $requete1[3]="select * from unitecentral where marque='".$marque."' and modele like '%".$modele."%'";
           $requete1[4]="select * from accesoires where marque='".$marque."' and modele like '%".$modele."%'";
           $table1[0]='telephone';
           $table1[1]='pc';
           $table1[2]='ecran';
           $table1[3]='unitecentral';
           $table1[4]='accesoires';

           $i=0;
           while($i<=4){
             $resultat1[$i]=$connexion->query($requete1[$i]);
             $nb1[$i]=$resultat1[$i]->num_rows;
             $reponse1[$i]=$resultat1[$i]->fetch_assoc();
             $reponse1R[$i]=$resultat1[$i]->fetch_row();

             $i=$i+1;
           }
    ?>
        <table cellspacing="20px">
    <?php
          $x=0;
          $y=0;
          while($y<=4){

           while($nb1[$y]>0){
            if($x==0){
    ?>
               <tr>
    <?php
            }
    ?>
            <td>
             <img  src="<?php echo $reponse1['Image1']; ?>" alt="Image introuvable"/>
             <form action="AffichageComplet.php?<?php echo session_id();?>" method="post">
               <input type="hidden" name="table" value="<?php echo $table1[$y];?>"/>
               <input type="hidden" name="id" value="<?php echo $reponse1R[$y][0];?>"/>
               <input class="lien" type="submit" value="<?php echo $reponse1['Marque']." ".$reponse1['modele'];?>" />
             </form>
            </td>
    <?php
            $nb1[$y]=$nb1[$y]-1;
            $x=$x+1;
            if($x==4){
              $x=0;
    ?>
              </tr>
    <?php
             }
           }
           $y=$y+1;
         }

     ?>
   </table>
  <?php
      }else{
        echo "<div class=\"reponse\">";
        echo "<p>Veuillez donnez la marque et le modéle recherché séparé par un espace dans l'acceuil sinon remplissez les champs à coté..</p>";
        echo "</div>";
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
