<?php
require_once PATH_VUE."/vue.php";
require PATH_MODELE."/modele.php";


class ControleurAuthentification{

private $vue;


function __construct(){
  $this->vue=new Vue();

}

function accueil(){
  $this->vue->afficherAcceuil();
}





function verificationPseudo(){

  $modele = new Modele();
  if(isset($_POST['login'])&&isset($_POST['password'])){


      if($modele->exists($_POST['login'])){

        $mdp = $modele->getMdp($_POST['login']);
        $passCry = crypt($_POST['password'],$mdp);

        if($mdp==$passCry){

          $this->vue->afficherPlateau();
        }else{
          $this->accueil();
        }
      }else{
        $this->accueil();
      }
  }else{
    $this->accueil();
  }

}



}
