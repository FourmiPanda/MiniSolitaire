<?php
require_once PATH_METIER."/Plateau.php";


// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Exception relative à un probleme de connexion
class ConnexionException extends MonException{
}

// Exception relative à un probleme d'accès à une table
class TableAccesException extends MonException{
}


// Classe qui gère les accès à la base de données

class Modele{
  private $connexion;


// Constructeur de la classe

  public function __construct(){
   try{


    $chaine="mysql:host=".HOST.";dbname=".BD;
    $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
    $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     }
    catch(PDOException $e){
      $exception=new ConnexionException("problème de connexion à la base");
      throw $exception;
    }
  }




// A développer
// méthode qui permet de se deconnecter de la base
public function deconnexion(){
   $this->connexion=null;
}


//A développer
// utiliser une requête classique
// méthode qui permet de récupérer les pseudos dans la table pseudo
// post-condition:
//retourne un tableau à une dimension qui contient les pseudos.
// si un problème est rencontré, une exception de type TableAccesException est levée

public function getPseudos(){
   try{

  $statement=$this->connexion->query("SELECT pseudo from joueurs;");

  while($ligne=$statement->fetch()){
  $result[]=$ligne['pseudo'];
  }
  return($result);
  }
  catch(PDOException $e){
      throw new TableAccesException("problème avec la table pseudonyme");
    }
  }


  public function exists($pseudo){
  try{
  	$statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
  	$statement->bindParam(1, $pseudoParam);
  	$pseudoParam=$pseudo;
  	$statement->execute();
  	$result=$statement->fetch(PDO::FETCH_ASSOC);

  	if ($result["pseudo"]!=NUll){
  	return true;
  	}
  	else{
  	return false;
  	}
  }
  catch(PDOException $e){
      $this->deconnexion();
      throw new TableAccesException("problème avec la table joueurs");
      }catch(TableAccesException $e){
          $this->deconnexion();

      }
  }
  public function getMdp($pseudo){
    try{
      $statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo=?;");
      $statement->bindParam(1, $pseudoParam);
      $pseudoParam=$pseudo;
      $statement->execute();
      $result=$statement->fetch(PDO::FETCH_ASSOC);


      return $result["motDePasse"];


    }
    catch(PDOException $e){
        $this->deconnexion();
        throw new TableAccesException("problème avec les mdp de la table joueurs");
        }catch(TableAccesException $e){
            $this->deconnexion();

        }

  }





}

?>
