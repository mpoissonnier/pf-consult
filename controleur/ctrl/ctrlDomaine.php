<?php
  require_once PATH_VUE."/vueDomaine.php";
  require_once PATH_MODELE."/dao/dao.php";

/* CONTROLEUR DOMAINE : gestion de la recherche */
  class ControleurDomaine {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueDomaine();
      $this->modele = new dao();
    }

    /* Affichage de la page pour rechercher */
    public function domaine($domaine) {
      $this->vue->genereVueDomaine($domaine);
    }

    /* Affichage des specialistes de la recherche */
    public function rechercheSpe($domaine) {
      $listeSpecialistes = $this->modele->rechercheSpe($domaine);
      $this->vue->genereVueRecherche($domaine, $listeSpecialistes);
    }
  }
?>
