<?php
  require_once PATH_VUE."/vueAuthentification.php";
  require_once PATH_MODELE."/dao/dao.php";

/* CONTROLEUR AUTHENTIFICATION : gestion de l'inscription, connexion et deonnexion */
  class ControleurAuthentification {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueAuthentification();
      $this->modele = new dao();
    }

    /* Affichage de la vue d'accueil. */
    public function accueil() {
      $this->vue->genereVueAccueil();
    }

    /* Affichage de page d'inscription. */
    public function inscription() {
      $this->vue->genereVueInscription($this->modele->getDomaine(), $this->modele->getSpecialite(), $this->modele->getSousSpecialite());
    }

    /* Affichage de la vue de connexion. */
    public function connexion() {
      $this->vue->genereVueConnexion();
    }

    /* Inscription d'un utilisateur. */
    public function inscriptionUser($categorie) {
      // Verification des infos envoyées
      if ($this->modele->checkFormInscription()) {
        $_SESSION['inscription'] = $this->modele->addUser($categorie);
        if ($_SESSION['inscription'] == "ko") {
          $_SESSION['validite'] = "ko";
          $_SESSION['message'] = "Mail existant";
          if ($categorie == 1) {
            $_GET['inscription'] = "user";
          } else {
            $_GET['inscription'] = "pro";
          }
          $this->inscription();
        } else {
          $_SESSION['validite'] = "ok";
          $_SESSION['message'] = "Vous êtes bien inscrit";
          return true;
        }
      }
      // Verification incorrecte
      $_SESSION['validite'] = "ko";
      if ($categorie == 1) {
        $_GET['inscription'] = "user";
      } else {
        $_GET['inscription'] = "pro";
      }
      $this-> inscription();
    }

    /* Connexion d'un utilisateur. */
    public function connexionUser() {
      $_SESSION['user'] = $this->modele->connexion();
      if ($_SESSION['user'] != "ko") { // connexion réussi
        $_SESSION['id'] = $_POST['login'];
        $_SESSION['validite'] = "ok";
        $_SESSION['message'] = "Bienvenue " . $_SESSION['user'];
        $this->vue->genereVueAccueil();
      } else { // echec connexion
        $_SESSION['validite'] = "ko";
        $_SESSION['message'] = "Combinaison utilisateur/mot de passe incorect";
        $this->connexion();
      }
    }

    /* Deconnexion d'un utilisateur. */
    public function deconnexionUser() {
      unset($_SESSION['user']);
      session_destroy();
      $this->vue->genereVueAccueil();
    }
  }
?>
