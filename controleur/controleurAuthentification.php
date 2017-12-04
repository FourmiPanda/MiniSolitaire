<?php
require_once PATH_VUE."/vue.php";
require PATH_MODELE."/modele.php";
require_once PATH_METIER."/Plateau.php";


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
          $_SESSION['Auth'] = true;

          $plateau = new Plateau();
          if(!isset($_SESSION['plateauFlorianIsmael'])){
            $_SESSION['plateauFlorianIsmael'] = $plateau;
          }
          if(!isset($_SESSION['victoire'])){
            $_SESSION['victoire'] = false;
          }



          $this->vue->afficherPlateau();
        }else{
          $_SESSION['Auth'] = false;
          $this->accueil();


        }
      }else{
        $_SESSION['Auth'] = false;
        $this->accueil();
      }

    }else{
      $_SESSION['Auth'] = false;
      $this->accueil();

    }

  }



}
?>
