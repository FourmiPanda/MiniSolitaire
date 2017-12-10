<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class CreateAccount{

  private $vue;


  function __construct(){
    $this->vue=new Vue();

  }

  function accueil($bool,$ret){
    $this->vue->afficherAccueil($bool,$ret);
  }


  function create($login,$password){
    $modele = new Modele();
    if(isset($_POST['newLogin'])&&isset($_POST['newPassword'])){

      if(!$modele->exists($_POST['newLogin']) && !empty($_POST['newLogin']) && !empty($_POST['newPassword'])){

        $mdp = crypt($_POST['newPassword'],'');
        $modele->createRow($_POST['newLogin'],$mdp);
        $ret ="Félicitation votre compte est crée !";
        $this->accueil(true,$ret);

      }else{
        $ret = "Nom de compte ou mot de passe invalide";
        $this->accueil(true,$ret);

      }


    }else{
      $ret = "Veuiller remplir tout les champs";
      $this->accueil(true,$ret);


    }

  }



}


?>
