<?php
  session_start();

// REQUIRE TOUS LES CONTROLEURS
  require_once 'ctrl/ctrlAccueil.php';
  require_once 'ctrl/ctrlDomaine.php';
  require_once 'ctrl/ctrlConnexion.php';
  require_once 'ctrl/ctrlInscription.php';

  class Routeur {
    private $ctrlAccueil;
    private $ctrlDomaine;
    private $ctrlConnexion;
    private $ctrlInscription;


/** CONSTRUCTEUR DU ROUTEUR **/
    public function __construct() {
      $this->ctrlAccueil = new ControleurAccueil();
      $this->ctrlDomaine = new ControleurDomaine();
      $this->ctrlConnexion = new ControleurConnexion();
      $this->ctrlInscription = new ControleurInscription();
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
      if (isset($_GET['inscription']) && $_GET['inscription'] == "ok") {
        if ($_GET['type'] == "user" || $_GET['type'] == "pro") {
          $this->ctrlInscription->inscription();
          return;
        }
      }
// CHARGE PAGE CONNEXION  
      if (isset($_GET['connexion']) && $_GET['connexion'] == "ok") {
        $this->ctrlConnexion->connexion();
        return;
      }

      // DEFAULT
      $this->ctrlAccueil->accueil();
      return;
    }


  }
?>
