<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class EnvoieDeCoordo{

private $vue;


function __construct(){
  $this->vue=new Vue();

}

function accueil(){
  $this->vue->afficherAccueil();
}





function envoyerCoordo($x,$y){
  if($_SESSION['plateau']->billeSelect[0] == true){
    $_SESSION['plateau']->move($x,$y);
    $this->vue->afficherPlateau();
  }else{
    $_SESSION['plateau']->selectCase($x,$y);
    $this->vue->afficherPlateau();
  }


}



}


?>
