<?php
  require_once PATH_VUE."/vueCompte.php";
  require_once PATH_MODELE."/dao/dao.php";

  class ControleurCompte   {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueCompte();
      $this->modele = new dao();
    }

    /* Genere la vue d'accueil de la page du compte */
    public function pageMonCompte() {
      $user = $this->modele->getInfosUser();
      $this->vue->afficherProfil($user[0]);
    }

    public function modifCompte() {
      if (empty($_POST['mdp']) && empty($_POST['mdpConfirm'])) {
        $rep = $this->modele->modifInfosCompte(0);
      } else {
        $rep = $this->modele->modifInfosCompte(1);
      }
      $_SESSION['validite'] = "ok";
      $_SESSION['message'] = "Les modifications ont bien été enregistrées";
      $_SESSION['id'] = $_POST['mail'];
      $this->pageMonCompte();
    }
  }
?>
