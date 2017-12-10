<?php
require_once PATH_VUE."/vue.php";
require PATH_MODELE."/modele.php";
require_once PATH_METIER."/Plateau.php";


class ControleurAuthentification{

  private $vue;


  function __construct(){
    $this->vue=new Vue();

  }

  function accueil($bool,$ret){
    $this->vue->afficherAccueil($bool,$ret);
  }




  function verificationPseudo(){

    $modele = new Modele();
    if(isset($_POST['login'])&&isset($_POST['password'])){


      if($modele->exists($_POST['login'])){

        $mdp = $modele->getMdp($_POST['login']);
        $passCry = crypt($_POST['password'],$mdp);

        if($mdp==$passCry){
          $_SESSION['pseudo'] = $_POST['login'];
          $_SESSION['Auth'] = true;

          $plateau = new Plateau();
          if(!isset($_SESSION['plateauFlorianIsmael'])){
            $_SESSION['plateauFlorianIsmael'] = $plateau;
          }
          if(!isset($_SESSION['victoire'])){
            $_SESSION['victoire'] = false;
          }
          $this->vue->afficherPlateau(true);
        }else{
          $_SESSION['Auth'] = false;
          $this->accueil(true,"Mauvais mot de passe");


        }
      }else{
        $_SESSION['Auth'] = false;
        $this->accueil(true,"Login inexistant");
      }

    }else{
      $_SESSION['Auth'] = false;
      $this->accueil(true,"Veuiller remplir correctement les champs");

    }

  }



}
?>
