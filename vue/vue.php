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
      <script type="text/javascript" src="vue/js/anim.js"></script>
      <link rel="stylesheet" href="vue/css/vue.css" />
      <title>Page d'accueil</title>

    </head>
    <body background="vue/img/fondAccueil.jpg">
      <?php
      var_dump($_POST);
      // var_dump($_GET);
      // var_dump($_SESSION);
      ?>
      <div class="login-page">
        <div class="form">
          <form class="register-form" method="post" action="index.php">
            <p class="">Nouveau compte :</p><br>
            <input name="newLogin" type="text" placeholder="name"/>
            <input name="newPassword" type="password" placeholder="password"/>
            <input type="submit" name="soumettre" value="create"/>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form>
          <form class="login-form"  method="post" action="index.php">
            <p class="">Connexion :</p><br>
            <input name="login" type="text" placeholder="login"/>
            <input name="password" type="password" placeholder="password"/>
            <input type="submit" name="soumettre" value="Envoyer"/>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </form>
          <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script>

          <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
          <script>$('.message a').click(function(){
            $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow");
            $('.register-form').animate({height: "toggle", opacity: "toggle"}, "slow");
          });
          </script>
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
    <body background="vue/img/fond.jpg">

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

      <script type="text/javascript">
      window.onload=function() {
        horloge('div_horloge');
      };

      function horloge(el) {
        if(typeof el=="string") { el = document.getElementById(el); }
        function actualiser() {
          var date = new Date();
          var str = date.getHours();
          str += ':'+(date.getMinutes()<10?'0':'')+date.getMinutes();
          str += ':'+(date.getSeconds()<10?'0':'')+date.getSeconds();
          el.innerHTML = str;
        }
        actualiser();
        setInterval(actualiser,1000);
      }
      </script>
      <!-- HEURE -->
      <center>

        <!-- AFFICHAGE DU PLATEAU-->

        <table>

          <?php


          for ($j=0; $j < 7; $j++) {
            echo "<tr>";
            for($i = 0;$i<7;$i++){
              if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==1){
                echo "<td><div class='blur'><a href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/img/bille.jpg' height='50' width='50' /></a></div></td>\n\t\t";
              }else if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==3){
                echo "<td><div class='select'><img src='vue/img/billeSelect.jpg' height='50' width='50'/></div></td>\n\t\t";
              }else if($_SESSION['plateauFlorianIsmael']->isCase($j,$i)==-1){
                echo "<td><div class='blur'>";
                echo "<img alt='' src='vue/img/caseInterdite.png' height='50' width='50' /></div></td>\n\t\t";
              }else{
                echo "<td><div class='blur'><a href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/img/blanc.jpg' height='50' width='50' /></a></div></td>\n\t\t";
              }
            }
            echo "</tr>";
          }
          ?>
        </table>
        <!-- FIN AFFICHAGE DU PLATEAU-->


      </center>
      <?php
      if($_SESSION['plateauFlorianIsmael']->isLastMove()){

        echo "<div style='float:right;'>";
        echo "<form method='post' action='index.php'>";
        echo "<img alt='recall' src='vue/img/retour.png' height='25' width='25' />";
        echo "<input type='submit' name='soumettre' value='reCall'/>";
        echo "</form>";
        echo "</div>";


      }

      ?>

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
    echo "STATISTIQUES";
  }

}

?>
