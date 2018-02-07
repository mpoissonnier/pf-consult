<?php

/**
* Classe permettant de gérer la vue d'un compte d'un utilisateur du site.
*/
class vueCompte {

	/**
	* Fonction permettant de générer la vue d'accueil du site.
	*/
	public function afficherProfil($user){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Mon compte</title>
			<link rel="shortcut icon" href="vue/img/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
			<script src="vue/scripts/checkForm.js"></script>
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div id="content">
				<div class="container_form">
					<form action="index.php?monCompte=1" method="post" onsubmit="return verifFormModifInfos(this)" >

						<!--  BLOC CIVILITE-->
						<div class="formbloc">
							<div class="cutcenter">
								<select name="civilite" >
									<?php
									if ($user->getCivilite() == "M.") {
										$mr = "selected";
									} else if ($user->getCivilite() == "Mme") {
										$mme = "selected";
									} else {
										$other = "selected";
									}
									?>
									<option name="civilite" <?php if (isset($mr)) echo $mr; ?> value="M.">M.</option>
									<option name="civilite" <?php if (isset($mme)) echo $mme; ?> value="Mme">Mme</option>
									<option name="civilite" <?php if (isset($other)) echo $other; ?> value="Autre">Autre</option>
								</select>
								<input type="text" name="prenom" placeholder="Prénom" size="15" onblur="verifString(this,2,25)" required value="<?php echo ucwords(strtolower($user->getPrenom()))?>" />
								<input type="text" name="nom" placeholder="Nom" size="15" onblur="verifString(this,2,25)" required value="<?php echo ucwords(strtolower($user->getNom()))?>" />
							</div>
							<div class="formline">
								<input id="mail" class="full" type="email" name="mail" placeholder="Adresse mail" required value="<?php echo $user->getMail()?>"/>
							</div>
							<div class="formline cutcenter">
								<input id="mdp" type="password" name="mdp" placeholder="Nouveau mot de passe" />
								<input id="mdpConfirm" type="password" name="MdpConfirm" placeholder="Confirmer" />
							</div>
						</div>
						<hr>

						<!--  BLOC ADRESSE -->
						<div class="formbloc">
							<div class="cutcenter">
								<label name="Birth">Date de Naissance : </label>
								<input type="date" id="DateBirth" name="ddn" placeholder="DD/MM/YYYY"  maxlength="10" value="<?php echo $user->getDdn()?>" />
							</div>
							<div class="formline">
								<input class="full" type="text" name="adresse" placeholder="Adresse" onblur="verifString(this,2,50)" required value="<?php echo ucwords(strtolower($user->getAdresse()))?>"/>
							</div>

							<div class="formline cutcenter">
								<input type="text" name="cp" placeholder="Code Postal" required maxlength="5" onblur="verifCodePostal(this)" value="<?php echo $user->getCp()?>"/>
								<input type="text" name="ville" placeholder="Ville" onblur="verifString(this,2,50)" required value="<?php echo ucwords(strtolower($user->getVille()))?>"/>
							</div>
						</div>
						<hr>

						<!--  BLOC CONFIRMATION -->
						<div class="formline">
							<input name="send" class="submit-btn" type="submit" value="Enregistrer" />
						</div>
					</form>
				</div>
			</div>

			<!--  FOOTER -->
			<?php  include 'includes/footer.php' ?>

		</body>
		</html>
		<?php
	}
	public function afficherPageReset() {
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Réinitialiser votre mot de passe</title>
		<link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
	</head>
	<body>
		<!--  HEADER-->
		<?php  include 'includes/header.php' ?>

		<!--  CONTENT -->
		<div id="content">
			<div class="container_form connexion_form">
				<div class="formline">
					<h3>Récupération de votre mot de passe :</h3>
				</div>
				<form action="index.php?reset=1" method="post">
					<!--  BLOC IDENTIFIANT -->
					<div>
						<input type="text" name="mail" placeholder="Adresse mail" required size="25" />
					</div>
					<hr>

					<!--  BLOC VALIDATION -->
					<div>
						<input name="send" class="submit-btn" type="submit" value="Envoyer un mail de récupération" />
					</div>
				</form>
			</div>
		</div>

		<!--  FOOTER -->
		<?php  include 'includes/footer.php' ?>

	</body>
</html>
		<?php
	}
}
?>
