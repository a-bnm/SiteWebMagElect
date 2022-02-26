<?php
 session_start();
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Menu</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/Menu.css">
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
            include "../GestionAcces/DatabaseConnect.php";
            if(isset($_SESSION['poste']) and   $_SESSION['poste']!='client'){
          ?>
              <a href="Menu.php?<?php echo session_id();?>">Menu</a>
          <?php
           }
          ?>
        </li>
       </ul>
      </li>
     </ul>

    <div class="titre_page">
     <font size="6" color="white">Menu</font>
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
   if(!isset($_SESSION['poste'])){
  ?>
    <div class="errMenu">
      <p>Erreur! vous devez d'abord vous connecter avant d'accéder au menu</p>
      <a href="../GestionAcces/connexion.php?<?php echo session_id();?>" >Se connecter?</a>
    </div>
  <?php
   }else{
  ?>
    <div class="partie1">
     <form method="post" action="Menu.php?<?php echo session_id();?>">
       <input type="hidden" name="operation" value="GestPr"/>
       <input class="btn1" type="submit" value="Gestion des produits" />
     </form>

     <form method="post" action="Menu.php?<?php echo session_id();?>">
       <input type="hidden" name="operation" value="GestSt"/>
       <input class="btn2" type="submit" value="Gestion du stock" />
     </form>
  <?php
      if($_SESSION['poste']=='Administarteur' or $_SESSION['poste']=='reparateur'){
  ?>
         <form method="post" action="Menu.php?<?php echo session_id();?>">
           <input type="hidden" name="operation" value="reparation"/>
           <input class="btn3" type="submit" value="Gestion des rendez-vous" />
         </form>
  <?php
      }
  ?>
  <?php
      if($_SESSION['poste']=='Administarteur' or $_SESSION['poste']=='vendeur'){
  ?>
         <form method="post" action="Menu.php?<?php echo session_id();?>">
           <input type="hidden" name="operation" value="commande"/>
           <input class="btnV" type="submit" value="Gestion des commandes" />
         </form>
  <?php
      }
  ?>
  <?php
     if($_SESSION['poste']=='Administarteur'){
  ?>
      <form method="post" action="Menu.php?<?php echo session_id();?>">
        <input type="hidden" name="operation" value="GestEmp"/>
        <input class="btnA" type="submit" value="Gestion des employés" />
      </form>
  <?php
     }
  ?>
    </div>
    <div class="partie2">
      <?php
        if(isset($_POST['operation'])){
          if($_POST['operation']=='GestPr'){//partie gestion des produits
      ?>
            <div class="AjoutPr">
              <p class="titre1">Ajouter un produit</p>
              <form method="post" action="../GestionProduit/AjouterPr.php?<?php echo session_id();?>">
                <select class="type1" name="produit">
                  <option value="telephone">Telephone</option>
                  <option value="pc">PC</option>
                  <option value="unitecentral">Unite central</option>
                  <option value="ecran">Moniteur</option>
                  <option value="accesoires">Accesoires ou autres</option>
                </select>
                <input class="btn4" type="submit" value="Choisir"/>
              </form>

            </div>
            <div class="SuppPr">
              <p class="titre2">Supprimer un produit</p>
              <form method="post" action="../GestionProduit/SuppPr.php?<?php echo session_id();?>">
                <select class="type2" name="produit">
                  <option value="telephone">Telephone</option>
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
                <input class="btn5" type="submit" value="Choisir"/>
              </form>

            </div>
      <?php
          }elseif($_POST['operation']=='GestSt'){//partie gestion du stock
      ?>
            <div class="Stock">
              <p class="titre3">Gestion du stock</p>
              <form method="post" action="../GestionProduit/GestionStock.php?<?php echo session_id();?>">
                <select class="type3" name="produit">
                  <option value="telephone">Telephone ou tablette</option>
                  <option value="pc">PC</option>
                  <option value="unitecentral">Unite central</option>
                  <option value="ecran">Moniteur</option>
                  <option value="accesoires">Accesoires ou autres</option>
                </select>
                <input class="marque1" type="text" name="marque" placeholder="Marque"/>
                <input class="modele1" type="text" name="modele" placeholder="Modéle"/>
                <select class="etat1" name="etat">
                  <option disabled>etat</option>
                  <option value="Neuf">Neuf</option>
                  <option value="Occasion">Occasion</option>
                </select>
                <input class="nb" type="text" name="nb" placeholder="+/- Nombre"/>
                <input class="btn6" type="submit" value="Choisir"/>
              </form>

            </div>
      <?php
       }elseif($_POST['operation']=='GestEmp'){//partie gestion des employés
      ?>
            <div class="GestEmpl">
              <p class="titre4">Gestion des employés</p>
              <form method="post" action="../GestionEmploye/GestEmp.php?<?php echo session_id();?>">
                <input class="btn8" type="submit" value="Choisir"/>
              </form>

            </div>

            <div class="HistEmp">
              <p class="titre5">Consulter l'historique d'un employé</p>
              <form method="post" action="../GestionEmploye/HistoriqueEmp.php?<?php echo session_id();?>">
                <input class="nom" type="text" name="nom" placeholder="Nom"/>
                <input class="prenom" type="text" name="prenom" placeholder="Prenom"/>
                <input class="btn7" type="submit" value="Choisir"/>
              </form>

            </div>
      <?php
        }elseif ($_POST['operation']=='reparation') {
            $requete="select * from rendezvousreparation";
            $resultat=$connexion->query($requete);
            $nb=$resultat->num_rows;
      ?>
            <table>
              <tr>
                <th>Identifiant</th>
                <th>Type de l'appareil</th>
                <th>Marque</th>
                <th>Modele</th>
                <th>Etat</th>
                <th>Plus</th>
              </tr>
      <?php

             while($nb>0){
               $reponse=$resultat->fetch_row();
      ?>
                <tr>
                  <td><?php echo $reponse[0];?></td>
                  <td><?php echo $reponse[3];?></td>
                  <td><?php echo $reponse[4];?></td>
                  <td><?php echo $reponse[5];?></td>
                  <td><?php echo $reponse[8];?></td>
                  <td>
                    <form method="post" action="../Atelier/GestionRendezV.php?<?php echo session_id();?>">
                      <input type="hidden" name="id" value="<?php echo $reponse[0];?>" />
                      <input type="submit" value="Choisir" />
                    </form>
                  </td>
                </tr>
      <?php
               $nb=$nb-1;
             }
      ?>
            </table>
      <?php
        }elseif ($_POST['operation']=='commande') {
            $requete="select * from commandespecial";
            $resultat=$connexion->query($requete);
            $nb=$resultat->num_rows;
      ?>
            <table >
               <tr>
                <th>Identifiant</th>
                <th>Type de l'appareil</th>
                <th>Marque</th>
                <th>Modele</th>
                <th>Etat</th>
                <th>Plus</th>
              </tr>
       <?php

               while($nb>0){
                 $reponse=$resultat->fetch_row();
        ?>
                 <tr>
                  <td><?php echo $reponse[0];?></td>
                  <td><?php echo $reponse[3];?></td>
                  <td><?php echo $reponse[4];?></td>
                  <td><?php echo $reponse[5];?></td>
                  <td><?php echo $reponse[7];?></td>
                  <td>
                    <form method="post" action="../GestionProduit/GestionCommandes.php?<?php echo session_id();?>">
                      <input type="hidden" name="id" value="<?php echo $reponse[0];?>" />
                      <input type="submit" value="Choisir" />
                    </form>
                  </td>
                </tr>
        <?php
                 $nb=$nb-1;
              }
        ?>
          </table>
        <?php
        }
        }
      ?>
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
