<?php

  require_once PATH_MODELE."/bean/Utilisateur.php";

   class daoUtilisateur {
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
/////////
///////// AJOUT / SUPPRESSION
    /** Méthode qui permet d'ajouter un utilisateur lambda */
    public function addUser($categorie) {
      try {
        if (!$this->estInscrit($_POST['mail'])) {
          $stmt = $this->connexion->prepare('insert into Utilisateurs values(NULL,?,?,?,?,?,?,?,?,?,?,?);');
          $stmt->bindParam(1,$_POST['civilite']);
          $stmt->bindParam(2,strtoupper($_POST['prenom']));
          $stmt->bindParam(3,strtoupper($_POST['nom']));
          $stmt->bindParam(4,$_POST['mail']);
          $stmt->bindParam(5,crypt($_POST['mdp']));
          $stmt->bindParam(6,$_POST['ddn']);
          $stmt->bindParam(7,strtoupper($_POST['adresse']));
          $stmt->bindParam(8,$_POST['cp']);
          $stmt->bindParam(9,strtoupper($_POST['ville']));
          if ($categorie == 1) {
            $stmt->bindValue(10,1);
            $stmt->bindValue(11,NULL);
          } else {
            $stmt->bindValue(10,2);
            if ($_POST['sous_specialite'] == "autre") {
              $idSpe = $this->getIdSpecialite(ucfirst($_POST['specialite']));
              $this->insertSousSpecialite(ucfirst($_POST['newSpe']), $idSpe['id']);
              $spe = ucfirst($_POST['newSpe']);
            } else {
              $spe = ucfirst($_POST['sous_specialite']);
            }
            $idSsSpe = $this->getIdSousSpecialite($spe);
            $stmt->bindParam(11, $idSsSpe['id']);
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
          $stmt = $this->connexion->prepare('delete from Utilisateurs where mail = ?;');
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
        $stmt = $this->connexion->prepare('select * from Specialite');
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Specialite");
      }
    }

    public function getSousSpecialite() {
      try {
        $stmt = $this->connexion->prepare('select * from Sous_Specialite');
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
  }
?>
