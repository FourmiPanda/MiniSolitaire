<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class EnvoieDeCoordo{

private $vue;


function __construct(){
  $this->vue=new Vue();

}

function accueil(){
  $this->vue->afficherAcceuil();
}





function envoyerCoordo(){

}



}


?>
