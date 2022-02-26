<?php
  $requete="select * from pieddepage";
  $resultat=$connexion->query($requete);
  if(!$resultat){
    $err=true;
  }
  $nb=$resultat->num_rows;
  if($nb>0){
    $reponse=$resultat->fetch_row();
    $adresses=explode('/',$reponse[0]);
    $numeros=explode('/',$reponse[1]);
    $reseau1=$reponse[2];
    $reseau2=$reponse[3];
    $reseau3=$reponse[4];
  }
?>
