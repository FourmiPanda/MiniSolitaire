<?php

require_once 'controleurAuthentification.php';
require_once 'envoieDeCoordo.php';


class Routeur {

  private $ctrlAuthentification;
  private $envoyerCoordo;




  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->envoyerCoordo=new EnvoieDeCoordo();
  }

  // Traite une requête entrante
  public function routerRequete() {

    if(isset($_POST['soumettre'])){
      if($_POST['soumettre']=="Envoyer"){
          $this->ctrlAuthentification->verificationPseudo();
      }else if($_POST['soumettre']=="deco"){
        session_destroy();
        $this->ctrlAuthentification->accueil();
      }else{
          $this->ctrlAuthentification->accueil();
      }
    }else if(isset($_GET['x'])&& isset($_GET['y'])){
        $this->envoyerCoordo->envoyerCoordo($_GET['x'],$_GET['y']);
    }else{
      $this->ctrlAuthentification->accueil();
    }

  }
 }




?>
