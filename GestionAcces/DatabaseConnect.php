<?php
  $err=false;
  $connexion=new mysqli("localhost","root","");

  if(!$connexion){
    $err=true;
  }

  $requete="USE TechStore";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $err=true;
  }
?>
