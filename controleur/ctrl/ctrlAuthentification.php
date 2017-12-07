<?php
  require_once PATH_VUE."/vueAuthentification.php";

  class ControleurAuthentification {
    private $vue;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueAuthentification();
    }

    /* Fonction permettant l'affichage de la vue d'accueil. */
    public function accueil() {
      $this->vue->genereVueAccueil();
    }

    /* Fonction permettant l'affichage de la vue de la page d'inscription. */
    public function inscription() {
      $this->vue->genereVueInscription();
    }

    /* Fonction permettant l'affichage de la vue de connexion. */
    public function connexion() {
      $this->vue->genereVueConnexion();
    }
  }
?>
