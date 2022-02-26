<?php
//connexion au serveur
$connexion=new mysqli("localhost","root","");

if($connexion){
  $requete="create database IF NOT EXISTS TechStore";
  $resultat=$connexion->query($requete);

  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la base de donnée ".$m);
  }

  $requete="USE TechStore";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de l'utilisation de la base de donnée ".$m);
  }

  //creration de la table client
  $requete="create table if not exists client(IdentifiantCl int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Email VARCHAR(50),
            nom VARCHAR(30),prenom VARCHAR(30),DateNaiss date ,LieuNaiss VARCHAR(30),Adresse VARCHAR(100),
            Activite VARCHAR(20), MotDePasse VARCHAR(20),tel varchar(15)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table client ".$m);
  }

  //creration de la table historiqueclient
  $requete="create table if not exists HistoriqueClient(IdentifiantCl int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,dateActivite date,
  Action LONGTEXT,constraint fk_client_histo foreign key (IdentifiantCl) references client(IdentifiantCl)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table HistoriqueClient".$m);
  }

  //creation de la table employe
  $requete="create table if not exists employe(IdentifiantEmp int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Email VARCHAR(50),
            nom VARCHAR(30),prenom VARCHAR(30),DateNaiss date ,LieuNaiss VARCHAR(30),Adresse VARCHAR(100),EmployePic varchar(200),
            Poste VARCHAR(20),dateEmbauche date,DiplomeFormation LONGTEXT,Experience LONGTEXT,Salaire Decimal(10,2),MotDePasse VARCHAR(20),tel varchar(15)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table employe ".$m);
  }

  //creation de la table historiqueEmploye
  $requete="create table if not exists HistoriqueEmploye(IdentifiantEmp int(20) NOT NULL PRIMARY KEY,dateActivite date,Action LONGTEXT,
  constraint fk_employe_histo foreign key (IdentifiantEmp) references employe(IdentifiantEmp)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table HistoriqueEmploye".$m);
  }

  //creation de la table Licensiment
  $requete="create table if not exists licensiment(IdentifiantLic int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,nom varchar(30),prenom varchar(30),
  raison varchar(40),Commentaire LONGTEXT ) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table Licensiment".$m);
  }


  //creation de la table retard
  $requete="create table if not exists retard(IdentifiantEmp int(20) NOT NULL PRIMARY KEY,dateret date,duree varchar(10),Commentaire LONGTEXT,
  constraint fk_employe_retard foreign key (IdentifiantEmp) references employe(IdentifiantEmp)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table retard".$m);
  }

  //creation de la table absence
  $requete="create table if not exists Absence(IdentifiantEmp int(20) NOT NULL PRIMARY KEY,dateAbs date,Commentaire LONGTEXT,
  constraint fk_employe_abs foreign key (IdentifiantEmp) references employe(IdentifiantEmp)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table absence".$m);
  }

  //creation de la table conge
  $requete="create table if not exists conge(IdentifiantEmp int(20) NOT NULL PRIMARY KEY,dateDebut date,dateFin date,Commentaire LONGTEXT,
  constraint fk_employe_conge foreign key (IdentifiantEmp) references employe(IdentifiantEmp)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table conge".$m);
  }

  //creation de la table Rendez vous reparation
  $requete="create table if not exists RendezVousReparation(IdentifiantRep int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,Email varchar(80),
  IdentifiantCl int(20),TypeObj varchar(30),marque varchar(40),modele varchar(50),descriptionpanne LONGTEXT,DateRendezvous date,Etat varchar(100),numero varchar(15),
  constraint fk_RnV_client foreign key (IdentifiantCl) references client(IdentifiantCl)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table rendez vous reparation".$m);
  }


  //creation de la table commande spéciales
  $requete="create table if not exists CommandeSpecial(IdentifiantCom int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,Email varchar(80),
  IdentifiantCl int(20),TypeObj varchar(30),marque varchar(40),modele varchar(50),description LONGTEXT,Etat varchar(100),numero varchar(15),
  constraint fk_Commande_client foreign key (IdentifiantCl) references client(IdentifiantCl)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des commandes spéciales".$m);
  }

//creation de la table des telephones
  $requete="create table if not exists telephone (
    IdentifiantTel int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Marque varchar(30),modele varchar(30), garantie varchar(20),
    prix int(8),etat varchar(15),description longtext, nbcameraAv int, resolAv varchar(40),nbcameraAr int,ResolAr varchar(40),
    resolutionEcran varchar(20),TxRafraich VARCHAR(20),taillEcran varchar(15),tactile varchar(3),wifi varchar(20),Bleutooth VARCHAR(20), PortJack varchar(10),
    UsbType varchar(40),Os varchar(20),ram varchar(20), rom varchar(20), processeur varchar(50),quantite int,Image1 varchar(200),Image2 VARCHAR(200),Image3 VARCHAR(200) ,Image4 varchar(200)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des telephones".$m);
  }

  //creation de la table pc
  $requete="create table if not exists pc (
    IdentifiantPc int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Marque varchar(30),modele varchar(30), garantie varchar(20),
    prix int(8),etat varchar(15),description longtext, resolAv varchar(40),ResolAr varchar(40),cartegr1 VARCHAR(50),cartegr2 VARCHAR(50),
    resolutionEcran varchar(20),TxRafraich VARCHAR(20),taillEcran varchar(15),tactile varchar(3),wifi varchar(20),Bleutooth VARCHAR(20), PortJack varchar(10),
    PortVga VARCHAR(3),NbPortusb int ,UsbType varchar(40),portEth varchar(3),Os varchar(20),ram varchar(20), rom varchar(20), processeur varchar(50),quantite int,
    LectCd varchar(3),Hdmi varchar(3),Image1 varchar(200),Image2 VARCHAR(200),Image3 VARCHAR(200) ,Image4 varchar(200)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des pc".$m);
  }

  //creation de la table unite central
  $requete="create table if not exists uniteCentral (
    IdentifiantUnite int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Marque varchar(30),modele varchar(30), garantie varchar(20),
    prix int(8),etat varchar(15),description longtext, cartegr1 VARCHAR(50),cartegr2 VARCHAR(50),wifi varchar(20),Bleutooth VARCHAR(20), PortJack varchar(10),
    PortVga VARCHAR(3),NbPortusb int ,UsbType varchar(40),portEth varchar(3),Os varchar(20),ram varchar(20), rom varchar(20), processeur varchar(50),quantite int,
    Image1 varchar(200),Image2 VARCHAR(200),Image3 VARCHAR(200) ,Image4 varchar(200),LectCd varchar(3),Hdmi varchar(3)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des unités centrals".$m);
  }

  //creation de la table ecran
  $requete="create table if not exists ecran (
    IdentifiantEcran int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Marque varchar(30),modele varchar(30), garantie varchar(20),
    prix int(8),etat varchar(15),description longtext,resolutionEcran varchar(20),TxRafraich VARCHAR(20),taillEcran varchar(15),
    tactile varchar(3),PortVga VARCHAR(3),NbPortusb int ,UsbType varchar(40),quantite int,Image1 varchar(200),Image2 VARCHAR(200),Image3 VARCHAR(200) ,Image4 varchar(200),Hdmi varchar(3)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des ecrans".$m);
  }

  //creation de la table des accesoires
  $requete="create table if not exists accesoires  (
    IdentifiantAcc int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, Marque varchar(30),modele varchar(30), garantie varchar(20),
    prix int(8),etat varchar(15),description longtext,quantite int,Image1 varchar(200),Image2 VARCHAR(200),Image3 VARCHAR(200) ,Image4 varchar(200)) ";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des accesoires".$m);
  }

  //creation de la table des infos du bas de page
  $requete="create table if not exists piedDePage  (
    adresses longtext, numeros longtext,reseau1 longtext,reseau2 longtext,reseau3 longtext)";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table du pied de page".$m);
  }

  //creation de la table des infos des produit s'affichant dans l'acceuil
  $requete="create table if not exists ProduitAcceuil (identifiantAff int primary key,identifiantPr int ,tableSource varchar(50))";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $m=$connexion->error;
    die("Erreur lors de la creation de la table des produit de l'acceuil".$m);
  }
}else{
  die("Erreur connexion au serveur non établi");
}
 echo "done";
?>
