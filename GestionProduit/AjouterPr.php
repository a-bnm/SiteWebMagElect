<?php
 session_start();
 include '../GestionAcces/DatabaseConnect.php';
 ?>
<!DOCTYPE html>
<html>
 <head>
   <title>Ajouter un produit</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../css/HeaderFooter2.css">
   <link rel="stylesheet" href="../css/AjouterPr.css">
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
     <font size="6" color="white">Ajout d'
      <?php
        if($_POST['produit']=='telephone'){
            echo"un telephone";
        }elseif ($_POST['produit']=='pc') {
            echo"un pc";
        }elseif ($_POST['produit']=='unitecentral') {
            echo"une unité central";
        }elseif ($_POST['produit']=='ecran') {
            echo"un écran";
        }elseif ($_POST['produit']=='accesoires') {
            echo"un accésoire";
        }

              ?>
     </font>
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
    <div class="formulaire">
      <?php
       if(!isset($_POST['operation'])){
        if($_POST['produit']=='telephone'){
      ?>
         <form  method="post" action="AjouterPr.php?<?php echo session_id();?>" enctype="multipart/form-data">
          <input type="hidden" name="produit" value="telephone"/>
          <input type="hidden" name="operation" value="done"/>
          <select class="marque" name="marque" >
           <option  disabled>Marque</option>
           <option value="Samsung">Samsung</option>
           <option value="Apple">Apple</option>
          </select>
          <input class="modele" type="text" name="modele" placeholder="modéle"/>
          <input class="ram" type="text" name="ram" placeholder="RAM" />
          <input class="rom" type="text" name="rom" placeholder="ROM" />
          <input class="process" type="text" name="processeur" placeholder="Processeur" />
          <input class="NbCamAv" type="text" name="NbCamAv" placeholder="Nombre de caméra Av" />
          <input class="ResoAv" type="text" name="ResolutionAv" placeholder="Résolution des caméras Av" />
          <input class="NbCamAr" type="text" name="NbCamAr" placeholder="Nombre de caméra Ar" />
          <input class="ResoAr" type="text" name="ResolutionAr" placeholder="Résolution des caméras Ar" />
          <input class="ResoEc" type="text" name="ResolutionEc" placeholder="Résolution de l'écran" />
          <input class="TRaf" type="text" name="TRaf" placeholder="Taux de rafraichissement" />
          <input class="TEcra" type="text" name="tailleEc" placeholder="Taille de l'écran" />
          <select class="tact" name="tactile" >
           <option  disabled>Tactile?</option>
           <option value="oui">oui</option>
           <option value="non">non</option>
          </select>
          <input class="Wifi" type="text" name="Wifi" placeholder="Wifi"/>
          <input class="Bleut" type="text" name="Bleut" placeholder="Bleutooth"/>
          <select class="jack" name="jack" >
           <option  disabled>PortJack?</option>
           <option value="oui">oui</option>
           <option value="non">non</option>
          </select>
          <input class="UsbType" type="text" name="UsbType" placeholder="Usb Type" />
          <select class="os" name="OS" >
           <option  disabled>OS</option>
           <option value="Android">Android</option>
           <option value="IOS">IOS</option>
          </select>
          <input class="garantie" type="text" name="Garantie" placeholder="Garantie"/>
          <input class="Prix" type="text" name="Prix" placeholder="Prix" />
          <input class="quantite" type="text" name="quantite" placeholder="Quantite" />
          <select class="etat" name="etat" >
           <option  disabled>Etat</option>
           <option value="neuf">Neuf</option>
           <option value="occasion">Occasion</option>
          </select>
          <textarea class="desc" name="description" placeholder="Description de l'objet"></textarea>
          <input name="Img1" type="file"  class="pic" id="file1"  accept="image/jpeg,jpg"/>
          <div class="conteneur" id="t1">
            <label for="file1" >Importer image1</label>
          </div>
          <input name="Img2" type="file"  class="pic" id="file2"  accept="image/jpeg,jpg"/>
          <div class="conteneur" id="t2">
            <label for="file2" >Importer image2</label>
          </div>
          <input name="Img3" type="file"  class="pic" id="file3"  accept="image/jpeg,jpg"/>
          <div class="conteneur" id="t3">
            <label for="file3" >Importer image3</label>
          </div>
          <input name="Img4" type="file"  class="pic" id="file4"  accept="image/jpeg,jpg"/>
          <div class="conteneur" id="t4">
            <label for="file4" >Importer image4</label>
          </div>
          <input class="btn" type="submit" value="Sauvegrader"/>
         </form>
      <?php
       }elseif ($_POST['produit']=='pc') {
      ?>
         <form  method="post" action="AjouterPr.php?<?php echo session_id();?>" enctype="multipart/form-data">
           <input type="hidden" name="produit" value="pc"/>
           <input type="hidden" name="operation" value="done"/>
           <select class="marque" name="marque" >
             <option  disabled>Marque</option>
             <option value="Samsung">Samsung</option>
             <option value="Apple">Apple</option>
             <option value="Asus">Asus</option>
             <option value="Dell">Dell</option>
             <option value="HP">HP</option>
           </select>
           <input class="modele" type="text" name="modele" placeholder="modéle"/>
           <input class="ram" type="text" name="ram" placeholder="RAM" />
           <input class="rom" type="text" name="rom" placeholder="ROM" />
           <input class="process" type="text" name="processeur" placeholder="Processeur" />
           <input class="carteGr1" type="text" name="carteGr1" placeholder="Carte graphique 1" />
           <input class="carteGr2" type="text" name="carteGr2" placeholder="Carte graphique 2" />
           <input class="ResoAv1" type="text" name="ResolutionAv" placeholder="Résolution des caméras Av" />
           <input class="ResoAr" type="text" name="ResolutionAr" placeholder="Résolution des caméras Ar" />
           <input class="tailleEc" type="text" name="tailleEc" placeholder="Taille de l'écran" />
           <input class="ResoEcPc" type="text" name="ResolutionEc" placeholder="Résolution de l'écran" />
           <input class="TRafPc" type="text" name="TRaf" placeholder="Taux de rafraichissement" />
           <select class="tactPc" name="tactile" >
             <option  disabled>Tactile?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <input class="WifiPc" type="text" name="Wifi" placeholder="Wifi"/>
           <input class="BleutPc" type="text" name="Bleut" placeholder="Bleutooth"/>
           <select class="jackPc" name="jack" >
             <option  disabled>PortJack?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <select class="hdmiPc" name="hdmi" >
             <option  disabled>Port HDMI?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <select class="vgaPc" name="vga" >
             <option  disabled>Port Vga?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <select class="ethPc" name="eth" >
             <option  disabled>Port ethernet?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <select class="cdPc" name="cd" >
             <option  disabled>Lecteur CD?</option>
             <option value="oui">oui</option>
             <option value="non">non</option>
           </select>
           <input class="NbUsbPc" type="text" name="NbUsb" placeholder="Nombre de ports usb" />
           <input class="UsbTypePc" type="text" name="UsbType" placeholder="Usb type" />
           <select class="osPc" name="OS" >
             <option  disabled>OS</option>
             <option value="Windows 11">Windows 11</option>
             <option value="Windows 10">Windows 10</option>
             <option value="Windows 8.1">Windows 8.1</option>
             <option value="Windows 8">Windows 8</option>
             <option value="IOS">Mac OS</option>
           </select>
           <input class="garantiePc" type="text" name="Garantie" placeholder="Garantie"/>
           <input class="PrixPc" type="text" name="Prix" placeholder="Prix" />
           <input class="quantitePc" type="text" name="quantite" placeholder="Quantite" />
           <select class="etatPc" name="etat" >
             <option  disabled>Etat</option>
             <option value="neuf">Neuf</option>
             <option value="occasion">Occasion</option>
           </select>
           <textarea class="descPc" name="description" placeholder="Description de l'objet"></textarea>
           <input name="Img1" type="file"  class="pic" id="file1"  accept="image/jpeg,jpg"/>
           <div class="conteneur" id="p1">
             <label for="file1" >Importer image1</label>
           </div>
           <input name="Img2" type="file"  class="pic" id="file2"  accept="image/jpeg,jpg"/>
           <div class="conteneur" id="p2">
             <label for="file2" >Importer image2</label>
           </div>
           <input name="Img3" type="file"  class="pic" id="file3"  accept="image/jpeg,jpg"/>
           <div class="conteneur" id="p3">
             <label for="file3" >Importer image3</label>
           </div>
           <input name="Img4" type="file"  class="pic" id="file4"  accept="image/jpeg,jpg"/>
           <div class="conteneur" id="p4">
             <label for="file4" >Importer image4</label>
           </div>
           <input class="btn1" type="submit" value="Sauvegrader"/>
         </form>
      <?php
       }elseif ($_POST['produit']=='unitecentral') {
         ?>
            <form  method="post" action="AjouterPr.php?<?php echo session_id();?>" enctype="multipart/form-data">
              <input type="hidden" name="produit" value="unitecentral"/>
              <input type="hidden" name="operation" value="done"/>
              <select class="marque" name="marque" >
                <option  disabled>Marque</option>
                <option value="Samsung">Samsung</option>
                <option value="Apple">Apple</option>
                <option value="Asus">Asus</option>
                <option value="Dell">Dell</option>
                <option value="HP">HP</option>
              </select>
              <input class="modele" type="text" name="modele" placeholder="modéle"/>
              <input class="ram" type="text" name="ram" placeholder="RAM" />
              <input class="rom" type="text" name="rom" placeholder="ROM" />
              <input class="process" type="text" name="processeur" placeholder="Processeur" />
              <input class="carteGr1" type="text" name="carteGr1" placeholder="Carte graphique 1" />
              <input class="carteGr2" type="text" name="carteGr2" placeholder="Carte graphique 2" />
              <input class="Wifi1" type="text" name="Wifi" placeholder="Wifi"/>
              <input class="Bleut1" type="text" name="Bleut" placeholder="Bleutooth"/>
              <select class="jack1" name="jack" >
                <option  disabled>PortJack?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="hdmi1" name="hdmi" >
                <option  disabled>Port HDMI?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="vga1" name="vga" >
                <option  disabled>Port Vga?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="eth1" name="eth" >
                <option  disabled>Port ethernet?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="cd1" name="cd" >
                <option  disabled>Lecteur CD?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <input class="NbUsb1" type="text" name="NbUsb" placeholder="Nombre de ports usb" />
              <input class="UsbType2" type="text" name="UsbType" placeholder="Usb type" />
              <select class="os2" name="OS" >
                <option  disabled>OS</option>
                <option value="Windows 11">Windows 11</option>
                <option value="Windows 10">Windows 10</option>
                <option value="Windows 8.1">Windows 8.1</option>
                <option value="Windows 8">Windows 8</option>
                <option value="IOS">Mac OS</option>
              </select>
              <input class="garantie" type="text" name="Garantie" placeholder="Garantie"/>
              <input class="Prix" type="text" name="Prix" placeholder="Prix" />
              <input class="quantite" type="text" name="quantite" placeholder="Quantite" />
              <select class="etat2" name="etat" >
                <option  disabled>Etat</option>
                <option value="neuf">Neuf</option>
                <option value="occasion">Occasion</option>
              </select>
              <textarea class="desc2" name="description" placeholder="Description de l'objet"></textarea>
              <input name="Img1" type="file"  class="pic" id="file1"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="u1">
                <label for="file1" >Importer image1</label>
              </div>
              <input name="Img2" type="file"  class="pic" id="file2"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="u2">
                <label for="file2" >Importer image2</label>
              </div>
              <input name="Img3" type="file"  class="pic" id="file3"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="u3">
                <label for="file3" >Importer image3</label>
              </div>
              <input name="Img4" type="file"  class="pic" id="file4"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="u4">
                <label for="file4" >Importer image4</label>
              </div>
              <input class="btn2" type="submit" value="Sauvegrader"/>
            </form>
         <?php
       }elseif ($_POST['produit']=='ecran') {
         ?>
            <form  method="post" action="AjouterPr.php?<?php echo session_id();?>" enctype="multipart/form-data">
              <input type="hidden" name="produit" value="ecran"/>
              <input type="hidden" name="operation" value="done"/>
              <select class="marque" name="marque" >
                <option  disabled>Marque</option>
                <option value="Samsung">Samsung</option>
                <option value="Apple">Apple</option>
                <option value="Asus">Asus</option>
                <option value="Dell">Dell</option>
                <option value="HP">HP</option>
              </select>
              <input class="modele" type="text" name="modele" placeholder="modéle"/>
              <input class="tailleEc2" type="text" name="tailleEc" placeholder="Taille de l'écran"/>
              <input class="ResoEc2" type="text" name="ResolutionEc" placeholder="Résolution de l'écran" />
              <input class="TRaf2" type="text" name="TRaf" placeholder="Taux de rafraichissement" />
              <select class="tact2" name="tactile" >
                <option  disabled>Tactile?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="hdmi2" name="hdmi" >
                <option  disabled>Port HDMI?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="rca" name="rca" >
                <option  disabled>Port RCA/YUV?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <select class="vga2" name="Portvga" >
                <option  disabled>Port VGA?</option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <input class="NbUsb3" type="text" name="NbUsb" placeholder="Nombre de ports usb" />
              <input class="UsbType3" type="text" name="UsbType" placeholder="Usb type" />
              <input class="garantie3" type="text" name="Garantie" placeholder="Garantie"/>
              <input class="Prix3" type="text" name="Prix" placeholder="Prix" />
              <input class="quantite3" type="text" name="quantite" placeholder="Quantite" />
              <select class="etat3" name="etat" >
                <option  disabled>Etat</option>
                <option value="neuf">Neuf</option>
                <option value="occasion">Occasion</option>
              </select>
              <textarea class="desc3" name="description" placeholder="Description de l'objet"></textarea>
              <input name="Img1" type="file"  class="pic" id="file1"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="e1">
                <label for="file1" >Importer image1</label>
              </div>
              <input name="Img2" type="file"  class="pic" id="file2"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="e2">
                <label for="file2" >Importer image2</label>
              </div>
              <input name="Img3" type="file"  class="pic" id="file3"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="e3">
                <label for="file3" >Importer image3</label>
              </div>
              <input name="Img4" type="file"  class="pic" id="file4"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="e4">
                <label for="file4" >Importer image4</label>
              </div>
              <input class="btn3" type="submit" value="Sauvegrader"/>
            </form>
         <?php
       }elseif ($_POST['produit']=='accesoires') {
         ?>
            <form  method="post" action="AjouterPr.php?<?php echo session_id();?>" enctype="multipart/form-data">
              <input type="hidden" name="produit" value="accesoires"/>
              <input type="hidden" name="operation" value="done"/>
              <input class="marque4" type="text" name="marque" placeholder="Marque"/>
              <input class="modele4" type="text" name="modele" placeholder="Modéle"/>
              <input class="garantie4" type="text" name="Garantie" placeholder="Garantie"/>
              <input class="Prix4" type="text" name="Prix" placeholder="Prix" />
              <input class="quantite4" type="text" name="quantite" placeholder="Quantite" />
              <select class="etat4" name="etat" >
                <option  disabled>Etat</option>
                <option value="neuf">Neuf</option>
                <option value="occasion">Occasion</option>
              </select>
              <textarea class="desc4" name="description" placeholder="Description de l'objet"></textarea>
              <input name="Img1" type="file"  class="pic" id="file1"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="a1">
                <label for="file1" >Importer image1</label>
              </div>
              <input name="Img2" type="file"  class="pic" id="file2"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="a2">
                <label for="file2" >Importer image2</label>
              </div>
              <input name="Img3" type="file"  class="pic" id="file3"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="a3">
                <label for="file3" >Importer image3</label>
              </div>
              <input name="Img4" type="file"  class="pic" id="file4"  accept="image/jpeg,jpg"/>
              <div class="conteneur" id="a4">
                <label for="file4" >Importer image4</label>
              </div>
              <input class="btn4" type="submit" value="Sauvegrader"/>
            </form>
         <?php
       }
      }else{

         $appareil=$_POST['produit'];
         $marque=$_POST['marque'];
         $modele=$_POST['modele'];
         $prix=$_POST['Prix'];
         $garantie=$_POST['Garantie'];
         $description=$_POST['description'];
         $etat=$_POST['etat'];
         $quantite=$_POST['quantite'];
         /*definit le dossier de destination ou seraont stockés les images des appareils*/
         $destination="../ImageEnregistre/";
         //récupération des information des images
         $nameFile1=$_FILES['Img1']['name'];
         $tempName1=$_FILES['Img1']['tmp_name'];
         $nameFile2=$_FILES['Img2']['name'];
         $tempName2=$_FILES['Img2']['tmp_name'];
         $nameFile3=$_FILES['Img3']['name'];
         $tempName3=$_FILES['Img3']['tmp_name'];
         $nameFile4=$_FILES['Img4']['name'];
         $tempName4=$_FILES['Img4']['tmp_name'];

         if(!move_uploaded_file($tempName1,$destination.$nameFile1)){
           $err=true;
         }

         if(!move_uploaded_file($tempName2,$destination.$nameFile2)){
           $err=true;
         }

         if(!move_uploaded_file($tempName3,$destination.$nameFile3)){
           $err=true;
         }

         if(!move_uploaded_file($tempName4,$destination.$nameFile4)){
           $err=true;
         }
         //récuperation des informations qui ne sont pas en commun
         if($appareil=='pc'){
          $ram=$_POST['ram'];
          $rom=$_POST['rom'];
          $processeur=$_POST['processeur'];
          $gr1=$_POST['carteGr1'];
          $gr2=$_POST['carteGr2'];
          $Rec=$_POST['ResolutionEc'];
          $tailleEc=$_POST['tailleEc'];
          $tRaf=$_POST['TRaf'];
          $ecTac=$_POST['tactile'];
          $resAr=$_POST['ResolutionAr'];
          $resAv=$_POST['ResolutionAv'];
          $wifi=$_POST['Wifi'];
          $bleut=$_POST['Bleut'];
          $os=$_POST['OS'];
          $vga=$_POST['vga'];
          $Nbusb=$_POST['NbUsb'];
          $usbType=$_POST['UsbType'];
          $lectcd=$_POST['cd'];
          $hdmi=$_POST['hdmi'];
          $jack=$_POST['jack'];
          $eth=$_POST['eth'];

          $requete="insert into pc (marque,modele,garantie,prix,etat,description,resolAv,resolAr,cartegr1,cartegr2,
                    resolutionEcran,TxRafraich,taillEcran,tactile,wifi,Bleutooth,Portjack,PortVga,NbPortusb,UsbType,portEth,os,ram,rom,
                    processeur,quantite,Image1,Image2,Image3,Image4) values ('".$marque."','".$modele."','".$garantie."','".$prix."','".$etat."',
                    '".$description."','".$resAv."','".$resAr."','".$gr1."','".$gr2."','".$Rec."','".$tRaf."','".$tailleEc."',
                    '".$ecTac."','".$wifi."','".$bleut."','".$jack."','".$vga."','".$Nbusb."','".$usbType."','".$eth."','".$os."',
                    '".$ram."','".$rom."','".$processeur."','".$quantite."','".$destination.$nameFile1."','".$destination.$nameFile2."','".$destination.$nameFile3."','".$destination.$nameFile4."')";

         }elseif ($appareil=='unitecentral') {
          $ram=$_POST['ram'];
          $rom=$_POST['rom'];
          $processeur=$_POST['processeur'];
          $gr1=$_POST['carteGr1'];
          $gr2=$_POST['carteGr2'];
          $wifi=$_POST['Wifi'];
          $bleut=$_POST['Bleut'];
          $os=$_POST['OS'];
          $vga=$_POST['vga'];
          $Nbusb=$_POST['NbUsb'];
          $usbType=$_POST['UsbType'];
          $lectcd=$_POST['cd'];
          $hdmi=$_POST['hdmi'];
          $jack=$_POST['jack'];
          $eth=$_POST['eth'];

          $requete="insert into unitecentral (marque,modele,garantie,prix,etat,description,cartegr1,cartegr2,
                    wifi,Bleutooth,Portjack,PortVga,NbPortusb,UsbType,portEth,os,ram,rom,processeur,quantite,Image1,Image2,Image3,Image4) values
                    ('".$marque."','".$modele."','".$garantie."','".$prix."','".$etat."',
                    '".$description."','".$gr1."','".$gr2."','".$wifi."','".$bleut."','".$jack."','".$vga."',
                    '".$Nbusb."','".$usbType."','".$eth."','".$os."','".$ram."','".$rom."','".$processeur."','".$quantite."','".$destination.$nameFile1."','".$destination.$nameFile2."','".$destination.$nameFile3."','".$destination.$nameFile4."')";

         }elseif ($appareil=='ecran') {
          $Rec=$_POST['ResolutionEc'];
          $tRaf=$_POST['TRaf'];
          $ecTac=$_POST['tactile'];
          $vga=$_POST['Portvga'];
          $Nbusb=$_POST['NbUsb'];
          $usbType=$_POST['UsbType'];
          $hdmi=$_POST['hdmi'];
          $tailleEc=$_POST['tailleEc'];

          $requete="insert into ecran (marque,modele,garantie,prix,etat,description,resolutionEcran,TxRafraich,taillEcran,tactile,
                    PortVga,NbPortusb,UsbType,quantite,Image1,Image2,Image3,Image4) values ('".$marque."','".$modele."','".$garantie."',
                    '".$prix."','".$etat."','".$description."','".$Rec."','".$tRaf."','".$tailleEc."','".$ecTac."',
                    '".$vga."','".$Nbusb."','".$usbType."','".$quantite."','".$destination.$nameFile1."','".$destination.$nameFile2."','".$destination.$nameFile3."','".$destination.$nameFile4."')";

         }elseif ($appareil=='telephone') {
          $ram=$_POST['ram'];
          $rom=$_POST['rom'];
          $processeur=$_POST['processeur'];
          $NbCamAv=$_POST['NbCamAv'];
          $resAv=$_POST['ResolutionAv'];
          $NbCamAr=$_POST['NbCamAr'];
          $resAr=$_POST['ResolutionAr'];
          $Rec=$_POST['ResolutionEc'];
          $tailleEc=$_POST['tailleEc'];
          $tRaf=$_POST['TRaf'];
          $ecTac=$_POST['tactile'];
          $wifi=$_POST['Wifi'];
          $bleut=$_POST['Bleut'];
          $os=$_POST['OS'];
          $usbType=$_POST['UsbType'];
          $jack=$_POST['jack'];

          $requete="insert into telephone (marque,modele,garantie,prix,etat,description,NbCameraAv,resolAv,NbCameraAr,resolAr,
                    resolutionEcran,TxRafraich,taillEcran,tactile,wifi,Bleutooth,Portjack,UsbType,os,ram,rom,
                    processeur,quantite,Image1,Image2,Image3,Image4) values ('".$marque."','".$modele."','".$garantie."','".$prix."','".$etat."',
                    '".$description."','".$NbCamAv."','".$resAv."','".$NbCamAr."','".$resAr."','".$Rec."','".$tRaf."','".$tailleEc."',
                    '".$ecTac."','".$wifi."','".$bleut."','".$jack."','".$usbType."','".$os."',
                    '".$ram."','".$rom."','".$processeur."','".$quantite."','".$destination.$nameFile1."','".$destination.$nameFile2."','".$destination.$nameFile3."','".$destination.$nameFile4."')";
         }elseif ($appareil=='accesoires') {
           $requete="insert into accesoires (marque,modele,garantie,prix,etat,description,quantite,Image1,Image2,Image3,Image4) values ('".$marque."','".$modele."',
                    '".$garantie."','".$prix."','".$etat."','".$description."','".$quantite."','".$destination.$nameFile1."','".$destination.$nameFile2."','".$destination.$nameFile3."','".$destination.$nameFile4."')";
         }

         $resultat=$connexion->query($requete);
         if(!$resultat){
           $erreur=$connexion->error;
           echo "$erreur";
          $err=true;
         }

       if(!$err){
     ?>
          <div class="reponse">
           <p>Insertion réalisée avec succés</p>
           <img src="../pics/done.png" alt="photo introuvable"/>
           <br/>
           <a href="../Menu/Menu.php?<?php echo session_id();?>">Revenir à la page précedente</a>
         </div>
      <?php
       }else{

      ?>
         <div class="reponse">
          <p class="erreur">Erreur !!</p>
          <img src="../pics/error.png" alt="photo introuvable"/>
          <br/>
          <a class="erreur" href="../Menu/Menu.php?<?php echo session_id();?>">Réessayer?</a>
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
         <div class="txt"><a href='../HeaderFooter/Info.php'>Plus...</a></div>
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
