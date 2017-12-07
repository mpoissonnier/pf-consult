<?php
require_once PATH_VUE."/vueConnexion.php";

/**
* Controleur de la page de connexion
*/
class ControleurConnexion {
  private $vue;

  /**
  * Constructeur de la classe initialisant la vue de la page de connexion.
  */
  public function __construct(){
    $this->vue = new vueConnexion();
  }

  /**
  * Fonction permettant l'affichage de la vue de connexion.
  */
  public function connexion() {
    $this->vue->genereVueConnexion();
  }

}
