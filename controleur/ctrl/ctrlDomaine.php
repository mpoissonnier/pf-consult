<?php
  require_once PATH_VUE."/vueDomaine.php";
  require_once PATH_MODELE."/dao/dao.php";

  class ControleurDomaine {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueDomaine();
      $this->modele = new dao();
    }

    /* Fonction permettant l'affichage de la vue domaine. */
    public function domaine($domaine) {
      $this->vue->genereVueDomaine($domaine);
    }

    /* Fonction permettant l'affichage des specialistes demandes */
    public function rechercheSpe($domaine) {
      $listeSpecialistes = $this->modele->rechercheSpe($domaine);
      $this->vue->genereVueRecherche($domaine, $listeSpecialistes);
    }

}
