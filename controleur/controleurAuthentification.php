<?php
require_once PATH_VUE."/vue.php";
require PATH_MODELE."/modele.php";


class ControleurAuthentification{

private $vue;


function __construct(){
  $this->vue=new Vue();

}

function accueil(){
  $this->vue->afficherAccueil();
}





function verificationPseudo(){

  $modele = new Modele();
  if(isset($_POST['login'])&&isset($_POST['password'])){


      if($modele->exists($_POST['login'])){

        $mdp = $modele->getMdp($_POST['login']);
        $passCry = crypt($_POST['password'],$mdp);

        if($mdp==$passCry){
          $_SESSION['pseudo'] = $_POST['login'];
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
?>
