<?php
require_once PATH_VUE."/vueAccueil.php";

/**
* Controleur de la page d'accueil
*/
class ControleurAccueil {
  private $vue;

  /**
  * Constructeur de la classe initialisant la vue de la page d'accueil.
  */
  public function __construct(){
    $this->vue = new vueAccueil();
  }

  /**
  * Fonction permettant l'affichage de la vue d'accueil.
  */
  public function accueil() {
    $this->vue->genereVueAccueil();
  }

}
