<?php
require_once PATH_METIER."/Plateau.php";



class Vue{

function afficherAcceuil(){
header("Content-type: text/html; charset=utf-8");

?>


<!--VUE DE LOGIN cf GRAPHIC DEVICE INTERFACE-->
<html>
  <head>

        <meta charset="utf-8" />
        <script type="text/javascript" src="vue/anim.js"></script>
        <link rel="stylesheet" href="vue/vue.css" />
        <title>Page d'accueil</title>

  </head>
  <body background="vue/solitaire.jpg">
    <?php
      var_dump($_POST);
      var_dump($_GET);
      var_dump($_SESSION);
    ?>
    <div class="login-page">
      <div class="form">
        <form class="register-form" method="post" action="Index.php">
          <input name="name" type="text" placeholder="name"/>
          <input name="password" type="password" placeholder="password"/>
          <input name="email" type="text" placeholder="email address"/>
            <input type="submit" name="soumettre" value="create"/>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login-form"  method="post" action="Index.php">
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
      <link rel="stylesheet" href="vue/plateau.css" />
      <title>Page de jeu</title>
    </head>
    <body>

      <div style="float:left;"><img src="vue/logo.png"></div>

      <!-- BOUTON DéCO-->

      <div style="float:right;">
        <form method="post" action="Index.php">
          <input type="submit" name="soumettre" value="deco"/>
        </form>
      </div>

      <!-- FIN BOUTON Déco-->
      <!--Heure-->
            <center><h1><div id="div_horloge"></div></h1></center>

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
        echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
      }else{
       echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
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
                echo "<td><div class='blur'><a href='Index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/bille.jpg' height='42' width='42' /></a></div></td>\n\t\t";
              }else if($_SESSION['plateau']->isCase($j,$i)==3){
                echo "<td><div class='select'><img src='vue/billeSelect.jpg' height='42' width='42'/></div></td>\n\t\t";
              }else{
                echo "<td><div class='blur'><a href='Index.php?x=";
                echo $j;
                echo "&y=";
                echo $i;
                echo "'><img alt='bille' src='vue/blanc.jpg' height='42' width='42' /></a></div></td>\n\t\t";
              }
            }
            echo "</tr>";
          }
         ?>
    </table>
    <?php
      var_dump($_POST);
      var_dump($_GET);
      var_dump($_SESSION);
     ?>

    <!-- FIN AFFICHAGE DU PLATEAU AFFICHER UNE FLECHE DE RETOUR ( deselection ) -->


  </center>

    </body>
    </html>

  <?php
}
}

?>
