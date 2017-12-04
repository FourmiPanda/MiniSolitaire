<?php

require_once 'controleurAuthentification.php';
require_once 'envoieDeCoordo.php';
require_once 'createAccount.php';


class Routeur {

  private $ctrlAuthentification;
  private $envoyerCoordo;
  private $createAccount;



  //Constructeur de la class Routeur qui instancie tout les controleurs
  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->envoyerCoordo=new EnvoieDeCoordo();
    $this->createAccount=new CreateAccount();
  }

  // Traite une requête entrante
  public function routerRequete() {

    if(isset($_POST['soumettre'])){
      if($_POST['soumettre']=="Envoyer"){ //CONNEXION
        $this->ctrlAuthentification->verificationPseudo();
      }else if($_POST['soumettre']=="create"){  //CREATION D'UN COMPTE
        $this->createAccount->create($_POST['newLogin'],$_POST['newPassword']);
      }else if($_POST['soumettre']=="deco"){  //DECONNEXION
        session_destroy();
        $this->ctrlAuthentification->accueil();
      }else if($_POST['soumettre']=="reCall"){
        $this->envoyerCoordo->reCall();
      }else{  //AUTRE RENVOIE A L'ACCUEIL
        $this->ctrlAuthentification->accueil();
      }
    }else if(isset($_GET['x'])&& isset($_GET['y'])){//CAS OU SOUMETTRE N'EST PAS SET DONC DEPLACEMENT DE BILLE
      $this->envoyerCoordo->envoyerCoordo($_GET['x'],$_GET['y']);
    }else{//SINON ON REFRESH LA PAGE
      $this->ctrlAuthentification->accueil();



    }

  }
}




?>
