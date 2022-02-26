<!DOCTYPE html>
<html>
 <head>
   <title>Inscription</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/HeaderFooter2.css">
   <link rel="stylesheet" href="css/InscriptionEmp.css">
 </head>
 <body>

   <header>

    <div class="titre_page">
     <font size="6" color="white">Inscription de l'admin</font>
    </div>

   </header>

   <?php
    if(!isset($_POST['data'])){
   ?>
    <div class="formulaire">
     <form name="InsCl"  method="post" action="InscriptionAdmin.php" enctype="multipart/form-data">
      <input name="data" type="hidden" value="oui" required/>
      <input class="nom" name="nom" type="text" placeholder="Nom" required/>
      <input class="prenom" name="prenom" type="text" placeholder="Prenom" required/>
      <input class="naiss" name="DateNaiss" type="text" placeholder="Date de naissance" required />
      <input class="lnaiss" name="LieuNaiss" type="text" placeholder="Lieu de naissance" required />
      <TextArea class="adr" name="adresse" placeholder="Aresse" required></TextArea>
      <select class="pst" name="Poste" required>
       <option value="Administarteur" selected >Administarteur</option>
      </select>
      <TextArea class="dplm" name="Diplome" placeholder="Diplome ou formation" required></TextArea>
      <TextArea class="exp" name="experience" placeholder="Experience" required></TextArea>
      <input class="DateEmb" name="DateEmb" type="text" placeholder="Date d'embuache" required/>
      <input class="Salaire" name="Salaire" type="text" placeholder="Salaire" required/>
      <input class="mail" name="Email" type="text" placeholder="Email"required />
      <input class="mdp" name="mdp" type="password" placeholder="Mot de passe"required />
      <input class="mdp1" name="mdp1" type="password" placeholder="Confirmer le mot de passe" required/>
      <input type="file" name="EmpImg" id="file" class="pic" required/>
      <label for="file">Appuyer ici pour ajouter<br/> une image</label>
      <input class="btn" type="submit" value="Confirmer"/>
   </form>
  </div>

  <?php
   }else{
  ?>
    <div class="remplissage">
  <?php
     $err=false;
     $nom=$_POST['nom'];
     $prenom=$_POST['prenom'];
     $naiss=$_POST['DateNaiss'];
     $lnaiss=$_POST['LieuNaiss'];
     $adr=$_POST['adresse'];
     $pst=$_POST['Poste'];
     $mail=$_POST['Email'];
     $mdp=$_POST['mdp'];
     $mdp1=$_POST['mdp1'];
     $Diplome=$_POST['Diplome'];
     $exp=$_POST['experience'];
     $datemb=$_POST['DateEmb'];
     $sal=$_POST['Salaire'];
     $destination="ImageEnregistre/";
     $nameFile=$_FILES['EmpImg']['name'];
     $tempName=$_FILES['EmpImg']['tmp_name'];
     if(!move_uploaded_file($tempName,$destination.$nameFile)){
       echo"Erreur lors de la sauvegarde de l'image.\n";
     }

     $err=false;
     //connexion au serveur
     $connexion=new mysqli("localhost","root","");

     if($connexion){
      $requete="USE TechStore";
      $resultat=$connexion->query($requete);

      if(!$resultat){
        $err=true;
        echo("Erreur lors de l'utilisation de la base de donnée. ");
      }

      //insertion de l'employe
      $requete="insert into employe (Email,nom,prenom,DateNaiss,LieuNaiss,Adresse,Poste,dateEmbauche,DiplomeFormation,Experience,Salaire,MotDePasse,EmployePic)
       values('".$mail."','".$nom."','".$prenom."',".$naiss.",'".$lnaiss."','".$adr."','".$pst."','".$datemb."','".$Diplome."',
       '".$exp."',".$sal.",'".$mdp."','".$destination.$nameFile."')";
      $resultat=$connexion->query($requete);
      if(!$resultat){
        $err=true;
        $m=$connexion->error;
        echo("Erreur lors de l'enregistrement des données.".$m);
      }

   }else{
     $err=true;
     echo("Erreur lors de la connexion à la base de donnée");
    }

   if(!$err){
     echo"Inscription réalisé avec succés";
  ?>
    <br/>
    <img src="pics/done.png" alt="photo introuvable"/>
    <br/>
    <a href="index.php">Revenir à l'acceuil</a>
  <?php
   }else{
     $_POST['data']=null;

   ?>
   <br/>
   <img src="pics/error.png" alt="photo introuvable"/>
   <br/>
    <a href="InscriptionAdmin.php">Réessayer</a>
   <?php
   }
  ?>

  </div>
  <?php } ?>


  <footer>

  </footer>

 </body>
</html>
