<?php
class Plateau{
  private $plateau = array();
  private $billeSelect = array();
  private $lastMove = array();

  public function __construct(){
    // y->                x
    // [ 1 1 0 0 0 1 1 ] |
    // [ 1 1 0 0 0 1 1 ] V
    // [ 0 0 0 0 0 0 0 ]
    // [ 0 0 0 1 0 0 0 ]
    // [ 0 0 0 0 0 0 0 ]
    // [ 1 1 0 0 0 1 1 ]
    // [ 1 1 0 0 0 1 1 ]
    //matrice[x][y]
    $this->plateau[0] = array(-1,-1,1,1,1,-1,-1);
    $this->plateau[1] = array(-1,-1,1,1,1,-1,-1);
    $this->plateau[2] = array(1,1,1,1,1,1,1);
    $this->plateau[3] = array(1,1,1,1,1,1,1);
    $this->plateau[4] = array(1,1,1,1,1,1,1);
    $this->plateau[5] = array(-1,-1,1,1,1,-1,-1);
    $this->plateau[6] = array(-1,-1,1,1,1,-1,-1);
    // $this->plateau[0] = array(-1,-1,0,0,0,-1,-1);
    // $this->plateau[1] = array(-1,-1,0,0,0,-1,-1);
    // $this->plateau[2] = array(0,0,0,0,0,0,0);
    // $this->plateau[3] = array(0,0,1,1,1,0,0);
    // $this->plateau[4] = array(0,0,0,0,0,0,0);
    // $this->plateau[5] = array(-1,-1,0,0,0,-1,-1);
    // $this->plateau[6] = array(-1,-1,0,0,0,-1,-1);

    $this->billeSelect[0] = false;  // [0] = true si une bille est selectionné
    $this->billeSelect[1] = -1; // [1] coordonnée x de la bille sélectionné
    $this->billeSelect[2] = -1; // [2] coordonnée y de la bille sélectionné

    $this->billeSelect2[0] = false;  // [0] = true si une bille est selectionné
    $this->billeSelect2[1] = -1; // [1] coordonnée x de la bille sélectionné
    $this->billeSelect2[2] = -1; // [2] coordonnée y de la bille sélectionné

    $this->lastMove[0] = false; // True si un déplacement a déjà été fait
    $this->lastMove[1] = -1; // La coordonnée X de la bille dépalcé
    $this->lastMove[2] = -1; // La coordonnée Y de la bille dépalcé
    $this->lastMove[3] = -1; // La coordonnée X de l'arrivé de la bille
    $this->lastMove[4] = -1; // La coordonnée Y de l'arrivée de la bille
    $this->lastMove[5] = -1; // La coordonnée X de la bille supprimée
    $this->lastMove[6] = -1; // La coordonnée Y de la bille supprimée
  }

  //Fonction qui renvoie le numéro correspondant aux coordonnées envoyées
  // -1 : Case interdite
  // 0 : Case vide
  // 1 : Case avec bille
  // -2 : Case qui n'est pas dans le tableau
  public function isCase($x,$y){
    if($x<=6 && $x>=0 && $y<=6 && $y>=0){
      return $this->plateau[$x][$y];
    }else{
      return -2;
    }
  }

  public function selectCase($x,$y){
    if($this->isCase($x,$y)>0 && $this->billeSelect[0]==false){
      $this->billeSelect[0] = true;
      $this->billeSelect[1] = $x;
      $this->billeSelect[2] = $y;
      $this->plateau[$x][$y] = 3;
    }
  }

  public function deSelectCase(){
    $x=$this->billeSelect[1];
    $y=$this->billeSelect[2];
    $this->plateau[$x][$y] = 1;
    $this->billeSelect[0] = false;

  }

  public function getPlateau(){
    return $this->plateau;
  }

  //Fonction qui renvoie true si la case n'est pas interdite
  public function existCase($x1,$y1){
    if($this->isCase($x1,$y1)>=0){
      return true;
    }else{
      return false;
    }
  }

  public function premiereSelection($x,$y){
    if($this->isCase($x,$y)>0){
      $this->plateau[$x][$y] = 0;
      return true;
    }else{
      return false;
    }

  }

  public function reCall(){
    if($this->lastMove[0] == true){
      $this->plateau[$this->lastMove[1]][$this->lastMove[2]] = 1;
      $this->plateau[$this->lastMove[3]][$this->lastMove[4]] = 0;
      $this->plateau[$this->lastMove[5]][$this->lastMove[6]] = 1;
      $this->lastMove[0] = false;


    }
  }
  public function isLastMove(){
    return $this->lastMove[0];
  }


  public function move($x1,$y1){
    //MOUVEMENT GAUCHE
    //MOUVEMENT DROITE
    //MOUVEMENT HAUT
    //MOUVEMENT BAS
    if($this->isCase($x1,$y1)==0){
      if($this->billeSelect[1] == $x1 && $this->billeSelect[2]+2 == $y1 && $this->isCase($x1,$y1-1)==1){

        $this->lastMove[0] = true;
        $this->lastMove[1] = $this->billeSelect[1];
        $this->lastMove[2] = $this->billeSelect[2];
        $this->lastMove[3] = $x1;
        $this->lastMove[4] = $y1;
        $this->lastMove[5] = $x1;
        $this->lastMove[6] = $y1-1;

        $this->plateau[$x1][$y1-1] = 0;
        $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
        $this->plateau[$x1][$y1] = 1;
        $this->billeSelect[0] = false;
        return true;
      }else if($this->billeSelect[1] == $x1 && $this->billeSelect[2]-2 == $y1 && $this->isCase($x1,$y1+1)==1 ){

        $this->lastMove[0] = true;
        $this->lastMove[1] = $this->billeSelect[1];
        $this->lastMove[2] = $this->billeSelect[2];
        $this->lastMove[3] = $x1;
        $this->lastMove[4] = $y1;
        $this->lastMove[5] = $x1;
        $this->lastMove[6] = $y1+1;

        $this->plateau[$x1][$y1+1] = 0;
        $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
        $this->plateau[$x1][$y1] = 1;
        $this->billeSelect[0] = false;
        return true;
      }else if($this->billeSelect[1]-2== $x1 && $this->billeSelect[2] == $y1 && $this->isCase($x1+1,$y1)==1){

        $this->lastMove[0] = true;
        $this->lastMove[1] = $this->billeSelect[1];
        $this->lastMove[2] = $this->billeSelect[2];
        $this->lastMove[3] = $x1;
        $this->lastMove[4] = $y1;
        $this->lastMove[5] = $x1+1;
        $this->lastMove[6] = $y1;

        $this->plateau[$x1+1][$y1] = 0;
        $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
        $this->plateau[$x1][$y1] = 1;
        $this->billeSelect[0] = false;
        return true;
      }else if($this->billeSelect[1]+2 == $x1 && $this->billeSelect[2] == $y1 && $this->isCase($x1-1,$y1)==1){

        $this->lastMove[0] = true;
        $this->lastMove[1] = $this->billeSelect[1];
        $this->lastMove[2] = $this->billeSelect[2];
        $this->lastMove[3] = $x1;
        $this->lastMove[4] = $y1;
        $this->lastMove[5] = $x1-1;
        $this->lastMove[6] = $y1;


        $this->plateau[$x1-1][$y1] = 0;
        $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
        $this->plateau[$x1][$y1] = 1;
        $this->billeSelect[0] = false;
        return true;
      }else{
        $this->deSelectCase($this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ]);
        return false;
      }
    }else{
      $this->deSelectCase($this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ]);
      return false;
    }


  }

  public function getBilleSelect(){
    return $this->billeSelect[0];
  }
  public function getBilleSelectX(){
    return $this->billeSelect[1];
  }
  public function getBilleSelecty(){
    return $this->billeSelect[2];
  }

  public function win(){
    $b = 0;
    foreach($this->plateau as $row){
      foreach($row as $case){
        if($case==1){
          $b++;
        }
      }
    }
    if($b==1){

      return true;
    }else{
      return false;
    }
  }

  public function lose(){
    $bool = true;
    for ($i=0; $i < 7 ; $i++) {
      for ($j=0; $j < 7; $j++) {
        if($this->plateau[$i][$j] == 1){
          if($i-2>=0){
            if($this->plateau[$i-1][$j]==1 && $this->plateau[$i-2][$j]==0){
              $bool=false;
            }
          }
          if($i+2<7){
            if($this->plateau[$i+1][$j]==1 && $this->plateau[$i+2][$j]==0){
              $bool=false;
            }
          }
          if($j-2>=0){
            if($this->plateau[$i][$j-1]==1 && $this->plateau[$i][$j-2]==0){
              $bool=false;
            }
          }
          if($j+2<7){
            if($this->plateau[$i][$j+1]==1 && $this->plateau[$i][$j+2]==0){
              $bool=false;
            }
          }
        }
      }
    }
    return $bool;
  }

}



?>
