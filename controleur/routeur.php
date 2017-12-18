<?php

// REQUIRE TOUS LES CONTROLEURS
  require_once 'ctrl/ctrlAuthentification.php';
  require_once 'ctrl/ctrlCompte.php';
  require_once 'ctrl/ctrlDomaine.php';

  class Routeur {
    private $ctrlAuthentification;
    private $ctrlCompte;
    private $ctrlDomaine;

/** CONSTRUCTEUR DU ROUTEUR **/
    public function __construct() {
      $this->ctrlAuthentification = new ControleurAuthentification();
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
// GESTION INSCRIPTION
      if (isset($_GET['inscription'])) {
    // CHARGER PAGE INSCRIPTION
        if ($_GET['inscription'] == "user" || $_GET['inscription'] == "pro") {
          $this->ctrlAuthentification->inscription();
          return;
        }
    // INSCRIPTION UTILISATEUR
        if ($_GET['inscription'] == "1" || $_GET['inscription'] == "2") {
          $this->ctrlAuthentification->inscriptionUser($_GET['inscription']);
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
      if (isset($_GET['monCompte'])) {
        $this->ctrlCompte->pageMonCompte();
        return;
      }


// DEFAULT
      $this->ctrlAuthentification->accueil();
      return;
    }


  }
?>
