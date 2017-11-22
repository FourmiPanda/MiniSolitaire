<?php
require_once PATH_METIER."/mouvement.php";



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
      var_dump($_COOKIE);

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
      <title>Page de jeu</title>
    </head>
    <body>

      <div style="float:left"><img src="vue/logo.png"></div>

      <!-- BOUTON DéCO-->
      <div style="float:right;">

        <form method="post" action="index.php">
          <input type="submit" name="soumettre" value="deco"/>
        </form>

      </div>
      <!-- FIN BOUTON Déco-->

      <div style="text-align:center;position:abosulute;left:50%;top:50%;">
      <table>
       <tr>
        <?php
          for($i = 0;$i<7;$i++){
            if($_SESSION['plateau']->getCase(0,$i)){
              echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
            }else{
             echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
            }
          }
        ?>

       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){
             if($_SESSION['plateau']->getCase(1,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){
             if($_SESSION['plateau']->getCase(2,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){
             if($_SESSION['plateau']->getCase(3,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){
             if($_SESSION['plateau']->getCase(4,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){
             if($_SESSION['plateau']->getCase(5,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
       <tr>
         <?php
           for($i = 0;$i<7;$i++){

             if($_SESSION['plateau']->getCase(6,$i)){
               echo "<td><img src='vue/bille.jpg' height='42' width='42' /></td>\n\t\t";
             }else{
              echo "<td><img src='vue/blanc.jpg' height='42' width='42'/></td>\n\t\t";
             }
           }
         ?>
       </tr>
    </table>
  </div>

    <h2>Entrée des coordonnées :</h2>
    <form method="post" action="Index.php">
      X1=
      <input name="coordoX1" type="text"/>
      Y1=
      <input name="coordoY1" type="text"/><br>
      DIR ( de 1 à 8 )=
      <input name="coordoDIR" type="text"/>

      <input type="submit" name="coordo" value="Envoyer"/>
    </form>

    </body>
    </html>

  <?php
}
}

?>
