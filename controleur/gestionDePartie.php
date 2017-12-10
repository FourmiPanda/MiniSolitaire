<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";
require_once PATH_METIER."/Plateau.php";


class GestionDePartie{

  private $vue;
  private $modele;

  function __construct(){
    $this->vue=new Vue();
    $this->modele=new Modele();
  }

  function resetPlateau(){
    $_SESSION['plateauFlorianIsmael'] = new Plateau();
    $_SESSION['choixDebut'] = false;
    $this->vue->afficherPlateau(true);
  }

  function abandonner(){
    $this->modele->partieJoue();
    try {
      $tableauScore = $this->modele->getStats();
      if(isset($_SESSION['pseudo'])){
        $tabStatsPerso = $this->modele->getPlayerStats($_SESSION['pseudo']);
        $tabRatioPerso = $this->modele->getRatioUser($_SESSION['pseudo']);
        $this->vue->afficherStat($tableauScore,0,$tabStatsPerso,$tabRatioPerso);
      }else{
        $this->vue->afficherStat($tableauScore,0,false,false);
      }
    } catch (Exception $e) {
      echo $e;
    }



  }

}


?>
