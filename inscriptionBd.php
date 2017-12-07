<?php
// VALIDATION DES DONNEES
  $validDonnees = true;
  // BOUTON ENVOI A ETE CLIQUE
  if (!isset($_POST['send'])) {
    $validDonnees = false;
  }
  // CIVILITE
  if (!isset($_POST['Civilite']) OR ($_POST['Civilite'] != "M." AND $_POST['Civilite'] != "Mme")) {
    $validDonnees = false;
  }
  // PRENOM / NOM / ADRESSE / VILLE
  if (!isset($_POST['Prenom']) OR !isset($_POST['Nom']) OR !isset($_POST['Adresse']) OR !isset($_POST['Ville'])) {
    $validDonnees = false;
  }
  // POSTAL CODE
  if (!isset($_POST['CP']) OR !preg_match("#[1-9][1-9]\d\d\d#", $_POST['CP'])) {
    $validDonnees = false;
  }
  // ADRESSE MAIL
  if (!isset($_POST['Adresse_mail'])) {
    $validDonnees = false;
  }
  // MDP
  if (!isset($_POST['Mdp']) OR !isset($_POST['MdpConfirm']) OR (strcmp($_POST['Mdp'],$_POST['MdpConfirm']) != 0)) {
    $validDonnees = false;
  } else {
    if (strlen($_POST['Mdp']) < 8) {
      $validDonnees = false;
    }
  }
  // DDN
  if (isset($_POST['DateBirth'])) {
    list($day,$month,$year) = explode("/",$_POST['DateBirth']);
    if ((date('Y') - $year > 18) OR ((date('Y') - $year == 18) AND (date(n) - $month > 0)) OR ((date('Y') - $year == 18) AND (date(n) - $month == 0) AND (date(j) - $day >= 0))) {
    } else {
      $validDonnees = false;
    }
  }

// SI DONNEES OK -> INSCRIPTION
  if ($validDonnees) {
    try {
      $bdd = new PDO("mysql:host=localhost;dbname=info2-2017-pfcon-db","info2-2017-pc","pfconsult");
    } catch(Exception $e) {
      die('Erreur : '.$e->getMessage());
    }

    // PHP VERSION < 5.5
    $mdpHash = sha1($_POST['Mdp']);
    // PHP VERSION > 5.5
    // $mdpHash = password_hash($_POST['Mdp']);

    // CHANGEMENT FORMAT DATE
    list($day,$month,$year) = explode("/",htmlspecialchars($_POST['DateBirth']));
    $dateNaissance = $year . "-" . $month . "-" . $day;

    // VERIF QUE LE MAIL N'EST PAS DEJA DANS LA BASE
    $stmt = $bdd->prepare("select * FROM Membres WHERE Mail = ?;");
    $stmt->bindParam(1,htmlspecialchars($_POST['Adresse_mail']));
    $stmt->execute();

    if (!$stmt->fetch()) {
      $existMail = FALSE;
      $req = $bdd->prepare('insert into Membres values(NULL, ?,?,?,?,?,?,?,?,?,NULL);');
      $req->bindParam(1,htmlspecialchars($_POST['Adresse_mail']));
      $req->bindParam(2,htmlspecialchars($mdpHash));
      $req->bindParam(3,htmlspecialchars($_POST['Civilite']));
      $req->bindParam(4,htmlspecialchars($_POST['Prenom']));
      $req->bindParam(5,htmlspecialchars($_POST['Nom']));
      $req->bindParam(6,$dateNaissance);
      $req->bindParam(7,htmlspecialchars($_POST['Adresse']));
      $req->bindParam(8,htmlspecialchars($_POST['CP']));
      $req->bindParam(9,htmlspecialchars($_POST['Ville']));
      $req->execute();
      $_SESSION['inscription'] = true;

      header('Location:http://infoweb/~pf-consult/index.php');
    } else {
      $existMail = TRUE;
    }
  }
?>
