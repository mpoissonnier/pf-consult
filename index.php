<?php
  session_start();
  $_SESSION['inscription']
  
  require_once "config/config.php";
  require_once PATH_CONTROLEUR."/routeur.php";

  $routeur=new Routeur();
  $routeur->routerRequete();

?>
