<?php

require_once 'controleurAuthentification.php';


class Routeur {

  private $ctrlAuthentification;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();

  }

  // Traite une requête entrante
  public function routerRequete() {

    if(isset($_POST['soumettre'])){
      if($_POST['soumettre']=="Envoyer"){
          $this->ctrlAuthentification->verificationPseudo();
      }else{
          $this->ctrlAuthentification->accueil();
      }
    }else{
      $this->ctrlAuthentification->accueil();
    }

  }
 }




?>
