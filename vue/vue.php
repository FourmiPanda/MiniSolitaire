<?php
require_once PATH_METIER."/Plateau.php";



class Vue{

  function afficherAccueil(){
    //header("Content-type: text/html; charset=utf-8");

    ?>


    <!--VUE DE LOGIN cf GRAPHIC DEVICE INTERFACE-->
    <html>
    <head>

      <meta charset="utf-8" />
      <link rel="stylesheet" href="vue/css/vue.css" />
      <title>Page d'accueil</title>

    </head>
    <body background="vue/img/fondNEWST.jpg" style="background-repeat:no-repeat;background-size: 100%;">
      <?php
      //var_dump($_POST);
      // var_dump($_GET);
      // var_dump($_SESSION);
      ?>
      <div class="login-page">
        <div class="form">
          <form class="register-form" method="post" action="index.php">
            <p class="titreForm">Nouveau compte :</p><br>
            <input name="newLogin" type="text" placeholder="name"/>
            <input name="newPassword" type="password" placeholder="password"/>
            <input type="submit" name="soumettre" value="create"/>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form>
          <form class="login-form"  method="post" action="index.php">
            <p class="titreForm">Connexion :</p><br>
            <input name="login" type="text" placeholder="login"/>
            <input name="password" type="password" placeholder="password"/>
            <input type="submit" name="soumettre" value="Envoyer"/>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </form>
          <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>

          <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
          <script src="vue/js/animLogin.js"></script>
        </div>
      </div>
      <?php
      if(isset($_SESSION['createAuth'])){
        if($_SESSION['createAuth']){
          echo "<center><h4><FONT color='white'>Félicitations votre compte est créé !</FONT></h4></center>";
        }else{
          echo "<center><h4><FONT color='white'>Nom de compte ou mot de passe invalide ( Le mot de passe doit contenir : 1 CHIFFRE , 1 LETTRE , entre 5 et 12 caractères)</FONT></h4></center>";
        }
        unset($_SESSION['createAuth']);
      }
      if(isset($_SESSION['Auth'])){
        if($_SESSION['Auth']){

        }else{
          echo "<center><h4><FONT color='white'>Login ou mot de passe incorrecte</FONT></h4></center>";

        }
        unset($_SESSION['Auth']);
      }

      ?>


    </body>
    </html>
    <?php
  }
  function afficherPlateau(){
    //header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="vue/css/plateau.css" />
      <title>Page de jeu</title>

    </head>
    <body background="vue/img/fondNEWST.jpg" style="background-repeat:no-repeat;background-size: 100%;">

      <!-- <div style="float:left;"><img src="vue/img/logo.png"></div> -->

      <!-- BOUTON DéCO-->

      <div style="float:right;">
        <form method="post" action="index.php">
          <input type="submit" name="soumettre" value="deco"/>
        </form>
      </div>

      <!-- FIN BOUTON Déco-->
      <!--Heure-->
      <FONT color="white"><h1><div id="div_horloge"></div> Bonjour, <?php echo $_SESSION['pseudo'] ?>.</h1></FONT>

      <script type="text/javascript" src="vue/js/animHorloge.js"></script>
      <!-- HEURE -->
      <div class="plateau">

        <!-- AFFICHAGE DU PLATEAU-->

        <table>

          <?php


          for ($j=0; $j < 7; $j++) {
            echo "<tr>";
            for($i = 0;$i<7;$i++){
              if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==1){
                echo "<td><div class='blur'><a method='post' href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/img/bille.png' height='50' width='50' /></a></div></td>\n\t\t";
              }else if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==3){
                echo "<td><div class='select'><img src='vue/img/billeSelect.png' height='50' width='50'/></div></td>\n\t\t";
              }else if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==-1){
                echo "<td><div class='blur'>";
                echo "<img alt='' src='vue/img/caseInterdite.png' height='50' width='50' /></div></td>\n\t\t";
              }else{
                echo "<td><div class='blur'><a href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/img/blanc.png' height='50' width='50' /></a></div></td>\n\t\t";
              }
            }
            echo "</tr>";
          }
          ?>
        </table>
        <!-- FIN AFFICHAGE DU PLATEAU-->


      </div>
      <?php
      if($_SESSION['plateauFlorianIsmael']->isLastMove()){

        echo "<div id='recall'>";
        echo "<form id='recallForm' method='post' action='index.php'>";
        echo "</form>";
        echo "</div>";
        echo "<p>";
        echo "<button id='button' class='BT-OH-BR-R6-NF-FH-FP-TU-PT' type='submit' formmethod='post' name='soumettre' value='reCall' form='recallForm'>";
        echo "<canvas id='canvas'></canvas>";
        echo "<hover></hover>";
        echo "<span style='color:white;'>RETOUR EN ARRIERE</span>";

        echo "</button>";

        echo "</p>";



      }

      ?>


      <!-- Script de l'aspect graphique du bouton retour en arriere -->
      <script type="text/javascript" src="vue/js/animBouton.js"></script>

    </body>
    </html>

    <?php
  }
  public function erreur($type){
    switch ($type) {
      case 'value':
      # code...
      break;

      default:
      # code...
      break;
    }
  }




  public function afficherStat(){
    ?>  <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="vue/css/stat.css" />
      <title>Page de statistiques</title>
      <script src="vue/js/stat.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
      <script type="text/javascript" src="vue/js/apprise.min.js"></script>
      <link rel="stylesheet" href="vue/css/apprise.min.css" type="text/css" />
    </head>
    <body background="vue/img/fondNEWST.jpg" style="background-repeat:no-repeat;background-size: 100%;">
      <script>apprise('GG ! Congratulation',{'animate':true});</script>
      <h1>Vous avez de bonne stats !</h1>
    </body>
    </html>

    <?php
  }

}

?>
