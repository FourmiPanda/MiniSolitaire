<?php
require_once PATH_METIER."/Plateau.php";



class Vue{

  function afficherAccueil($isMsg,$msg){
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
      if($isMsg){
        echo "<div style='color: red;text-align: center;'>".$msg."</div>";
      }

      ?>


    </body>
    </html>
    <?php
  }
  function afficherPlateau($res){
    //header("Content-type: text/html; charset=utf-8");
    ?>
    <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="vue/css/plateau.css" />
      <title>Page de jeu</title>
    </head>
    <body background="vue/img/fondNEWST.jpg" style="background-repeat:no-repeat;background-size: 100%;">

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
      if(isset($res)){
        if(!$res){
          echo "<div class='erreurDeplacement'>Déplacement impossible</div>";
        }
      }
      ?>
      <!-- Script de l'aspect graphique du bouton retour en arriere -->
      <script type="text/javascript" src="vue/js/animBouton.js"></script>
      <!-- Bouton pour reset le plateau -->
      <form id='reset' class="button" action="index.php" method="post">
        <button id='reset' type='submit' formmethod='post' name='soumettre' value='reset' form='reset'>Reset</button>
      </form>
      <!-- Bouton pour abandonner la partie -->
      <form id='abandonner' class="button" action="index.php" method="post">
        <button id='abandonner' type='submit' formmethod='post' name='soumettre' value='abandonner' form='abandonner'>Abandonner</button>
      </form>




    </body>
    </html>

    <?php
  }



  public function afficherStat($tabStats,$resultat,$tabStatsPerso,$tabStatRatio){
    ?>
    <html>
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="vue/css/stat.css" />
      <title>Page de statistiques</title>
      <script type="text/javascript" src="vue/js/apprise.min.js"></script>
      <script src="vue/js/jquery-3.2.1.min.js" type="text/javascript"></script>
      <script src="vue/js/highcharts.js" type="text/javascript"></script>
      <script src="vue/js/jquery.highchartTable-min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="vue/css/apprise.min.css" type="text/css" />

    </head>
    <body background="vue/img/fondNEWST.jpg">
      <?php
      if ($resultat == 1) {
        echo "<script>apprise('GG ! Congratulation',{'animate':true});</script>";
      }else if($resultat == 0){
        echo "<script>apprise('Dommage ! Vous ferez mieux la prochaine fois',{'animate':true});</script>";
      }
      ?>

      <!-- BOUTON DECO -->
      <div style="float:right;">
        <form method="post" action="index.php">
          <input type="submit" name="soumettre" value="deco"/>
        </form>
      </div>
      <!-- FIN BOUTON Déco-->
      <!-- BOUTON RECOMMENCER PARTIE -->
      <div style="float:right;">
        <form id='reset' class="button -regular center" action="index.php" method="post">
          <button id='reset' type='submit' formmethod='post' name='soumettre' value='reset' form='reset'>Recommencer une partie</button>
        </form>
      </div>
      <!-- FIN BOUTON RECOMMENCER PARTIE -->
      <h1 id="title">Statistiques</h1>
      <div class="myStat">

      <div class='tableContainerPerso'>
        <table class="highchart" data-graph-container-before="1" data-graph-type="column" hidden>
          <caption>Vos statistiques</caption>
          <thead>
            <tr>
              <th>statistiques</th>
              <th>score</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Nombres de victoires</td>
              <td><?php echo $tabStatsPerso['NbVictoires'];?></td>
            </tr>
            <tr>
              <td>Nombres de défaites</td>
              <td><?php echo $tabStatsPerso['NbDefaites'];?></td>
            </tr>
            <tr>
              <td>Nombres de parties</td>
              <td><?php echo $tabStatsPerso['NbParties'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class='tableContainerPersoRatio'>
        <table class="highchart" data-graph-container-before="1" data-graph-type="column" hidden>
          <caption>Vos statistiques</caption>
          <thead>
            <tr>
              <th>ratio</th>
              <th>Joueurs</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($tabStatRatio as $row){
              ?>
              <tr>
                <td><?php echo $row['pseudo'];?></td>
                <td><?php  echo $row['ratio'];?></td>
              </tr>
              <?php
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
      <div class='tableContainer'>
        <table class="highchart" data-graph-container-before="1" data-graph-type="column">
          <caption>Ranking : TOP 3</caption>

          <thead>
            <tr>
              <th>ratio</th>
              <th>Joueurs</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $compteur = 0;
            foreach($tabStats as $row){
              ?>
              <tr>
                <td><?php echo $row['pseudo'];?></td>
                <td><?php  echo $row['ratio'];?></td>
              </tr>
              <?php
              $compteur++;
              if($compteur>=3){
                break;
              }
            }

            ?>
          </tbody>
        </table>
      </div>



      <script src="vue/js/stat.js"></script>
    </body>
    </html>

    <?php
  }

}

?>
