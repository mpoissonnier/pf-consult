<?php

// REQUIRE TOUS LES CONTROLEURS
  require_once 'ctrl/ctrlAuthentification.php';
  require_once 'ctrl/ctrlMail.php';
  require_once 'ctrl/ctrlCompte.php';
  require_once 'ctrl/ctrlDomaine.php';


  class Routeur {
    private $ctrlAuthentification;
    private $ctrlMail;
    private $ctrlCompte;
    private $ctrlDomaine;

/** CONSTRUCTEUR DU ROUTEUR **/
    public function __construct() {
      $this->ctrlAuthentification = new ControleurAuthentification();
      $this->ctrlMail = new ControleurMail();
      $this->ctrlCompte = new ControleurCompte();
      $this->ctrlDomaine = new ControleurDomaine();
    }

    public function routerRequete() {
// GESTION PAGES DOMAINES
      if (isset($_GET['domaine'])) {
    // DOMAINE MEDICAL
        if ($_GET['domaine'] == "medical") {
          $this->ctrlDomaine->domaine(1);
          return;
        }
    // DOMAINE JURIDIQUE
        if ($_GET['domaine'] == "juridique") {
          $this->ctrlDomaine->domaine(2);
          return;
        }
      }
// RECHERCHE
      if (isset($_GET['search'])) {
    // DOMAINE MEDICAL
        if ($_GET['search'] == 1) {
          $this->ctrlDomaine->rechercheSpe(1);
          return;
        }
    // DOMAINE JURIDIQUE
        if ($_GET['search'] == 2) {
          $this->ctrlDomaine->rechercheSpe(2);
          return;
        }
      }

// GESTION INSCRIPTION
      if (isset($_GET['inscription'])) {
    // CHARGER PAGE INSCRIPTION
        if ($_GET['inscription'] == "user" || $_GET['inscription'] == "pro") {
          $this->ctrlAuthentification->inscription();
          return;
        }
    // INSCRIPTION UTILISATEUR
        if ($_GET['inscription'] == "1" || $_GET['inscription'] == "2") {
          if ($this->ctrlAuthentification->inscriptionUser($_GET['inscription'])) {
            $this->ctrlMail->envoiMailInscription();
            $this->ctrlAuthentification->accueil();
          }
          return;
        }
      }

// GESTION CONNEXION // DECONNEXION
      if (isset($_GET['connexion'])) {
    // CONNEXION UTILISATEUR
        if ($_GET['connexion'] == 1) {
          $this->ctrlAuthentification->connexionUser();
          return;
        }
    // CHARGE PAGE CONNEXION
        if ($_GET['connexion'] == "") {
          $this->ctrlAuthentification->connexion();
          return;
        }
      }
    // DECONNEXION UTILISATEUR
      if (isset($_GET['deconnexion'])) {
        $this->ctrlAuthentification->deconnexionUser();
        return;
      }

// GESTION COMPTE UTILISATEUR
    // MODIFICATION INFOS PERSONNELLES
      if (isset($_GET['monCompte'])) {
        if ($_GET['monCompte'] == 1) {
          $this->ctrlCompte->modifCompte();
          return;
        }
        $this->ctrlCompte->pageMonCompte();
        return;
      }

    // GESTION DES PROCHES
    if (isset($_GET['proche'])) {
      // AJOUT D'UN PROCHE
      if ($_GET['proche'] == 1) {
        $this->ctrlCompte->ajoutProche();
        return;
      }
      // SUPPRESSION D'UN PROCHE
      if ($_GET['proche'] == 1) {
        $this->ctrlCompte->suppressionProche();
        return;
      }
    }

    // MOT DE PASSE OUBLIE
      if (isset($_GET['reset'])) {
        if ($_GET['reset'] == 1) {
          if ($this->ctrlCompte->resetMdp()) {
            $this->ctrlMail->envoiMailReset($_SESSION['mdpProv']);
          }
          $this->ctrlAuthentification->accueil();
          return;
        }
        $this->ctrlCompte->afficherReset();
        return;
      }

// DEFAULT
      $this->ctrlAuthentification->accueil();
      return;
    }


  }
?>
