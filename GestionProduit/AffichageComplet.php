<?php
 session_start();
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Détails du produit</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css"/>
   <link rel="stylesheet" href="../css/AffichageComplet.css"/>
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
     <font size="6" color="white">Fiche téchnique</font>
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
      include '../GestionAcces/DatabaseConnect.php';
      //rédaction de la requte selon la table d'ou provient l'appareil
      if($_POST['table']=='telephone'){
        $requete="select * from telephone where identifiantTel=".$_POST['id'];
        //execution et recuperation des resultats
        $resultat=$connexion->query($requete);
        if(!$resultat){
          $err=true;
        }

        $infos=$resultat->fetch_row();
        //position des images dans la table
        $nb1=24;
        $nb2=25;
        $nb3=26;
        $nb4=27;

        //les autres infos
        $marque=$infos[1];
        $modele=$infos[2] ;
        $prix= $infos[4];
        $garantie=$infos[3] ;
        $description=$infos[6] ;
        $etat=$infos[5];
        $quantite= $infos[23];
        $ram=$infos[20];
        $rom=$infos[21];
        $processeur=$infos[22];
        $NbCamAv=$infos[7];
        $resAv=$infos[8];
        $NbCamAr=$infos[9];
        $resAr=$infos[10];
        $Rec=$infos[11];
        $tailleEc=$infos[13];
        $tRaf=$infos[12];
        $ecTac=$infos[14];
        $wifi=$infos[15];
        $bleut=$infos[16];
        $os=$infos[19];
        $usbType=$infos[18];
        $jack=$infos[17];

      }elseif ($_POST['table']=='pc') {
        $requete="select * from pc where identifiantPc=".$_POST['id'];
        //execution et recuperation des resultats
        $resultat=$connexion->query($requete);
        if(!$resultat){
          $err=true;
        }

        $infos=$resultat->fetch_row();
        //position des images dans la table
        $nb1=28;
        $nb2=29;
        $nb3=30;
        $nb4=31;

        //autres infos
        $marque=$infos[1];
        $modele= $infos[2];
        $prix= $infos[4];
        $garantie= $infos[3];
        $description= $infos[6];
        $etat=$infos[5];
        $quantite= $infos[25];
        $ram=$infos[22];
        $rom=$infos[23];
        $processeur=$infos[24];
        $gr1=$infos[9];
        $gr2=$infos[10];
        $Rec=$infos[11];
        $tailleEc=$infos[13];
        $tRaf=$infos[12];
        $ecTac=$infos[14];
        $resAr=$infos[8];
        $resAv=$infos[7];
        $wifi=$infos[15];
        $bleut=$infos[16];
        $os=$infos[22];
        $vga=$infos[18];
        $Nbusb=$infos[19];
        $usbType=$infos[20];
        $lectcd=$infos[26];
        $hdmi=$infos[27];
        $jack=$infos[17];
        $eth=$infos[21];
      }elseif ($_POST['table']=='ecran') {
        $requete="select * from ecran where identifiantEcran=".$_POST['id'];

        //execution et recuperation des resultats
        $resultat=$connexion->query($requete);
        if(!$resultat){
          $err=true;
        }

        $infos=$resultat->fetch_row();
        //position des images dans la table
        $nb1=15;
        $nb2=16;
        $nb3=17;
        $nb4=18;

        //autres infos
        $marque=$infos[1];
        $modele= $infos[2];
        $prix= $infos[4];
        $garantie= $infos[3];
        $description= $infos[6];
        $etat=$infos[5];
        $quantite= $infos[14];
        $Rec=$infos[7];
        $tRaf=$infos[8];
        $ecTac=$infos[10];
        $vga=$infos[11];
        $Nbusb=$infos[12];
        $usbType=$infos[13];
        $hdmi=$infos[19];
        $tailleEc=$infos[9];
      }elseif ($_POST['table']=='unitecentral') {
        $requete="select * from unitecentral where identifiantUnite=".$_POST['id'];
        //executio et recuperation des resultats
        $resultat=$connexion->query($requete);
        if(!$resultat){
          $err=true;
        }

        $infos=$resultat->fetch_row();
        //position des images dans la table
        $nb1=21;
        $nb2=22;
        $nb3=23;
        $nb4=24;

        //autres infos
        $marque=$infos[1];
        $modele= $infos[2];
        $prix= $infos[4];
        $garantie= $infos[3];
        $description= $infos[6];
        $etat=$infos[5];
        $quantite= $infos[20];
        $ram=$infos[17];
        $rom=$infos[18];
        $processeur=$infos[19];
        $gr1=$infos[7];
        $gr2=$infos[8];
        $wifi=$infos[9];
        $bleut=$infos[10];
        $os=$infos[16];
        $vga=$infos[12];
        $Nbusb=$infos[13];
        $usbType=$infos[14];
        $lectcd=$infos[25];
        $hdmi=$infos[26];
        $jack=$infos[11];
        $eth=$infos[15];
      }elseif ($_POST['table']=='accesoires') {
        $requete="select * from accesoires where identifiantAcc=".$_POST['id'];
        //executio et recuperation des resultats
        $resultat=$connexion->query($requete);
        if(!$resultat){
          $err=true;
        }

        $infos=$resultat->fetch_row();

        $nb1=8;
        $nb2=9;
        $nb3=10;
        $nb4=11;
        $marque=$infos[1];
        $modele= $infos[2];
        $prix= $infos[4];
        $garantie= $infos[3];
        $description= $infos[6];
        $etat=$infos[5];
        $quantite= $infos[7];
      }
   ?>
    <div class="PartieAffichage">
      <div class="partieHaute">
        <div id="defilement">
          <div class="imagesAppareil">
           <img src="<?php echo $infos[$nb1]; ?>" />
           <img src="<?php echo $infos[$nb2]; ?>" />
           <img src="<?php echo $infos[$nb3]; ?>" />
           <img src="<?php echo $infos[$nb4]; ?>" />
          </div>
        </div>
        <div class="infoPrincipal">
          <table>
            <tr>
              <th>Marque</th>
              <td><?php echo $marque; ?></td>
            </tr>
            <tr>
              <th>Modéle</th>
              <td><?php echo $modele; ?></td>
            </tr>
            <tr>
              <th>Etat</th>
              <td><?php echo $etat; ?></td>
            </tr>
            <tr>
              <th>Garantie</th>
              <td><?php echo $garantie; ?></td>
            </tr>
            <tr>
              <th>Prix</th>
              <td><?php echo $prix." DA"; ?></td>
            </tr>
            <tr>
              <th>Disponibilité</th>
              <td><?php if($quantite>0){
                          echo "<p id=\"dispo\">Disponible</p>";
                        }else{
                          echo "<p id=\"Ndispo\">Non disponible</p>";
                        }

                    ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="details">
        <table>
          <?php
            if($_POST['table']=='telephone'){
          ?>
              <tr>
                <th>Ram</th>
                <td><?php echo $ram; ?></td>
              </tr>
              <tr>
                <th>Disque</th>
                <td><?php echo $rom; ?></td>
              </tr>
              <tr>
                <th>Processeur</th>
                <td><?php echo $processeur; ?></td>
              </tr>
              <tr>
                <th>OS</th>
                <td><?php echo $os; ?></td>
              </tr>
              <tr>
                <th>Taille de l'écran</th>
                <td><?php echo $tailleEc; ?></td>
              </tr>
              <tr>
                <th>Taux de rafraichissement</th>
                <td><?php echo $tRaf; ?></td>
              </tr>
              <tr>
                <th>Résolution de l'écran</th>
                <td><?php echo $Rec; ?></td>
              </tr>
              <tr>
                <th>Ecran tactile?</th>
                <td><?php echo $ecTac; ?></td>
              </tr>
              <tr>
                <th>Nombre de caméras frontals</th>
                <td><?php echo $NbCamAv; ?></td>
              </tr>
              <tr>
                <th>Résolution des caméras avant</th>
                <td><?php echo $resAv; ?></td>
              </tr>
              <tr>
                <th>Nombre de caméras arriéres</th>
                <td><?php echo $NbCamAr; ?></td>
              </tr>
              <tr>
                <th>Résolution des caméras arriére</th>
                <td><?php echo $resAr; ?></td>
              </tr>
              <tr>
                <th>Wifi</th>
                <td><?php echo $wifi; ?></td>
              </tr>
              <tr>
                <th>Bleutooth</th>
                <td><?php echo $bleut; ?></td>
              </tr>
              <tr>
                <th>Port Jack?</th>
                <td><?php echo $jack; ?></td>
              </tr>
              <tr>
                <th>Type du port USB</th>
                <td><?php echo $jack; ?></td>
              </tr>
              <tr>
                <th>Description</th>
                <td><?php echo $description; ?></td>
              </tr>
          <?php
            }elseif ($_POST['table']=='pc') {
          ?>
              <tr>
                <th>Ram</th>
                <td><?php echo $ram; ?></td>
              </tr>
              <tr>
                <th>Disque</th>
                <td><?php echo $rom; ?></td>
              </tr>
              <tr>
                <th>Processeur</th>
                <td><?php echo $processeur; ?></td>
              </tr>
              <tr>
                <th>Carte graphique1</th>
                <td><?php echo $gr1; ?></td>
              </tr>
              <tr>
                <th>Carte graphique2</th>
                <td><?php echo $gr2; ?></td>
              </tr>
              <tr>
                <th>OS</th>
                <td><?php echo $os; ?></td>
              </tr>
              <tr>
                <th>Taille de l'écran</th>
                <td><?php echo $tailleEc; ?></td>
              </tr>
              <tr>
                <th>Taux de rafraichissement</th>
                <td><?php echo $tRaf; ?></td>
              </tr>
              <tr>
                <th>Résolution de l'écran</th>
                <td><?php echo $Rec; ?></td>
              </tr>
              <tr>
                <th>Ecran tactile?</th>
                <td><?php echo $ecTac; ?></td>
              </tr>
              <tr>
                <th>Caméra avant</th>
                <td><?php echo $resAv; ?></td>
              </tr>
              <tr>
                <th>Caméras arriére</th>
                <td><?php echo $resAr; ?></td>
              </tr>
              <tr>
                <th>Wifi</th>
                <td><?php echo $wifi; ?></td>
              </tr>
              <tr>
                <th>Bleutooth</th>
                <td><?php echo $bleut; ?></td>
              </tr>
              <tr>
                <th>Nombre de ports USB</th>
                <td><?php echo $Nbusb; ?></td>
              </tr>
              <tr>
                <th>Types de ports USB</th>
                <td><?php echo $usbType; ?></td>
              </tr>
              <tr>
                <th>Port Jack?</th>
                <td><?php echo $jack; ?></td>
              </tr>
              <tr>
                <th>Port Vga?</th>
                <td><?php echo $vga; ?></td>
              </tr>
              <tr>
                <th>Port HDMI?</th>
                <td><?php echo $hdmi; ?></td>
              </tr>
              <tr>
                <th>Lecteur CD?</th>
                <td><?php echo $lectcd; ?></td>
              </tr>
              <tr>
                <th>Port Ethernet?</th>
                <td><?php echo $eth; ?></td>
              </tr>
              <tr>
               <th>Description</th>
               <td><?php echo $description; ?></td>
             </tr>
          <?php
            }elseif ($_POST['table']=='unitecentral') {
          ?>
            <tr>
              <th>Ram</th>
              <td><?php echo $ram; ?></td>
            </tr>
            <tr>
              <th>Disque</th>
              <td><?php echo $rom; ?></td>
            </tr>
            <tr>
              <th>Processeur</th>
              <td><?php echo $processeur; ?></td>
            </tr>
            <tr>
              <th>Carte graphique1</th>
              <td><?php echo $gr1; ?></td>
            </tr>
            <tr>
              <th>Carte graphique2</th>
              <td><?php echo $gr2; ?></td>
            </tr>
            <tr>
              <th>OS</th>
              <td><?php echo $os; ?></td>
            </tr>
            <tr>
              <th>Wifi</th>
              <td><?php echo $wifi; ?></td>
            </tr>
            <tr>
              <th>Bleutooth</th>
              <td><?php echo $bleut; ?></td>
            </tr>
            <tr>
              <th>Nombre de ports USB</th>
              <td><?php echo $Nbusb; ?></td>
            </tr>
            <tr>
              <th>Types de ports USB</th>
              <td><?php echo $usbType; ?></td>
            </tr>
            <tr>
              <th>Port Jack?</th>
              <td><?php echo $jack; ?></td>
            </tr>
            <tr>
              <th>Port Vga?</th>
              <td><?php echo $vga; ?></td>
            </tr>
            <tr>
              <th>Port HDMI?</th>
              <td><?php echo $hdmi; ?></td>
            </tr>
            <tr>
              <th>Lecteur CD?</th>
              <td><?php echo $lectcd; ?></td>
            </tr>
            <tr>
              <th>Port Ethernet?</th>
              <td><?php echo $eth; ?></td>
            </tr>
            <tr>
              <th>Description</th>
              <td><?php echo $description; ?></td>
            </tr>
          <?php
            }elseif ($_POST['table']=='ecran') {
          ?>
            <tr>
              <th>Taille de l'écran</th>
              <td><?php echo $tailleEc; ?></td>
            </tr>
            <tr>
              <th>Taux de rafraichissement</th>
              <td><?php echo $tRaf; ?></td>
            </tr>
            <tr>
              <th>Résolution de l'écran</th>
              <td><?php echo $Rec; ?></td>
            </tr>
            <tr>
              <th>Ecran tactile?</th>
              <td><?php echo $ecTac; ?></td>
            </tr>
            <tr>
              <th>Nombre de ports USB</th>
              <td><?php echo $Nbusb; ?></td>
            </tr>
            <tr>
              <th>Types de ports USB</th>
              <td><?php echo $usbType; ?></td>
            </tr>
            <tr>
              <th>Port Vga?</th>
              <td><?php echo $vga; ?></td>
            </tr>
            <tr>
              <th>Port HDMI?</th>
              <td><?php echo $hdmi; ?></td>
            </tr>
            <tr>
              <th>Description</th>
              <td><?php echo $description; ?></td>
            </tr>
          <?php
            }elseif ($_POST['table']=='accesoires') {
          ?>
              <tr>
                <th>Description</th>
                <td><?php echo $description; ?></td>
              </tr>
          <?php
            }
          ?>
        </table>
      </div>
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
      </div>>
    </footer>
   </div>
 </body>
</html>
