<?php

require "config/config.php";
require PATH_CONTROLEUR."/routeur.php";

session_start();

$routeur=new Routeur();
$routeur->routerRequete();

?>
