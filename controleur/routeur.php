<?php
  session_start();

// REQUIRE TOUS LES CONTROLEURS
  require_once 'ctrl/ctrlAuthentification.php';
  require_once 'ctrl/ctrlDomaine.php';

  class Routeur {
    private $ctrlAuthentification;
    private $ctrlDomaine;

/** CONSTRUCTEUR DU ROUTEUR **/
    public function __construct() {
      $this->ctrlAuthentification = new ControleurAuthentification();
      $this->ctrlDomaine = new ControleurDomaine();
    }

  // Traite une requête entrante
    public function routerRequete() {
// CHARGER PAGE DOMAINE
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

// CHARGER PAGE INSCRIPTION
      if (isset($_GET['inscription'])) {
        if ($_GET['inscription'] == "user" || $_GET['inscription'] == "pro") {
          $this->ctrlAuthentification->inscription();
          return;
        }
      }
// CHARGE PAGE CONNEXION
      if (isset($_GET['connexion'])) {
        $this->ctrlAuthentification->connexion();
        return;
      }

      // DEFAULT
      $this->ctrlAuthentification->accueil();
      return;
    }


  }
?>
