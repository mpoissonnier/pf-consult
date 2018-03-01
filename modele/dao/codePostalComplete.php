<?php
require_once "../../config/config.php";

header('Content-type: application/json');
// pour autoriser les requêtes cross-domain
header("Access-Control-Allow-Origin: *");
class AutoCompletionCPVille {
	public $CodePostal;
	public $Ville;
}

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
$strQuery = "SELECT CP CodePostal, VILLE Ville FROM CP WHERE ";
if (isset($_GET["cp"])) {
	$strQuery .= "CP LIKE :codePostal ";
} else {
	$strQuery .= "VILLE LIKE :ville ";
}
//Limite
if (isset($_GET["maxRows"])) {
	$strQuery .= "LIMIT 0, :maxRows";
}
$query = $db->prepare($strQuery);
if (isset($_POST["codePostal"])) {
	$value = $_GET["codePostal"]."%";
	$query->bindParam(":codePostal", $value, PDO::PARAM_STR);
} else {
	$value = $_GET["commune"]."%";
	$query->bindParam(":ville", $value, PDO::PARAM_STR);
}
//Limite
if (isset($_GET["maxRows"]))
{
	$valueRows = intval($_GET["maxRows"]);
	$query->bindParam(":maxRows", $valueRows, PDO::PARAM_INT);
}

$query->execute();

$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionCPVille");;

echo json_encode($list);
?>
