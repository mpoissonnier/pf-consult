<?php
  require_once PATH_VUE."/vueCompte.php";
  require_once PATH_MODELE."/dao/daoUtilisateur.php";

  class ControleurCompte   {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueCompte();
      $this->modele = new daoUtilisateur();
    }

    /* Genere la vue d'accueil de la page du compte */
    public function pageMonCompte() {
      $user = $this->modele->getInfosUser();
      $this->vue->afficherProfil($user[0]);
    }

    public function modifCompte() {
      $rep = $this->modele->modifInfosCompte();
      $_SESSION['id'] = $_POST['mail'];
      $this->pageMonCompte();
    }
  }
?>
