<?php
	require_once "../../config/config.php";
	session_start();
	header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");

	// Classe Autocompletion du code postal
	class AutoCompletionSpeSpecialiste {
		public $Nom;
		public $Prenom;
	}

	// Requete SQL
	//Initialisation de la liste
	$list = array();

	// Connexion MySQL
	try {
		$chaine = "mysql:host=".HOST.";dbname=".BD.";charset=UTF8";
		$db = new PDO($chaine,LOGIN,PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		throw new PDOException("Erreur de connexion");
	}

	// Verification que ce soit un specialiste
	$strQuery = "select nom Nom, prenom Prenom from Utilisateurs where nom like :nom or prenom like :prenom and type = 2 ";

	$query = $db->prepare($strQuery);
	$value = "%".$_GET["element"]."%";
	$query->bindParam(":nom", $value, PDO::PARAM_STR);
	$query->bindParam(":prenom", $value, PDO::PARAM_STR);

	$query->execute();
	$list1 = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionSpeSpecialiste");;

	// Verification que ce soit une specialité
	$strQuery = "select s1.nom Nom from Sous_Specialite s1, Specialite s2, Domaine d where d.nom = :domaine and s2.domaine = d.id and s1.sousDomaine = s2.id and s1.nom like :nom ";
	$query = $db->prepare($strQuery);
	$value = "%".$_GET["element"]."%";
	$query->bindParam(":domaine", $_SESSION['domaine'], PDO::PARAM_STR);
	$query->bindParam(":nom", $value, PDO::PARAM_STR);

	$query->execute();
	$list2 = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionSpeSpecialiste");

	$strQuery = "select s2.nom Nom from Specialite s2, Domaine d where d.nom = :domaine and s2.domaine = d.id and s2.nom like :nom ";
	$query = $db->prepare($strQuery);
	$value = "%".$_GET["element"]."%";
	$query->bindParam(":domaine", $_SESSION['domaine'], PDO::PARAM_STR);
	$query->bindParam(":nom", $value, PDO::PARAM_STR);

	$query->execute();
	$list3 = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionSpeSpecialiste");

	$list = array_merge($list1, $list2, $list3);
	echo json_encode($list);
?>
