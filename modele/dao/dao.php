<?php

  require_once PATH_MODELE."/bean/Utilisateur.php";

   class dao {
    private $connexion;

///////// BASE DE DONNEES
    /* Constucteur de la classe, se connecte à la base de données */
    public function __construct(){
      try {
        $chaine = "mysql:host=".HOST.";dbname=".BD.";charset=UTF8";
        $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
        $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        throw new PDOException("Erreur de connexion");
      }
    }

    /* Methode qui permet de se deconnecter de la base */
    public function destroy(){
      $this->connexion = NULL;
    }
/////////
///////// CHECK
    /* Méthode qui permet de voir si un utilisateur est deja inscrit */
    public function estInscrit($mail){
      try {
        $stmt = $this->connexion->prepare("select * from Utilisateurs where mail = ?;");
        $stmt->bindParam(1,$mail);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($result["mail"] != NUll) {
          return true;
        } else {
          return false;
        }
      } catch(PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    /* Méthode qui permet de vérifier le mot de passe */
    public function checkMdp($mail, $mdp) {
      try {
        if ($this->estInscrit($mail)) {
          $stmt = $this->connexion->prepare("select * from Utilisateurs where mail = ?;");
          $stmt->bindParam(1,$mail);
          $stmt->execute();
          $mdpUtilisateur = $stmt->fetch();
          $mdpUser = $mdpUtilisateur["mdp"];
          if (crypt($mdp, $mdpUser) == $mdpUser) {
            return true;
          } else {
            return false;
          }
        }
      } catch(PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    public function connexion() {
      try {
        if ($this->checkMdp($_POST['login'],$_POST['mdp'])) {
          $stmt = $this->connexion->prepare('select * from Utilisateurs where mail = ?;');
          $stmt->bindParam(1,$_POST['login']);
          $stmt->execute();
          $tabResult = $stmt->fetch();
          if ($tabResult != NULL) {
            return (ucfirst(strtolower($tabResult['prenom'])) . " " . $tabResult['nom']);
          }
        }
          return "ko";
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    public function checkFormInscription() {
      // Verification civilite
      if (!isset($_POST['civilite']) || ($_POST['civilite'] != "M." && $_POST['civilite'] != "Mme" && $_POST['civilite'] != "Autre")) {
        $_SESSION['message'] = "Champ civilite incorrect";
        return false;
      }

      // Verification prenom
      if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 25 ) {
        $_SESSION['message'] = "Champ prénom incorrect";
        return false;
      }
      $_POST['prenom'] = htmlspecialchars($_POST['prenom']);

      // Verification nom
      if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 25 ) {
        $_SESSION['message'] = "Champ nom incorrect";
        return false;
      }
      $_POST['nom'] = htmlspecialchars($_POST['nom']);

      // Verification adresse
      if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 50 ) {
        $_SESSION['message'] = "Champ adresse incorrect";
        return false;
      }
      $_POST['adresse'] = htmlspecialchars($_POST['adresse']);


      // Verification ville
      if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 50 ) {
        $_SESSION['message'] = "Champ ville incorrect";
        return false;
      }
      $_POST['ville'] = htmlspecialchars($_POST['ville']);

      // Verification mail
      if (!isset($_POST['mail']) || !preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/", $_POST['mail'])) {
        $_SESSION['message'] = "Champ mail incorrect";
        return false;
      }
      $_POST['mail'] = htmlspecialchars($_POST['mail']);

      // Verification mot de passe
      if (isset($_POST['mdp']) && isset($_POST['MdpConfirm'])) {
        if ($_POST['mdp'] == $_POST['MdpConfirm']) {
          if (strlen($_POST['mdp']) > 5 && strlen($_POST['mdp']) < 25) {
            // mot de passe correct
          } else {
            $_SESSION['message'] = "Le mot de passe doit comporter entre 5 et 25 caractères";
            return false;
          }
        } else {
          $_SESSION['message'] = "Les mots de passe doivent être égaux";
          return false;
        }
      } else {
        $_SESSION['message'] = "Les deux champs mots de passe doivent être complétés";
        return false;
      }

      // Verification date de naissance
      if (!isset($_POST['ddn']) || $_POST['ddn'] == "") {
        // Champ sous la forme aaaa-mm-jj
        if (preg_match("/^[0-9]{4}-[01-12]-[01-31]$/",$_POST['ddn'])) {
          list($year, $month, $day) = split('[/.-]', $_POST['ddn']);
          if ($year < date(Y)-100) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
          if ($year >= date(Y) && $month >= date(m) && $day >= date(d)) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
        } else
        // Champ sous la forme jj/mm/aaaa
        if (preg_match("/^[0-31][/|.|-][01-12][/|.|-][0-9]{4}$/",$_POST['ddn'])) {
          list($day, $month, $year) = split('[/.-]', $_POST['ddn']);
          if ($year < date(Y)-100) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
          if ($year >= date(Y) && $month >= date(m) && $day >= date(d)) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
        }
        $_SESSION['message'] = "Veuillez completer votre date de naissance";
        return false;
      }
      $_POST['ddn'] = htmlspecialchars($_POST['ddn']);

      // Verification n° de tel
      if (!isset($_POST['tel']) || !preg_match("/^0[1-9]([-. ]?[0-9]{2}){4}$/", $_POST['tel'])) {
        $_SESSION['message'] = "Numéro de téléphone incorrect";
        return false;
      }
      $_POST['tel'] = htmlspecialchars($_POST['tel']);

      // Verification du code postal
      if (!isset($_POST['cp']) || !preg_match("/^[0-9]{5,5}$/", $_POST['cp'])) {
        $_SESSION['message'] = "Code Postal incorrect";
        return false;
      }
      $_POST['cp'] = htmlspecialchars($_POST['cp']);

      // Vérification complétion du champ coordonnées
      if (!isset($_POST['location']) || $_POST['location'] == "") {
        $_SESSION['message'] = "Votre adresse n'a pas pu être géolocalisée";
        return false;
      }
      $_POST['location'] = htmlspecialchars(substr($_POST['location'], 1, -1));

      // Verification spécialité (si autre)
      if ($_GET['inscription'] == "2" && $_POST['sous_specialite'] == "autre") {
        if (!isset($_POST['newSpe'])) {
          $_SESSION['message'] = "Spécialité incorrect";
          return false;
        }
        $_POST['newSpe'] = htmlspecialchars($_POST['newSpe']);
      }
      return true;
    }

    public function checkFormModifications() {
      // Verification civilite
      if (!isset($_POST['civilite']) || ($_POST['civilite'] != "M." && $_POST['civilite'] != "Mme" && $_POST['civilite'] != "Autre")) {
        $_SESSION['message'] = "Champ civilite incorrect";
        return false;
      }

      // Verification prenom
      if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 25 ) {
        $_SESSION['message'] = "Champ prénom incorrect";
        return false;
      }
      $_POST['prenom'] = htmlspecialchars($_POST['prenom']);

      // Verification nom
      if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 25 ) {
        $_SESSION['message'] = "Champ nom incorrect";
        return false;
      }
      $_POST['nom'] = htmlspecialchars($_POST['nom']);

      // Verification adresse
      if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 50 ) {
        $_SESSION['message'] = "Champ adresse incorrect";
        return false;
      }
      $_POST['adresse'] = htmlspecialchars($_POST['adresse']);


      // Verification ville
      if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 50 ) {
        $_SESSION['message'] = "Champ ville incorrect";
        return false;
      }
      $_POST['ville'] = htmlspecialchars($_POST['ville']);

      // Verification mail
      if (!isset($_POST['mail']) || !preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/", $_POST['mail'])) {
        $_SESSION['message'] = "Champ mail incorrect";
        return false;
      }
      $_POST['mail'] = htmlspecialchars($_POST['mail']);

      // Verification mot de passe
      if (!isset($_POST['mdp']) && !isset($_POST['MdpConfirm'])) {
        if ($_POST['mdp'] == $_POST['MdpConfirm']) {
          if (strlen($_POST['mdp']) > 5 && strlen($_POST['mdp']) < 25) {
            // mot de passe correct
          } else {
            $_SESSION['message'] = "Le mot de passe doit comporter entre 5 et 25 caractères";
            return false;
          }
        } else {
          $_SESSION['message'] = "Les mots de passe doivent être égaux";
          return false;
        }
      }

      // Verification date de naissance
      if (!isset($_POST['ddn']) || $_POST['ddn'] == "") {
        // Champ sous la forme aaaa-mm-jj
        if (preg_match("/^[0-9]{4}-[01-12]-[01-31]$/",$_POST['ddn'])) {
          list($year, $month, $day) = split('[/.-]', $_POST['ddn']);
          if ($year < date(Y)-100) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
          if ($year >= date(Y) && $month >= date(m) && $day >= date(d)) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
        } else
        // Champ sous la forme jj/mm/aaaa
        if (preg_match("/^[0-31][/|.|-][01-12][/|.|-][0-9]{4}$/",$_POST['ddn'])) {
          list($day, $month, $year) = split('[/.-]', $_POST['ddn']);
          if ($year < date(Y)-100) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
          if ($year >= date(Y) && $month >= date(m) && $day >= date(d)) {
            $_SESSION['message'] = "Veuillez entre une date valide";
            return false;
          }
        }
        $_SESSION['message'] = "Veuillez completer votre date de naissance";
        return false;
      }
      $_POST['ddn'] = htmlspecialchars($_POST['ddn']);

      // Verification n° de tel
      if (!isset($_POST['tel']) || !preg_match("/^0[1-9]([-. ]?[0-9]{2}){4}$/", $_POST['tel'])) {
        $_SESSION['message'] = "Numéro de téléphone incorrect";
        return false;
      }
      $_POST['tel'] = htmlspecialchars($_POST['tel']);

      // Verification du code postal
      if (!isset($_POST['cp']) || !preg_match("/^[0-9]{5,5}$/", $_POST['cp'])) {
        $_SESSION['message'] = "Code Postal incorrect";
        return false;
      }
      $_POST['cp'] = htmlspecialchars($_POST['cp']);

      // Vérification complétion du champ coordonnées
      if (!isset($_POST['location']) || $_POST['location'] == "") {
        $_SESSION['message'] = "Votre adresse n'a pas pu être géolocalisée";
        return false;
      }
      $_POST['location'] = htmlspecialchars(substr($_POST['location'], 1, -1));

      // Verification spécialité (si autre)
      if ($_GET['inscription'] == "2" && $_POST['sous_specialite'] == "autre") {
        if (!isset($_POST['newSpe'])) {
          $_SESSION['message'] = "Spécialité incorrect";
          return false;
        }
        $_POST['newSpe'] = htmlspecialchars($_POST['newSpe']);
      }
      return true;
    }
/////////
///////// AJOUT / SUPPRESSION
    /** Méthode qui permet d'ajouter un utilisateur lambda */
    public function addUser($categorie) {
      try {
        if (!$this->estInscrit($_POST['mail'])) {
          $stmt = $this->connexion->prepare('insert into Utilisateurs values(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?);');
          $stmt->bindParam(1,$_POST['civilite']);
          $stmt->bindParam(2,strtoupper($_POST['prenom']));
          $stmt->bindParam(3,strtoupper($_POST['nom']));
          $stmt->bindParam(4,$_POST['mail']);
          $stmt->bindParam(5,crypt($_POST['mdp']));
          $stmt->bindParam(6,$_POST['ddn']);
          $stmt->bindParam(7,$_POST['tel']);
          $stmt->bindParam(8,strtoupper($_POST['adresse']));
          $stmt->bindParam(9,$_POST['cp']);
          $stmt->bindParam(10,strtoupper($_POST['ville']));
          $stmt->bindParam(11,$_POST['location']);
          if ($categorie == 1) {
            $stmt->bindValue(12,1);
            $stmt->bindValue(13,NULL);
          } else {
            $stmt->bindValue(12,2);
            if ($_POST['sous_specialite'] == "autre") {
              if ($_POST['domaine'] == "MEDICAL") {
                $idSpe = $this->getIdSpecialite(strtolower($_POST['speMedecine']));
              } else if ($_POST['domaine'] == "JURIDIQUE") {
                $idSpe = $this->getIdSpecialite(strtolower($_POST['speJuridique']));
              }
              $this->insertSousSpecialite(strtolower($_POST['newSpe']), $idSpe['id']);
              $spe = strtolower($_POST['newSpe']);
            } else {
              $spe = strtolower($_POST['sous_specialite']);
            }
            $idSsSpe = $this->getIdSousSpecialite($spe);
            $stmt->bindParam(13, $idSsSpe['id']);
          }
          $stmt->execute();
          return "ok";
        }
        return "ko";
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    /** Méthode qui permet de supprimer un utilisateur  */
    public function delUser() {
      try {
        if ($this->checkMdp($_POST['login'],$_POST['mdp'])) {
          // Suppression de ses proches

          // Suppression de ses rendez-vous

          // Suppression de son compte
          $stmt = $this->connexion->prepare('delete from Utilisateurs where mail = ?;');
          $stmt->bindParam(1,$_POST['login']);
          $stmt->execute();
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    public function delProche() {
      try {
        if ($this->checkMdp($_POST['login'],$_POST['mdp'])) {
          // Suppression de ses rendez-vous

          // Suppression du proche
          $stmt = $this->connexion->prepare('');
          $stmt->bindParam(1,$_POST['login']);
          $stmt->execute();
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }
/////////
///////// GESTION COMPTE
    /* Méthode permettant de récuperer les informations d'un utilisateur */
    public function getInfosUser() {
      try {
        if ($this->estInscrit($_SESSION['id'])) {
          $stmt = $this->connexion->prepare('select * from Utilisateurs where mail = ?;');
          $stmt->bindParam(1,$_SESSION['id']);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_CLASS, "Utilisateur");
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    /* Méthode permettant de modifier les informations d'un compte utilisateur*/
    public function modifInfosCompte($mdp) {
      try {
        if ($this->estInscrit($_SESSION['id'])) {
          // modif civilite
          $stmt = $this->connexion->prepare('update Utilisateurs SET civilite = ? where mail = ?');
          $stmt->bindParam(1,$_POST['civilite']);
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif nom
          $stmt = $this->connexion->prepare('update Utilisateurs SET nom = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['nom']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // nom prenom
          $stmt = $this->connexion->prepare('update Utilisateurs SET prenom = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['prenom']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif ddn
          $stmt = $this->connexion->prepare('update Utilisateurs SET ddn = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['ddn']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif tel
          $stmt = $this->connexion->prepare('update Utilisateurs SET tel = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['tel']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif adresse
          $stmt = $this->connexion->prepare('update Utilisateurs SET adresse = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['adresse']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif cp
          $stmt = $this->connexion->prepare('update Utilisateurs SET cp = ? where mail = ?');
          $stmt->bindParam(1,$_POST['cp']);
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif ville
          $stmt = $this->connexion->prepare('update Utilisateurs SET ville = ? where mail = ?');
          $stmt->bindParam(1,strtoupper($_POST['ville']));
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif location
          $stmt = $this->connexion->prepare('update Utilisateurs SET location = ? where mail = ?');
          $stmt->bindParam(1,$_POST['location']);
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          // modif mdp
          if ($mdp == 1) {
            $stmt = $this->connexion->prepare('update Utilisateurs SET mdp = ? where mail = ?');
            $stmt->bindParam(1,crypt($_POST['mdp']));
            $stmt->bindParam(2,$_SESSION['id']);
            $stmt->execute();
          }

          // modif mail
          $stmt = $this->connexion->prepare('update Utilisateurs SET mail = ? where mail = ?');
          $stmt->bindParam(1,$_POST['mail']);
          $stmt->bindParam(2,$_SESSION['id']);
          $stmt->execute();

          return "ok";
        }
        return "ko";
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }
/////////
///////// GESTION DOMAINE // SPECIALITE
    public function getDomaine(){
      try {
        $stmt = $this->connexion->prepare('select * from Domaine');
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Domaine");
      }
    }

    public function getSpecialite() {
      try {
        $stmt = $this->connexion->prepare('select * from Specialite order by nom');
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Specialite");
      }
    }

    public function getSousSpecialite() {
      try {
        $stmt = $this->connexion->prepare('select * from Sous_Specialite order by nom');
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Sous_Specialite");
      }
    }

    public function getIdDomaine($nomDomaine){
        try {
          $stmt = $this->connexion->prepare('select id from Domaine where nom = ?');
          $stmt->bindParam(1,$nomDomaine);
          $stmt->execute();
          return $stmt->fetch();
        } catch (PDOException $e) {
          $this->destroy();
          throw new PDOException("Erreur d'accès à la table Domaine");
        }

      }

      public function getIdSpecialite($nom) {
        try {
          $nom = ucfirst($nom);
          $stmt = $this->connexion->prepare('select * from Specialite where nom = ?');
          $stmt->bindParam(1, $nom);
          $stmt->execute();
          return $stmt->fetch();
        } catch (PDOException $e) {
          $this->destroy();
          throw new PDOException("Erreur d'accès à la table Specialite");
        }
      }

      public function getIdSousSpecialite($nom) {
        try {
          $stmt = $this->connexion->prepare('select * from Sous_Specialite where nom = ?');
          $stmt->bindParam(1, $nom);
          $stmt->execute();
          return $stmt->fetch();
        } catch (PDOException $e) {
          $this->destroy();
          throw new PDOException("Erreur d'accès à la table Sous_Specialite");
        }
      }

      public function insertSousSpecialite($nom, $sousDomaine) {
        try {
          $stmt = $this->connexion->prepare('insert into Sous_Specialite values (NULL,?,?);');
          $stmt->bindParam(1,$nom);
          $stmt->bindParam(2,$sousDomaine);
          $stmt->execute();
        } catch (PDOException $e) {
          $this->destroy();
          throw new PDOException("Erreur d'accès à la table Sous_Specialite");
        }
    }

    public function getRdv($idUser){
      try {
        $stmt = $this->connexion->prepare('SELECT nom, prenom, horaire, jour FROM Rdv as r, Utilisateurs as u WHERE idpracticien = u.id and idpatient = ?;');
        $stmt->bindParam(1,$idUser);
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Rdv");
      }
  }

  }
?>
