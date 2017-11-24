<?php
require_once PATH_METIER."/Plateau.php";



class Vue{

function afficherAccueil(){
header("Content-type: text/html; charset=utf-8");

?>


<!--VUE DE LOGIN cf GRAPHIC DEVICE INTERFACE-->
<html>
  <head>

        <meta charset="utf-8" />
        <script type="text/javascript" src="vue/js/anim.js"></script>
        <link rel="stylesheet" href="vue/css/vue.css" />
        <title>Page d'accueil</title>

  </head>
  <body background="vue/img/solitaire.jpg">
    <?php
      // var_dump($_POST);
      // var_dump($_GET);
      // var_dump($_SESSION);
    ?>
    <div class="login-page">
      <div class="form">
        <form class="register-form" method="post" action="index.php">
          <input name="name" type="text" placeholder="name"/>
          <input name="password" type="password" placeholder="password"/>
          <input name="email" type="text" placeholder="email address"/>
            <input type="submit" name="soumettre" value="create"/>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login-form"  method="post" action="index.php">
          <input name="login" type="text" placeholder="login"/>
          <input name="password" type="password" placeholder="password"/>
            <input type="submit" name="soumettre" value="Envoyer"/>
          <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
      </div>
       </div>


  </body>
</html>
<?php
  }
  function afficherPlateau(){

    $plateau = new Plateau();
    if(!isset($_SESSION['plateau'])){
        $_SESSION['plateau'] = $plateau;
    }

  header("Content-type: text/html; charset=utf-8");
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

        <!-- <?php
  for ($j=0; $j < 7; $j++) {
    echo "<tr>";
    for($i = 0;$i<7;$i++){
      if($_SESSION['plateau']->isCase($j,$i)==1){
        echo "<td><img src='vue/img/bille.jpg' height='42' width='42' /></td>\n\t\t";
      }else{
       echo "<td><img src='vue/img/blanc.jpg' height='42' width='42'/></td>\n\t\t";
      }
    }
    echo "</tr>";
  }
 ?> -->

        <?php
          for ($j=0; $j < 7; $j++) {
            echo "<tr>";
            for($i = 0;$i<7;$i++){
              if($_SESSION['plateau']->isCase($j,$i)==1){
                echo "<td><div class='blur'><a href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/img/bille.jpg' height='80' width='80' /></a></div></td>\n\t\t";
              }else if($_SESSION['plateau']->isCase($j,$i)==3){
                echo "<td><div class='select'><img src='vue/img/billeSelect.jpg' height='80' width='80'/></div></td>\n\t\t";
              }else{
                echo "<td><div class='blur'><a href='index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='' src='vue/img/caseInterdite.png' height='80' width='80' /></a></div></td>\n\t\t";
              }
            }
            echo "</tr>";
          }
         ?>
    </table>
    <?php
      // var_dump($_POST);
      // var_dump($_GET);
      // var_dump($_SESSION);
     ?>

    <!-- FIN AFFICHAGE DU PLATEAU-->


  </center>

    </body>
    </html>

  <?php
}
}

?>
