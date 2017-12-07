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
    <body background="vue/img/fondNEWST.jpg" style="background-repeat:no-repeat;background-size: 100%;">
      <?php
      //var_dump($_POST);
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
      <script type="text/javascript">
      (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
          window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
          window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
          || window[vendors[x]+'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
          var currTime = new Date().getTime();
          var timeToCall = Math.max(0, 16 - (currTime - lastTime));
          var id = window.setTimeout(function() { callback(currTime + timeToCall); },
          timeToCall);
          lastTime = currTime + timeToCall;
          return id;
        };

        if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
          clearTimeout(id);
        };
      }());


      (function() {

        // Get the buttons.
        var startBtn = document.getElementById('button');
        /*var resetBtn = document.getElementById('resetBtn');*/
        // A variable to store the requestID.
        var requestID;
        // Canvas
        var canvas = document.getElementById('canvas');
        // 2d Drawing Context.
        var ctx = canvas.getContext('2d');

        // Variables to for the drawing position and object.
        var posX = 0;
        var W = 246;
        var H = 60;
        var circles = [];

        //Get canvas size
        canvas.width = 246;
        canvas.height = 60;

        // Animate.
        function animate() {
          requestID = requestAnimationFrame(animate);
          //Fill canvas with black color
          //ctx.globalCompositeOperation = "source-over";
          ctx.fillStyle = "rgba(0,0,0,0.15)";
          ctx.fillRect(0, 0, W, H);

          //Fill the canvas with circles
          for(var j = 0; j < circles.length; j++){
            var c = circles[j];

            //Create the circles
            ctx.beginPath();
            ctx.arc(c.x, c.y, c.radius, 0, Math.PI*2, false);
            ctx.fillStyle = "rgba("+c.r+", "+c.g+", "+c.b+", 0.5)";
            ctx.fill();

            c.x += c.vx;
            c.y += c.vy;
            c.radius -= .02;

            if(c.radius < 0)
            circles[j] = new create();
          }



        }

        //Random Circles creator
        function create() {

          //Place the circles at the center

          this.x = W/2;
          this.y = H/2;


          //Random radius between 2 and 6
          this.radius = 2 + Math.random()*3;

          //Random velocities
          this.vx = -5 + Math.random()*10;
          this.vy = -5 + Math.random()*10;

          //Random colors
          this.r = Math.round(Math.random())*255;
          this.g = Math.round(Math.random())*255;
          this.b = Math.round(Math.random())*255;
        }

        for (var i = 0; i < 500; i++) {
          circles.push(new create());
        }

        // Event listener for the start button.
        startBtn.addEventListener('mouseover', function(e) {
          e.preventDefault();

          // Start the animation.
          requestID = requestAnimationFrame(animate);
        });


        // Event listener for the stop button.
        startBtn.addEventListener('mouseout', function(e) {
          e.preventDefault();

          // Stop the animation;
          cancelAnimationFrame(requestID);

          e.preventDefault();

          // Reset the X position to 0.
          posX = 0;

          // Clear the canvas.
          ctx.clearRect(0, 0, canvas.width, canvas.height);

          // Draw the initial box on the canvas.
          ctx.fillRect(posX, 0, boxWidth, canvas.height);

        });
      }());
      </script>

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
