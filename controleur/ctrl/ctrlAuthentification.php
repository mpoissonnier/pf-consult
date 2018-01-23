<?php
  require_once PATH_VUE."/vueAuthentification.php";
  require_once PATH_MODELE."/dao/dao.php";

  class ControleurAuthentification {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueAuthentification();
      $this->modele = new dao();
    }

    /* Fonction permettant l'affichage de la vue d'accueil. */
    public function accueil() {
      $this->vue->genereVueAccueil();
    }

    /* Fonction permettant l'affichage de la vue de la page d'inscription. */
    public function inscription() {
      $this->vue->genereVueInscription($this->modele->getDomaine(), $this->modele->getSpecialite(), $this->modele->getSousSpecialite());
    }

    /* Fonction permettant l'inscription d'un utilisateur. */
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
          $this->vue->genereVueAccueil();
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

    /* Fonction permettant l'affichage de la vue de connexion. */
    public function connexion() {
      $this->vue->genereVueConnexion();
    }

    /* Fonction permettant la connexion d'un utilisateur. */
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

    /* Fonction permettant la deconnexion d'un utilisateur. */
    public function deconnexionUser() {
      unset($_SESSION['user']);
      session_destroy();
      $this->vue->genereVueAccueil();
    }
  }
?>
