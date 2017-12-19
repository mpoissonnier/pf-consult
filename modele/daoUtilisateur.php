<?php

   class daoUtilisateur {
    private $connexion;

///////// BASE DE DONNEES
    /* Constucteur de la classe, se connecte à la base de données */
    public function __construct(){
      try {
        $chaine = "mysql:host=".HOST.";dbname=".BD;
        $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
        $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        throw new PDOException("Erreur de connexion");
      }
    }

    /* Methode qui permet de se deconnecter de la base */
    public function destroy(){
      $this->connexion = null;
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

/////////
///////// AJOUT / SUPPRESSION
    /** Méthode qui permet d'ajouter un utilisateur lambda */
    public function addUser() {
      try {
        if (!$this->estInscrit($_POST['mail'])) {
          $stmt = $this->connexion->prepare('insert into Utilisateurs values(NULL,?,?,?,?,?,?,?,?,?,1,NULL);');
          $stmt->bindParam(1,strtoupper($_POST['civilite']));
          $stmt->bindParam(2,strtoupper($_POST['prenom']));
          $stmt->bindParam(3,strtoupper($_POST['nom']));
          $stmt->bindParam(4,$_POST['mail']);
          $stmt->bindParam(5,crypt($_POST['mdp']));
          $stmt->bindParam(6,$_POST['ddn']);
          $stmt->bindParam(7,strtoupper($_POST['adresse']));
          $stmt->bindParam(8,$_POST['cp']);
          $stmt->bindParam(9,strtoupper($_POST['ville']));
          $stmt->execute();
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }

    /** Méthode qui permet de supprimer un utilisateur lambda */
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
    public function connexion() {
      try {
        if ($this->estInscrit($_POST['login']) && $this->checkMdp($_POST['login'],$_POST['mdp'])) {
          $stmt = $this->connexion->prepare('select * from Utilisateurs where mail = ?;');
          $stmt->bindParam(1,$_POST['login']);
          $stmt->execute();
          $tabResult = $stmt->fetch();
          if ($tabResult != NULL) {
            return (ucfirst(strtolower($tabResult['prenom'])) . " " . $tabResult['nom']);
          }
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table Utilisateurs");
      }
    }
  }

?>
