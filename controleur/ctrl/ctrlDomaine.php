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

    /* Fonction permettant l'affichage des specialistes demandes */
    public function rechercheSpe($domaine) {
      // Recupere le specialiste avec sa specialite
      // SELECT civilite, prenom, u.nom, mail, mdp, ddn, tel, adresse, ville, cp, location, s.nom from Utilisateurs u, Sous_Specialite s where type = 2 and u.specialite = s.id


      // TODO Faire la recherche
      $this->vue->genereVueRecherche($domaine);
    }

}
