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
      $this->vue->afficherProfil($user[0], $this->modele->getRdv($user[0]->getId()));
    }

    public function modifCompte() {
      if ($this->modele->checkFormModifications()) {
        if (empty($_POST['mdp']) && empty($_POST['mdpConfirm'])) {
          $rep = $this->modele->modifInfosCompte(0);
        } else {
          $rep = $this->modele->modifInfosCompte(1);
        }
        $_SESSION['validite'] = "ok";
        $_SESSION['message'] = "Les modifications ont bien été enregistrées";
        $_SESSION['id'] = $_POST['mail'];
      } else {
        // Verification incorrecte
        $_SESSION['validite'] = "ko";
      }
      $this->pageMonCompte();
    }

    public function afficherReset() {
      $this->vue->afficherPageReset();
    }

    public function resetMdp() {
      if ($this->modele->estInscrit($_POST['mail'])) {
        // creer un mot de passe provisoire
        $mot_de_passe = "";
        $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
        $longeur_chaine = strlen($chaine);
        for($i = 1; $i <= 8; $i++) {
            $place_aleatoire = mt_rand(0,($longeur_chaine-1));
            $mot_de_passe .= $chaine[$place_aleatoire];
        }
        // modifier le mot de passe de l'utilisateur dans la bd
        $this->modele->modifierMdp($mot_de_passe);

        // envoi des messages
        $_SESSION['validite'] = "ok";
        $_SESSION['message'] = "Un mot de passe provisoire vous a été envoyé a l'adresse ". $_POST['mail'];
        $_SESSION['mdpProv'] = $mot_de_passe;
        return true;
      } else {
        $_SESSION['validite'] = "ko";
        $_SESSION['message'] = "L'adresse mail ". $_POST['mail'] . " est inconnue.";
        return false;
      }
    }

    public function ajoutProche() {
      
    }

    public function suppressionProche() {

    }
  }
?>
