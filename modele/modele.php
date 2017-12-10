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

  public function createRow($log,$pass){

    try{
      $partJoue = 0;
      $statement = $this->connexion->prepare("INSERT INTO joueurs VALUES (?,?);");
      $statement->bindParam(1, $log);
      $statement->bindParam(2, $pass);

      $statement->execute();

    }
    catch(PDOException $e){
      $this->deconnexion();
      throw new TableAccesException("problème avec les mdp de la table joueurs");
    }catch(TableAccesException $e){
      $this->deconnexion();

    }


  }

  public function partieJoue(){
    try{

      $statement = $this->connexion->prepare("INSERT INTO parties(pseudo,partieGagnee) VALUES (?,?);");
      $statement->bindParam(1, $_SESSION['pseudo']);
      if(isset($_SESSION['victoire'])){
        if($_SESSION['victoire']){
          $res = 1;
        }else{
          $res = 0;
        }
      }
      $statement->bindParam(2, $res);
      $statement->execute();
      return $res;
    }catch(PDOException $e){
      $this->deconnexion();
      throw new TableAccesException("problème avec les mdp de la table parties");
    }catch(TableAccesException $e){
      $this->deconnexion();
      throw new TableAccesException("problème avec les mdp de la table parties");
    }

  }
  public function getRatioUser($pseudo){
    try{
      $requete = "
      SELECT p1.pseudo, Count(p2.pseudo)/(select count(*) from parties where
      pseudo=?) AS ratio
      FROM (
        SELECT DISTINCT pseudo
        FROM parties where pseudo=?
        ) AS p1
        LEFT JOIN (
          SELECT pseudo, partieGagnee
          FROM parties
          WHERE partieGagnee=1 and pseudo=?
          ) AS p2
          ON p2.pseudo = p1.pseudo
          GROUP BY p1.pseudo
          ";
          $statement=$this->connexion->prepare($requete);
          $statement->bindParam(1, $pseudo);
          $statement->bindParam(2, $pseudo);
          $statement->bindParam(3, $pseudo);

          $statement->execute();
          return $statement->fetchAll();
        }
        catch(PDOException $e){
          $this->deconnexion();
          throw new TableAccesException("problème avec les mdp de la table joueurs");
        }catch(TableAccesException $e){
          $this->deconnexion();
        }

      }

      public function getPlayerStats($pseudo){


        try{

          $requete = "
          select count(*) as NbVictoires,
          (select count(*)  from parties p where partieGagnee=0 and p.pseudo=?) as NbDefaites,
          (select count(*) from parties p2 where p2.pseudo = ?)
          as NbParties from parties where partieGagnee=1 and pseudo=?;
          ";
          $statement=$this->connexion->prepare($requete);
          $statement->bindParam(1, $pseudo);
          $statement->bindParam(2, $pseudo);
          $statement->bindParam(3, $pseudo);

          $statement->execute();
          return $statement->fetch();
        }
        catch(PDOException $e){
          $this->deconnexion();
          throw new TableAccesException("problème avec les mdp de la table joueurs");
        }catch(TableAccesException $e){
          $this->deconnexion();

        }


      }

      public function getStats(){

        try{

          $requete = "
          SELECT p1.pseudo, Count(p2.pseudo)/(select count(*) from parties where
          pseudo=p1.pseudo) AS ratio
          FROM (
            SELECT DISTINCT pseudo
            FROM parties
            ) AS p1
            LEFT JOIN (
              SELECT pseudo, partieGagnee
              FROM parties
              WHERE partieGagnee=1
              ) AS p2
              ON p2.pseudo = p1.pseudo
              GROUP BY p1.pseudo
              ORDER BY 2 DESC


              ";
              $statement=$this->connexion->query($requete);
              return $statement->fetchAll();
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
