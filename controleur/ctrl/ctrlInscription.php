<?php
require_once PATH_VUE."/vueInscription.php";

/**
* Controleur de la page d'accueil
*/
class ControleurInscription {
  private $vue;

  /**
  * Constructeur de la classe initialisant la vue de la page d'inscription.
  */
  public function __construct(){
    $this->vue = new vueInscription();
  }

  /**
  * Fonction permettant l'affichage de la vue de la page d'inscription.
  */
  public function inscription() {
    $this->vue->genereVueInscription();
  }

}
