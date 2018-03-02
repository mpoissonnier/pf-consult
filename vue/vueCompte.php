<?php

/**
* Classe permettant de gérer la vue d'un compte d'un utilisateur du site.
*/
class vueCompte {

	/**
	* Fonction permettant de générer la vue d'accueil du site.
	*/
	public function afficherProfil($user, $listeRDV, $listeProches){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Mon compte</title>
			<?php include 'includes/headHTML.php' ?>
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div id="content">
				<div class="container_form">
					<div class="container">
						<!--  BLOC ONGLET -->
						<ul class="tabs">
							<li><a href="#MesRDV">Mes rendez-vous</a></li>
							<li class="dot"></li>
							<li><a href="#MonCompte">Mon compte</a></li>
							<li class="dot"></li>
							<li><a href="#MesProches">Mes proches</a></li>
						</ul>
						<hr>
						<section id="MesRDV" >
							<div class="element">
								<?php
								foreach ($listeRDV as $row) {
									?>
									<div>
										<h3>Vous avez rendez-vous avec <?php echo ucwords(strtolower($row['prenom'])) . " " . $row['nom']; ?></h3>
										<p>Le <?php echo $row['jour'] ;?> à <?php echo $row['horaire'] ;?></p>
										<p>Ce rendez-vous concerne <?php echo ucwords(strtolower($row['prenomPa'])) . " " . $row['nomPa']; ?></p>
										<a href="index.php?monCompte=3&suppr=<?php echo $row['id']?>"><button class="suppression" type="button">Supprimer</button></a>
									</div>
									<?php
								}
								?>
							</div>
						</section>

						<section id="MonCompte">
							<form id="formModif" action="index.php?monCompte=1" method="post" >
								<div id="content">
									<!--  BLOC CIVILITE-->
									<div class="block">
										<label>Civilité :</label>
										<div>
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
											<input id="prenom" type="text" name="prenom" placeholder="Prénom" size="15" required value="<?php echo ucwords(strtolower($user->getPrenom()))?>" />
											<input id="nom" type="text" name="nom" placeholder="Nom" size="15" required value="<?php echo ucwords(strtolower($user->getNom()))?>" />
										</div>
									</div>
									<hr>

									<!-- BLOC INFO DE CONNEXION -->
									<div class="block">
										<label>Informations de connexion :</label>
										<div>
											<input id="mail" type="email" name="mail" placeholder="Adresse mail" required value="<?php echo $user->getMail()?>"/>
										</div>
										<div>
											<input id="mdp" type="password" name="mdp" placeholder="Nouveau mot de passe" />
											<input id="mdpConfirm" type="password" name="MdpConfirm" placeholder="Confirmer" />
										</div>
									</div>
									<hr>

									<!-- BLOC AUTRES INFOS -->
									<div class="block">
										<label name="Birth">Date de Naissance : </label>
										<div>
											<input type="date" id="ddn" name="ddn" placeholder="DD/MM/YYYY"  maxlength="10" value="<?php echo $user->getDdn()?>" />
										</div>
										<label>N° de téléphone mobile : </label>
										<div>
											<input id="tel" type="tel" name="tel" placeholder="N° tel" maxlength="10" value="<?php echo $user->getTelephone()?>" />
										</div>
									</div>
									<hr>

									<!-- BLOC ADRESSE -->
									<div class="block">
										<label>Adresse : </label>
										<div>
											<input id="adresse" type="text" name="adresse" placeholder="Adresse" required value="<?php echo ucwords(strtolower($user->getAdresse()))?>"/>
										</div>

										<div>
											<input id="cp" type="text" name="cp" placeholder="Code Postal" required maxlength="5"	 value="<?php echo $user->getCp()?>"/>
											<input id="ville" type="text" name="ville" placeholder="Ville" required value="<?php echo ucwords(strtolower($user->getVille()))?>"/>
										</div>

										<div style="display:none">
											<input id="location" type="text" name="location" value="<?php echo $user->getLocation()?>" readonly="readonly">
										</div>
									</div>
									<hr>

									<!--  BLOC SUBMIT -->
									<div class="block">
										<div>
											<input name="send" class="submit-btn" type="submit" value="Modifier" />
										</div>
									</div>
								</div>
							</form>
							<div class="block">
								<div>
									<a href="index.php?monCompte=4&suppr=<?php echo $user->getId()?>"><input class="suppression submit-btn" type="submit" style="cursor:pointer" value="Supprimer mon compte"></a>
								</div>
							</div>
						</section>

						<section id="MesProches">
							<div class="element">
								<?php
								foreach ($listeProches as $row) {
									?>
									<div>
										<h3><?php echo ucwords(strtolower($row['prenom'])) . " " . $row['nom']; ?> :</h3>
										<p><?php echo $row['ddn'] ;?></p>
										<p><?php echo $row['tel'] ;?></p>
										<p><?php echo ucwords(strtolower($row['adresse'])) . " " . $row['cp'] . " " . $row['ville'] ;?></p>
										<a href="index.php?monCompte=3&suppr=<?php echo $row['id']?>"><button class="suppression" type="button">Supprimer</button></a>
									</div>
									<?php
								}
								?>
							</div>
							<button id="ajout">Ajouter un proche</button>
							<div id="ajouter" style="display:none">
								<form id="formProche" method="post" action="index.php?monCompte=2" class="content">
									<!--  BLOC CIVILITE-->
									<div class="block">
										<label>Civilité :</label>
										<div>
											<select name="civiliteP" >
												<option disabled selected>C'est...</option>
												<option name="civiliteP" value="M.">Un homme</option>
												<option name="civiliteP" value="Mme">Une femme</option>
												<option name="civiliteP" value="Autre">Autre</option>
											</select>
											<input id="prenomP" type="text" name="prenomP" placeholder="Prénom" size="15" required />
											<input id="nomP" type="text" name="nomP" placeholder="Nom" size="15" required />
										</div>
									</div>
									<hr>

									<!-- BLOC AUTRES INFOS -->
									<div class="block">
										<label>Date de Naissance : </label>
										<div>
											<input type="date" id="ddnP" name="ddnP" placeholder="DD/MM/YYYY"  maxlength="10" />
										</div>
										<label>N° de téléphone mobile : </label>
										<div>
											<input id="telP" type="tel" name="telP" placeholder="N° tel" maxlength="10" value="<?php echo $user->getTelephone()?>" />
										</div>
									</div>
									<hr>

									<!-- BLOC ADRESSE -->
									<div class="block">
										<label>Adresse : </label>
										<div>
											<input id="adresseP" type="text" name="adresseP" placeholder="Adresse" required value="<?php echo $user->getAdresse()?>"/>
										</div>

										<div>
											<input id="cpP" type="text" name="cpP" placeholder="Code Postal" required maxlength="5" value="<?php echo $user->getCp()?>"/>
											<input id="villeP" type="text" name="villeP" placeholder="Ville" required value="<?php echo $user->getVille()?>" />
										</div>

										<div style="display:none">
											<input id="locationP" type="text" name="locationP" value="" readonly="readonly">
										</div>
									</div>
									<hr>
									<!--  BLOC SUBMIT -->
									<div class="block">
										<div>
											<input name="sendProche" class="submit-btn" type="submit" value="Ajouter le proche" />
										</div>
									</div>
								</form>
							</div>
						</section>
					</div>
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
			<?php include 'includes/headHTML.php' ?>
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
