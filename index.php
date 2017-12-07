<?php
  session_start();

  require_once "config/config.php";
  require_once PATH_CONTROLEUR."/routeur.php";

  $routeur = new Routeur();
  $routeur->routerRequete();

?>
