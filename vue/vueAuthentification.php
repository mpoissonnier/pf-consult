<?php

class vueAuthentification {

	/* Fonction permettant de générer la vue d'accueil du site. */
	public function genereVueAccueil(){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Accueil</title>
			<link rel="shortcut icon" href="vue/img/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div id="content">
				<div class="container-index">
					<h2 class="logo-header">Je recherche un professionnel dans le domaine : </h2>
					<div class="flex-container">
						<a href="index.php?domaine=medical" class="submit-btn-med">MEDICAL</a>
						<a href="index.php?domaine=juridique" class="submit-btn-jur">JURIDIQUE</a>
					</div>
				</div>
			</div>

			<!--  SLIDESHOW-->
			<?php  include 'includes/slideshow.php' ?>

			<!--  FOOTER -->
			<?php  include 'includes/footer.php' ?>

			<!--  FUNCTION -->
		</body>
		</html>

		<?php
	}
	/* Fonction permettant de générer la vue de connexion du site */
	public function genereVueConnexion(){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Connexion</title>
			<link rel="shortcut icon" href="vue/img/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div id="content">
				<div class="container_form">
					<form action="index.php?connexion=1" method="post">
						<!--  BLOC IDENTIFIANT -->
						<div class="formline">
							<input type="text" name="login" placeholder="Identifiant" required size="25" />
						</div>
						<div class="formline">
							<input type="password" name="mdp" placeholder="Mot de passe" required size="25" />
						</div>
						<hr>

						<!--  BLOC INSCRIPTION -->
						<div class="formline">
							<input name="send" class="submit-btn" type="submit" value="Se connecter" />
						</div>
					</form>
					<div class="formline">
						<p>Pas encore membre ? <a class="lien_visible" href="index.php?inscription=user">Inscrivez-vous</a> gratuitement. </p>
					</div>
				</div>
			</div>

			<!--  SLIDESHOW-->
			<?php  include 'includes/slideshow.php' ?>

			<!--  FOOTER -->
			<?php  include 'includes/footer.php' ?>

		</body>
		</html>
		<?php
	}
	/* Fonction permettant de générer la vue d'inscription du site */
	public function genereVueInscription($listeDomaine, $listeSpecialite, $listeSousSpecialite){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Inscription</title>
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
					<div>
						<p>Je suis :</p>
						<?php
						if (isset($_GET['inscription'])) {
							if ($_GET['inscription'] == "user") {
								$onglet1 = "onglet_on" ;
								$onglet2 = "";
								$type = 1;
							}
							if ($_GET['inscription'] == "pro") {
								$onglet1 = "";
								$onglet2 = "onglet_on";
								$type = 2;
							}
						}
						?>
						<div class="onglet">
							<a id="onglet1" class="onglet <?php echo $onglet1;?>" href="index.php?inscription=user">Utilisateur</a>
							<a id="onglet2" class="onglet <?php echo $onglet2;?>" href="index.php?inscription=pro">Professionnel</a>
						</div>
					</div>
					<hr>
					<form action="index.php?inscription=<?php echo $type ?>" method="post" onsubmit="return verifFormInscription(this)" >
						<!--  BLOC CIVILITE-->
						<div class="formbloc">
							<div class="cutcenter">
								<select name="civilite" >
									<option name="civilite" value="M.">M.</option>
									<option name="civilite" value="Mme">Mme</option>
								</select>
								<input type="text" name="prenom" placeholder="Prénom" size="15" onblur="verifString(this,2,25)" required />
								<input type="text" name="nom" placeholder="Nom" size="15" onblur="verifString(this,2,25)" required />
							</div>
							<div class="formline">
								<input id="mail" class="full" type="email" name="mail" placeholder="Adresse mail" onblur="verifMail(this)" required />
							</div>
							<div class="formline cutcenter">
								<input id="mdp" type="password" name="mdp" placeholder="Mot de passe" required  />
								<input id="mdpConfirm" type="password" name="MdpConfirm" placeholder="Confirmer Mot de passe" onblur="verifMdp()" required />
							</div>
						</div>
						<hr>

						<!--  BLOC ADRESSE -->
						<div class="formbloc">
							<div class="cutcenter">
								<label name="Birth">Date de Naissance : </label>
								<input type="date" id="DateBirth" name="ddn" placeholder="DD/MM/YYYY"  maxlength="10"  />
							</div>
							<?php
							if (isset($_GET['inscription']) AND $_GET['inscription'] == "pro") {
								?>
								<div class="cutcenter">
									<select name="domaine">
										<?php
										foreach ($listeDomaine as $row) {
											?>
											<option value="<?php echo $row['nom']; ?>"><?php echo $row['nom']; ?></option>
											<?php
										}
										?>
									</select>
									<select name="specialite">
										<?php
										foreach ($listeSpecialite as $row) {
											?>
											<option value="<?php echo $row['nom']; ?>"><?php echo $row['nom']; ?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="formline">
									<select class="full" name="sous_specialite">
										<?php
										foreach ($listeSousSpecialite as $row) {
											?>
											<option value="<?php echo $row['nom']; ?>"><?php echo $row['nom']; ?></option>
											<?php
										}
										?>
										<option value="autre">autre...</option>
									</select>
									<?php
								}
								?>

							<div class="formline">
								<input class="full" type="text" name="adresse" placeholder="Adresse" onblur="verifString(this,2,50)" required />
							</div>

							<div class="formline cutcenter">
								<input type="text" name="cp" placeholder="Code Postal" required maxlength="5" onblur="verifCodePostal(this)" />
								<input type="text" name="ville" placeholder="Ville" onblur="verifString(this,2,50)" required />
							</div>
						</div>
						<hr>

						<!--  BLOC INSCRIPTION -->
						<div class="formline">
							<input name="send" class="submit-btn" type="submit" value="S'inscrire" />
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
