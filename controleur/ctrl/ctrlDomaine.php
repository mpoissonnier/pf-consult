<?php
  require_once PATH_VUE."/vueDomaine.php";

  class ControleurDomaine {
    private $vue;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueDomaine();
    }

    /* Fonction permettant l'affichage de la vue domaine. */
    public function domaine($domaine) {
      $this->vue->genereVueDomaine($domaine);
    }

}
