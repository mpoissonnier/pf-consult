<?php
	require_once "../../config/config.php";
	require_once PATH_MODELE."/bean/AutoCompletionCPVille.php";

	header('Content-type: application/json');
	header("Access-Control-Allow-Origin: *");

	// Requete SQL
	//Initialisation de la liste
	$list = array();

	//Connexion MySQL
	try {
		$chaine = "mysql:host=".HOST.";dbname=".BD.";charset=UTF8";
		$db = new PDO($chaine,LOGIN,PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		throw new PDOException("Erreur de connexion");
	}

	//Construction de la requete
	$strQuery = "select CP CodePostal, VILLE Ville from cp_autocomplete where ";

	if (isset($_GET["codePostal"])) {
		$strQuery .= "CP like :codePostal ";
	} else {
		$strQuery .= "VILLE like :ville ";
	}
	$strQuery .= "and CODEPAYS = 'FR' ";

	$query = $db->prepare($strQuery);
	if (isset($_GET["codePostal"])) {
		$value = $_GET["codePostal"]."%";
		$query->bindParam(":codePostal", $value, PDO::PARAM_STR);
	} else {
		$value = $_GET["commune"]."%";
		$query->bindParam(":ville", $value, PDO::PARAM_STR);
	}

	$query->execute();

	$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionCPVille");;

	echo json_encode($list);
?>
