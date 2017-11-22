<?php
  class Plateau{
      private $plateau = array();


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

      }

      //Fonction qui renvoie le numéro correspondant aux coordonnées envoyées
      // -1 : Case interdite
      // 0 : Case vide
      // 1 : Case avec bille
      // -2 : Case qui n'est pas dans le tableau
      public function getCase($x,$y){
        if($x<=6 && $x>=0 && $y<=6 && $y>=0){
          return $this->plateau[$x][$y];
        }else{
          return -2;
        }
      }

      //Fonction qui renvoie true si la case n'est pas interdite
      public function existCase($x1,$y1){
        if($this->getCase($x1,$y1)>=0){
          return true;
        }else{
          return false;
        }
      }

      public function move($x1,$y1,$dir){
        switch ($dir) {
          case 1:
          if($this->existCase($x1,$y1) && $this->existCase($x1-2,$y1) )
            $this->plateau[]
              break;
          case 2:
              echo "i égal 1";
              break;
          case 3:
              echo "i égal 2";
          break;
          case 4:
              echo "i égal 2";
              break;
          case 5:
              echo "i égal 2";
              break;
          case 6:
              echo "i égal 2";
              break;
          case 7:
              echo "i égal 2";
              break;
          case 8:
              echo "i égal 2";
              break;
          default:

        }


      }






  }



 ?>
