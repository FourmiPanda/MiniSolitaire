<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class EnvoieDeCoordo{

  private $vue;
  private $modele;

  function __construct(){
    $this->vue=new Vue();
    $this->modele=new Modele();

  }


  function recall(){
    $_SESSION['plateauFlorianIsmael']->reCall();
    $this->vue->afficherPlateau(true);
  }

  function selectionInvalide(){
    $this->vue->afficherPlateau(true);
  }


  function envoyerCoordo($x,$y){
    if(!isset($_SESSION['choixDebut'])){
      $res = $_SESSION['plateauFlorianIsmael']->premiereSelection($x,$y);
      if($res == true){
        $_SESSION['choixDebut'] = true;
        $this->vue->afficherPlateau(true);
      }else{
        $_SESSION['choixDebut']=false;
      }
    }else if($_SESSION['choixDebut'] == true){

      if($_SESSION['plateauFlorianIsmael']->getBilleSelect() == true){
        $res = $_SESSION['plateauFlorianIsmael']->move($x,$y);
        $_SESSION['victoire'] = $_SESSION['plateauFlorianIsmael']->win();
        $_SESSION['defaite'] = $_SESSION['plateauFlorianIsmael']->lose();
        if($_SESSION['victoire']){
          try{
            $resultat = $this->modele->partieJoue();
            $tableauScore = $this->modele->getStats();
            if(isset($_SESSION['pseudo'])){
              $tabStatsPerso = $this->modele->getPlayerStats($_SESSION['pseudo']);
              $tabRatioPerso = $this->modele->getRatioUser($_SESSION['pseudo']);
              $this->vue->afficherStat($tableauScore,0,$tabStatsPerso,$tabRatioPerso);
            }else{
              $this->vue->afficherStat($tableauScore,$resultat,false,false);
            }
          }catch(TableAccesException $e){
            echo $e;
          }

        }else if($_SESSION['defaite']){
          try{
            $resultat = $this->modele->partieJoue();
            $tableauScore = $this->modele->getStats();
            if(isset($_SESSION['pseudo'])){
              $tabStatsPerso = $this->modele->getPlayerStats($_SESSION['pseudo']);
              $tabRatioPerso = $this->modele->getRatioUser($_SESSION['pseudo']);
              $this->vue->afficherStat($tableauScore,0,$tabStatsPerso,$tabRatioPerso);
            }else{
              $this->vue->afficherStat($tableauScore,$resultat,false,false);
            }
          }catch(TableAccesException $e){
            echo $e;
          }
        }else{
          $this->vue->afficherPlateau($res);
        }


      }else{
        $_SESSION['plateauFlorianIsmael']->selectCase($x,$y);
        $this->vue->afficherPlateau(true);
      }

    }else{
      $res = $_SESSION['plateauFlorianIsmael']->premiereSelection($x,$y);
      if($res == true){
        $_SESSION['choixDebut'] = true;
        $this->vue->afficherPlateau(true);
      }else{
        $_SESSION['choixDebut']=false;
      }
    }
  }
}


?>
