<?php
require_once PATH_VUE."/vueDomaine.php";

/**
* Controleur de la page d'accueil
*/
class ControleurDomaine {
  private $vue;

  /**
  * Constructeur de la classe initialisant la vue de la page d'accueil.
  */
  public function __construct(){
    $this->vue = new vueDomaine();
  }

  /**
  * Fonction permettant l'affichage de la vue d'accueil.
  */
  public function domaine($domaine) {
    $this->vue->genereVueDomaine($domaine);
  }

}
