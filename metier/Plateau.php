<?php
  class Plateau{
      public $plateau = array();
      public $billeSelect = array();


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
          $this->plateau[3] = array(1,1,1,0,1,1,1);
          $this->plateau[4] = array(1,1,1,1,1,1,1);
          $this->plateau[5] = array(-1,-1,1,1,1,-1,-1);
          $this->plateau[6] = array(-1,-1,1,1,1,-1,-1);
          $this->billeSelect[0] = false;
          $this->billeSelect[1] = -1;
          $this->billeSelect[2] = -1;
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

      //TO-DO ->

      public function move($x1,$y1){
        //MOUVEMENT GAUCHE
        //MOUVEMENT DROITE
        //MOUVEMENT HAUT
        //MOUVEMENT BAS
        if($this->isCase($x1,$y1)==0){
        if($this->billeSelect[1] == $x1 && $this->billeSelect[2] < $y1){
          $this->plateau[$x1][$y1-1] = 0;
          $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
          $this->plateau[$x1][$y1] = 1;
            $this->billeSelect[0] = false;
        }else if($this->billeSelect[1] == $x1 && $this->billeSelect[2] > $y1){
          $this->plateau[$x1][$y1+1] = 0;
          $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
          $this->plateau[$x1][$y1] = 1;
            $this->billeSelect[0] = false;
        }else if($this->billeSelect[1] > $x1 && $this->billeSelect[2] == $y1){
          $this->plateau[$x1+1][$y1] = 0;
          $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
          $this->plateau[$x1][$y1] = 1;
            $this->billeSelect[0] = false;
        }else if($this->billeSelect[1] < $x1 && $this->billeSelect[2] == $y1){
          $this->plateau[$x1-1][$y1] = 0;
          $this->plateau[ $this->billeSelect[1] ][ $this->billeSelect[2] ] = 0;
          $this->plateau[$x1][$y1] = 1;
            $this->billeSelect[0] = false;
        }else{

        }
      }


      }






  }



 ?>
