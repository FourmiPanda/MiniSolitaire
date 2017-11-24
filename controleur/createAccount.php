<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class CreateAccount{

  private $vue;


  function __construct(){
    $this->vue=new Vue();

  }

  function accueil(){
    $this->vue->afficherAccueil();
  }


  function create($login,$password){
    $modele = new Modele();
    if(isset($_POST['newLogin'])&&isset($_POST['newPassword'])){

      if(!$modele->exists($_POST['newLogin']) && !empty($_POST['newLogin'])
        && !preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,12}$/', $_POST['newPassword'])){

        $mdp = crypt($_POST['newPassword'],'');
        $modele->createRow($_POST['newLogin'],$mdp);
        $this->accueil();
        echo "<center><h1><FONT color='white'>Félicitation votre compte est crée !</FONT></h1></center>";

      }else{

        $this->accueil();
        echo "<center><h1><FONT color='white'>Nom de compte ou mot de passe invalide ( Le mot de passe doit contenir : 1 CHIFFRE , 1 LETTRE , entre 5 et 12 caractères)</FONT></h1></center>";

      }


    }else{
      $this->accueil();
      echo "<center><h1><FONT color='white'>Veuiller remplir tout les champs</FONT></h1></center>";


    }

  }



}


?>
