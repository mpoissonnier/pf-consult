<?php
  require_once PATH_VUE."/vueCompte.php";
  require_once PATH_MODELE."/dao/dao.php";

/* CONTROLEUR COMPTE : gestion de la page mon compte et des proches */
  class ControleurCompte   {
    private $vue;
    private $modele;

    /* Constructeur de la classe. */
    public function __construct(){
      $this->vue = new vueCompte();
      $this->modele = new dao();
    }

    /* Affichage de la page du compte */
    public function pageMonCompte() {
      $user = $this->modele->getInfosUser();
      $this->vue->afficherProfil($user[0], $this->modele->getRdv($user[0]->getId()), $this->modele->getProches($user[0]->getId()));
    }

    /* Affichage de la page de reset du mot de passe */
    public function afficherReset() {
      $this->vue->afficherPageReset();
    }

    /* Modification des informations du compte */
    public function modifCompte() {
      // Verification des infos envoyées
      if ($this->modele->checkFormModifications()) {
        // Verification si modification du mot de passe
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

    /* Envoi un nouveau mot de passe */
    public function resetMdp() {
      if ($this->modele->estInscrit($_POST['mail'])) {
        // Creation d'un mot de passe provisoire
        $mot_de_passe = "";
        $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
        $longeur_chaine = strlen($chaine);
        for($i = 1; $i <= 8; $i++) {
            $place_aleatoire = mt_rand(0,($longeur_chaine-1));
            $mot_de_passe .= $chaine[$place_aleatoire];
        }
        // Modification du mot de passe de l'utilisateur dans la bd
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

    /* Ajout d'un proche */
    public function ajoutProche() {
      // Verification des infos envoyées
      if ($this->modele->checkFormProche()) {
        $_SESSION['inscription'] = $this->modele->addProche();
        if ($_SESSION['inscription'] == "ok") {
          $_SESSION['validite'] = "ok";
          $_SESSION['message'] = "Votre proche a bien été inscrit";
        } else {
          $_SESSION['validite'] = "ko";
        }
      } else {
        // Verification incorrecte
        $_SESSION['validite'] = "ko";
      }
      $this->pageMonCompte();
    }

    /* Suppression d'un proche */
    public function suppressionProche() {
      $this->modele->delProche($_GET['suppr']);
      $this->pageMonCompte();
    }

    /* Suppression du compte utilisateur */
    public function suppressionCompte() {
      $this->modele->delUser();
      session_destroy();
    }
  }
?>
