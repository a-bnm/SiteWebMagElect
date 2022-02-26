<?php
 session_start();
 include '../GestionAcces/DatabaseConnect.php';
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Paramétres du compte</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css" />
   <link rel="stylesheet" href="../css/ParametreCompte.css" />
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
              <a href="../Menu/Menu.php?<?php echo session_id();?>">Menu</a>
          <?php
           }
          ?>
        </li>
       </ul>
      </li>
     </ul>

    <div class="titre_page">
     <font size="6" color="white">Paramétres du compte</font>
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
    <?php
      if(isset($_SESSION['etat'])){
        $err=false;
    ?>
          <div class="partie1">
            <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
              <input type="hidden" name="operation" value="mail"/>
              <input class="btn1" type="submit" value="Modifier votre adresse email" />
            </form>

            <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
              <input type="hidden" name="operation" value="mdp"/>
              <input class="btn2" type="submit" value="Modifier votre mot de passe" />
            </form>

   <?php
            if($_SESSION['poste']=='Administarteur'){
   ?>
                <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                  <input type="hidden" name="operation" value="basPage"/>
                  <input class="btn3" type="submit" value="Informations du bas de page" />
                </form>
                <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                  <input type="hidden" name="operation" value="acceuil"/>
                  <input class="btn4" type="submit" value="Choisir les produits affichés à l'acceuil" />
                </form>
   <?php
      }
   ?>
      </div>
      <div class="partie2">
       <?php
         if(isset($_POST['operation'])){

          if($_POST['operation']=='mail'){
            if(!isset($_POST['resultat'])){
       ?>
              <div class="formT1">
               <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                 <input type="hidden" name="operation" value="mail"/>
                 <input type="hidden" name="resultat" value="oui"/>
                 <p>Email</p>
                 <input type="text" class="mail" name="mail" placeholder="Nouvelle adresse mail"/>
                 <input class="btn5" type="submit" value="Confirmer" />
               </form>
              </div>
      <?php
            }else{
              $idf=$_SESSION['id'];
              $table=$_SESSION['table'];

              if($table=='client'){
                $requete="update client set Email='".$_POST['mail']."' where identifiantCl=".$idf;
              }else{
                $requete="UPDATE employe SET Email='".$_POST['mail']."' WHERE identifiantEmp=".$idf;
              }

              //execution
              $resultat=$connexion->query($requete);
              if(!$resultat){
                  $err=true;
              }
            }

          }elseif ($_POST['operation']=='mdp') {
            if(!isset($_POST['resultat'])){
        ?>
              <div class="formT1">
               <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                <input type="hidden" name="operation" value="mdp"/>
                <input type="hidden" name="resultat" value="oui"/>
                <p>Mot de passe</p>
                <input type="text" class="mail" name="mdp" placeholder="Nouveau mot de passe"/>
                <input class="btn5" type="submit" value="Confirmer" />
               </form>
              </div>
        <?php
            }else{
              $idf=$_SESSION['id'];
              $table=$_SESSION['table'];
              if($table=='client'){
                  $requete="update client set MotDePasse='".$_POST['mdp']."' where identifiantCl=".$idf;
              }else{
                  $requete="update employe set MotDePasse='".$_POST['mdp']."' where identifiantEmp=".$idf;
              }

              //execution
              $resultat=$connexion->query($requete);
              if(!$resultat){
                  $err=true;
              }
            }

          }elseif ($_POST['operation']=='basPage') {
            if(!isset($_POST['resultat'])){
             $requete="select * from pieddepage ";
             $resultat=$connexion->query($requete);
             $taille=$resultat->num_rows;
             if($taille==0 or (isset($_POST['information']) and $_POST['information']=='tous' )){
        ?>
              <div class="formT2">
               <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
               <p>Remplissez le formulaire</p>
               <input type="hidden" name="operation" value="basPage"/>
               <input type="hidden" name="resultat" value="oui"/>
               <input type="hidden" name="tous1" value="oui"/>
               <input type="text" class="Adrs" name="Adrs" placeholder="Adresses séparés par /" required/>
               <input type="text" class="Nums" name="Nums" placeholder="Numéros séparés par /" required/>
               <input type="text" class="insta" name="insta" placeholder="Lien instagram" required/>
               <input type="text" class="facebook" name="facebook" placeholder="Lien facebook" required/>
               <input type="text" class="twitter" name="twitter" placeholder="Lien twitter" required/>
               <input class="btnM" type="submit" value="Confirmer" />
              </form>
             </div>
        <?php
          }elseif(isset($_POST['information']) and $_POST['information']=='adr'){
        ?>
            <div class="formT4">
              <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                <p>Adresses</p>
                <input type="hidden" name="operation" value="basPage"/>
                <input type="hidden" name="resultat" value="oui"/>
                <input type="text" class="InfoM" name="Adrs1" placeholder="Adresses séparés par /" required/>
                <input class="btnM" type="submit" value="Confirmer" />
              </form>
            </div>
        <?php
          }elseif(isset($_POST['information']) and $_POST['information']=='tel'){
        ?>
            <div class="formT4">
              <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                <p>Numéros de téléphones</p>
                <input type="hidden" name="operation" value="basPage"/>
                <input type="hidden" name="resultat" value="oui"/>
                <input type="text" class="InfoM" name="Nums1" placeholder="Numéros séparés par /" required/>
                <input class="btnM" type="submit" value="Confirmer" />
              </form>
            </div>
        <?php
          }elseif(isset($_POST['information']) and $_POST['information']=='instagram'){
        ?>
            <div class="formT4">
              <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                <p>Lien instagram</p>
                <input type="hidden" name="operation" value="basPage"/>
                <input type="hidden" name="resultat" value="oui"/>
                <input type="text" class="InfoM" name="insta1" placeholder="Lien instagram" required/>
                <input class="btnM" type="submit" value="Confirmer" />
              </form>
            </div>

        <?php
          }elseif(isset($_POST['information']) and $_POST['information']=='facebook'){
        ?>
           <div class="formT4">
             <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
               <p>Lien facebook</p>
               <input type="hidden" name="operation" value="basPage"/>
               <input type="hidden" name="resultat" value="oui"/>
               <input type="text" class="InfoM" name="facebook1" placeholder="Lien facebook" required/>
               <input class="btnM" type="submit" value="Confirmer" />
             </form>
           </div>
        <?php
          }elseif(isset($_POST['information']) and $_POST['information']=='twitter'){
        ?>
           <div class="formT4">
             <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
               <p>Lien twitter</p>
               <input type="hidden" name="operation" value="basPage"/>
               <input type="hidden" name="resultat" value="oui"/>
               <input type="text" class="InfoM" name="twitter1" placeholder="Lien twitter" required/>
               <input class="btnM" type="submit" value="Confirmer" />
             </form>
           </div>
        <?php
          }else{
        ?>
             <div class="formT2">
               <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                 <p>Que voulez vous modifier?</p>
                 <input type="hidden" name="operation" value="basPage"/>
                 <input type="radio" class="Adrs1" name="information" value="adr" required/><div class="Adrstxt">Adresse</div>
                 <input type="radio" class="Nums1" name="information"  value="tel" required/><div class="Numstxt">Numéro de téléphone</div>
                 <input type="radio" class="insta1" name="information"  value="instagram" required/><div class="instatxt">L'adresse de votre compte instagram</div>
                 <input type="radio" class="facebook1" name="information"  value="facebook" required/><div class="facetxt">L'adresse de votre compte facebook</div>
                 <input type="radio" class="twitter1" name="information"  value="twitter" required/><div class="twittxt" >L'adresse de votre compte twitter</div>
                 <input type="radio" class="tous" name="information"  value="tous" required/><div class="toustxt">Tous</div>
                 <input class="btn6" type="submit" value="Confirmer" />
               </form>
             </div>
        <?php
            }
          }else{

            $requete="select * from pieddepage ";
            $resultat=$connexion->query($requete);
            $taille=$resultat->num_rows;
            if($taille==0){

               //c'est la premiere configuration
               $requete="insert into pieddepage(adresses,numeros,reseau1,reseau2,reseau3)
                     values ('".$_POST['Adrs']."','".$_POST['Nums']."','".$_POST['insta']."','".$_POST['facebook']."','".$_POST['twitter']."')";

            }else{
              $reponse=$resultat->fetch_row();

              //la table a deja ete remplis donc cest une mise à jour
              if(isset($_POST['Adrs1'])){
                $requete="update pieddepage set adresses='".$_POST['Adrs1']."' where adresses='".$reponse[0]."'";

              }elseif (isset($_POST['Nums1'])) {
                $requete="update pieddepage set  numeros='".$_POST['Nums1']."'   where adresses='".$reponse[0]."'";
              }elseif (isset($_POST['facebook1'])) {
                $requete="update pieddepage set  reseau2='".$_POST['facebook1']."' where adresses ='".$reponse[0]."'";
              }elseif (isset($_POST['insta1'])) {
                $requete="update pieddepage set  reseau1='".$_POST['insta1']."' where adresses ='".$reponse[0]."'" ;
              }elseif (isset($_POST['twitter1'])) {
                $requete="update pieddepage set  reseau3='".$_POST['twitter1']."' where adresses ='".$reponse[0]."'";
              }elseif (isset($_POST['tous1'])) {
                $requete="update pieddepage set adresses='".$_POST['Adrs']."' ,numeros='".$_POST['Nums']."' ,reseau1='".$_POST['insta']."' ,reseau2='".$_POST['facebook']."' ,reseau3='".$_POST['twitter']."'  where adresses ='".$reponse[0]."'";
              }


           }
           echo"10";
           //execution
           $resultat=$connexion->query($requete);
           if(!$resultat){
             $m=$connexion->error;
             echo $m;
              $err=true;
          }
        }
      }elseif ($_POST['operation']=='acceuil') {
              if(!isset($_POST['num'])){

        ?>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="1"/>
                    <input class="btn7" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="2"/>
                    <input class="btn8" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="3"/>
                    <input class="btn9" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="4"/>
                    <input class="btn10" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="5"/>
                    <input class="btn11" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="6"/>
                    <input class="btn12" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="7"/>
                    <input class="btn13" id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="8"/>
                    <input class="btn14"  id="btn" type="submit" />
                  </form>
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="9"/>
                    <input class="btn15" id="btn" type="submit" />
                  </form>

                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="10"/>
                    <input class="btn16"  id="btn" type="submit" />
                  </form>

              <?php
              }else{

                if(!isset($_POST['produit'])){
                  $nb=$_POST['num'];

              ?>
                 <div class="formT3">
                  <form method="post" action="ParametreCompte.php?<?php echo session_id();?>">
                    <input type="hidden" name="operation" value="acceuil"/>
                    <input type="hidden" name="num" value="<?php echo $nb ; ?>"/>
                    <input type="hidden" name="resultat" value="oui"/>
                    <p>Choisissez l'appareil</p>
                    <select class="type" name="produit">
                      <option value="telephone">Telephone ou tablette</option>
                      <option value="pc">PC</option>
                      <option value="unitecentral">Unite central</option>
                      <option value="ecran">Moniteur</option>
                      <option value="accesoires">Accesoires ou autres</option>
                    </select>
                    <input class="marque" type="text" name="marque" placeholder="Marque"/>
                    <input class="modele" type="text" name="modele" placeholder="Modéle"/>
                    <select class="etat" name="etat">
                      <option disabled>etat</option>
                      <option value="Neuf">Neuf</option>
                      <option value="Occasion">Occasion</option>
                    </select>
                    <input class="btn17" type="submit" value="Confirmer" />
                  </form>
                </div>
            <?php
              }else{

                $requete="select * from ".$_POST['produit']." where marque='".$_POST['marque']."' and modele='".$_POST['modele']."' and etat='".$_POST['etat']."'";
                $resultat=$connexion->query($requete);
                if(!$resultat){
                  $err=true;
                }else{

                  $reponse=$resultat->fetch_row();
                  $requete="select * from ProduitAcceuil where identifiantAff=".$_POST['num'];
                  $resultat=$connexion->query($requete);
                  $taille=$resultat->num_rows;
                  if($taille==0){

                    //aucun produit ne s'affiche dans l'emplacement de num
                    $requete="insert into ProduitAcceuil (identifiantAff,identifiantPr,tableSource) values (".$_POST['num'].",".$reponse[0].",'".$_POST['produit']."')";

                  }else{//un produit a deja ete assigne a l'emplacement num donc mise à jour seulement
                    $requete="update ProduitAcceuil set identifiantPr=".$reponse[0]." ,tableSource='".$_POST['produit']."' where identifiantAff=".$_POST['num'];

                  }
                  $resultat=$connexion->query($requete);
                  if(!$resultat){
                    $err=true;
                  }
                }
              }
            }
           }
          }
          if(isset($_POST['resultat'])){
            if(!$err){
      ?>
              <div class="reponse">
                <p>Tache réalisée avec succés</p>
                <img src="../pics/done.png" alt="photo introuvable"/>
                <br/>
                <a href="ParametreCompte.php?<?php echo session_id();?>">Revenir ?</a>
              </div>
      <?php
            }else{
      ?>
              <div class="reponse">
                <p class="erreur">Erreur !!</p>
                <img src="../pics/error.png" alt="photo introuvable"/>
                <br/>
                <a class="erreur" href="ParametreCompte.php?<?php echo session_id();?>">Réessayer?</a>
              </div>
      <?php
            }
          }
        ?>
      </div>
     <?php
        }else{
     ?>
          <div class="nconnect">
            <p>Erreur! vous devez d'abord vous connecter</p>
            <br/><br/>
            <a href="../GestionAcces/connexion.php?<?php echo session_id();?>" >Se connecter?</a>
          </div>
     <?php
        }
     ?>

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
