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
      $this->connexion=null;
    }
/////////
///////// CHECK
    /* Méthode qui permet de voir si un utilisateur est deja inscrit */
    public function estInscrit($mail){
      try {
        $stmt = $this->connexion->prepare("select * from users where mail = ?;");
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
        throw new PDOException("Erreur d'accès à la table users");
      }
    }

    /* Méthode qui permet de vérifier le mot de passe */
    public function checkMdp($mail, $mdp) {
      if ($this->exists($mail)) {
        try {
          $stmt = $this->connexion->prepare("select * from users where mail = ?;");
          $stmt->bindParam(1,$mail);
          $stmt->execute();
          $mdpUtilisateur = $stmt->fetch();
          $mdpUser = $mdpUtilisateur["mdp"];
          if (crypt($mdp, $mdpUser) == $mdpUser) {
            return true;
          } else {
            return false;
          }
        } catch(PDOException $e) {
          $this->destroy();
          throw new PDOException("Erreur d'accès à la table users");
        }
      }
    }

/////////
///////// AJOUT / SUPPRESSION
    /** Méthode qui permet d'ajouter un utilisateur lambda */
    public function addUser() {
      try {
        if (!$this->exists()) {
          $req = $bdd->prepare('insert into users values(NULL, ?,?,?,?,?,?,?,?,?,NULL);');
          $req->bindParam(1,htmlspecialchars($_POST['Adresse_mail']));
          $req->bindParam(2,htmlspecialchars(crypt($_POST['mdp'])));
          $req->bindParam(3,htmlspecialchars($_POST['Civilite']));
          $req->bindParam(4,htmlspecialchars($_POST['Prenom']));
          $req->bindParam(5,htmlspecialchars($_POST['Nom']));
          $req->bindParam(6,); // DDN
          $req->bindParam(7,htmlspecialchars($_POST['Adresse']));
          $req->bindParam(8,htmlspecialchars($_POST['CP']));
          $req->bindParam(9,htmlspecialchars($_POST['Ville']));
          $req->execute();
        }
      } catch (PDOException $e) {
        $this->destroy();
        throw new PDOException("Erreur d'accès à la table users");
      }
    }
  }
?>
