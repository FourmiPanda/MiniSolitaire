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
  header("Content-type: text/html; charset=utf-8");
  ?>
    <html>
    <head>
      <meta charset="utf-8" />
      <title>Page de jeu</title>
    </head>
    <body>
      <h1>Jeu du Solitaire</h1>
      <table>
       <tr>
         <td> </td>
         <td> </td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td> </td>
         <td> </td>
       </tr>
       <tr>
         <td> </td>
         <td> </td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td> </td>
         <td> </td>
       </tr>
       <tr>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
       </tr>
       <tr>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
       </tr>
       <tr>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
       </tr>
       <tr>
         <td> </td>
         <td> </td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td> </td>
         <td> </td>
       </tr>
       <tr>
         <td> </td>
         <td> </td>
         <td>0</td>
         <td>0</td>
         <td>0</td>
         <td> </td>
         <td> </td>
       </tr>
    </table>

    </body>
    </html>

  <?php
}
}

?>
