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


  function recall(){
    $_SESSION['plateauFlorianIsmael']->reCall();
    $this->vue->afficherPlateau();
  }


  function envoyerCoordo($x,$y){
    if(!isset($_SESSION['choixDebut'])){
      $res = $_SESSION['plateauFlorianIsmael']->premiereSelection($x,$y);
      if($res == true){
        $_SESSION['choixDebut'] = true;
        $this->vue->afficherPlateau();
      }else{
        $_SESSION['choixDebut']=false;
      }
    }else if($_SESSION['choixDebut'] == true){

      if($_SESSION['plateauFlorianIsmael']->getBilleSelect() == true){
        $_SESSION['plateauFlorianIsmael']->move($x,$y);
        $_SESSION['victoire'] = $_SESSION['plateauFlorianIsmael']->win();
        if($_SESSION['victoire']){
          try{
            
            $this->vue->afficherStat();
          }catch(TableAccesException $e){
            echo $e;
          }

        }else{
          $this->vue->afficherPlateau();
        }


      }else{
        $_SESSION['plateauFlorianIsmael']->selectCase($x,$y);
        $this->vue->afficherPlateau();
      }

    }else{
      $res = $_SESSION['plateauFlorianIsmael']->premiereSelection($x,$y);
      if($res == true){
        $_SESSION['choixDebut'] = true;
        $this->vue->afficherPlateau();
      }else{
        $_SESSION['choixDebut']=false;
      }
    }
  }
}


?>
