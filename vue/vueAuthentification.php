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
    <script src="vue/js/messages.js" type="text/javascript"></script>
  </head>
  <body>
  <!--  HEADER-->
    <?php  include 'includes/header.php' ?>

  <!--  CONTENT -->
    <div id="content">
      <div class="container-index">
        <h2 class="logo-header">Je recherche un professionnel dans le domaine : </h2>
        <div class="flex-container">
          <a href="index.php?domaine=medical" class="submit-btn-med"> MEDICAL </a>
          <a href="index.php?domaine=juridique" class="submit-btn-jur">JURIDIQUE</a>
        </div>
      </div>
    </div>

	<!--  SLIDESHOW-->
		<?php  include 'includes/slideshow.php' ?>

	<!--  FOOTER -->
    <?php  include 'includes/footer.php' ?>

  <!--  FUNCTION -->
  <?php
    if (isset($_SESSION['inscription']) AND $_SESSION['inscription'] == true) {
      echo "<script>inscriptionOk()</script>";
      $_SESSION['inscription'] = false;
    }
  ?>
  </body>
  </html>

<?php
  }
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
        <form action="" method="post">
          <!--  BLOC IDENTIFIANT -->
          <div class="formline">
            <input type="text" name="Id" value="<?php if(isset($_POST['Id'])) {echo $_POST['Id'];}?>" placeholder="Identifiant" required="required" size="25" />
          </div>
          <div class="formline">
            <input type="text" name="Mdp" placeholder="Mot de passe" required="required" size="25" />
          </div>
          <hr>

          <!--  BLOC INSCRIPTION -->
          <div class="formline">
            <input name="send" class="submit-btn" type="submit" value="Se connecter" />
          </div>
        </form>
        <div class="formline">
          <p>Pas encore membre ? <a class="lien_visible" href="index.php?inscription=ok&type=user">Inscrivez-vous</a> gratuitement. </p>
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
		public function genereVueInscription(){
	?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Inscription</title>
		<link rel="shortcut icon" href="vue/img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
	</head>
	<body>
	<!--  HEADER-->
		<?php  include 'includes/header.php' ?>

	<!--  CONTENT -->
		<div id="content">
			<div class="container_form">
				<div class="cutcenter">
					<p>Je suis :</p>
					<?php
					if (isset($_GET['type'])) {
						if ($_GET['type'] == "user") {
							$onglet1 = "onglet_on" ;
							$onglet2 = "";
						}
						if ($_GET['type'] == "pro") {
							$onglet1 = "";
							$onglet2 = "onglet_on";
						}
					}
					?>
					<a id="onglet1" class="onglet <?php echo $onglet1;?>" href="index.php?inscription=ok&type=user">Utilisateur</a>
					<a id="onglet2" class="onglet <?php echo $onglet2;?>" href="index.php?inscription=ok&type=pro">Professionnel</a>
				</div>
				<hr>
				<form action="" method="post">
					<!--  BLOC CIVILITE-->
					<div class="formbloc">

						<div class="cutcenter">
							<?php
							$mr = ""; $mme = "";
							if (isset($_POST['Civilite']) AND $_POST['Civilite'] == "M.") {
								$mr = "selected=\"selected\"";
							} elseif (isset($_POST['Civilite']) AND $_POST['Civilite'] == "Mme") {
								$mme = "selected=\"selected\"";
							}
							?>
							<select name="Civilite" >
								<option name="Civilite" <?php echo $mr; ?> value="M.">M.</option>
								<option name="Civilite" <?php echo $mme; ?> value="Mme">Mme</option>
							</select>
							<input type="text" name="Prenom" value="<?php if(isset($_POST['Prenom'])) {echo $_POST['Prenom'];}?>" placeholder="Prénom" required="required" size="15" />
							<input type="text" name="Nom" value="<?php if(isset($_POST['Nom'])) {echo $_POST['Nom'];}?>" placeholder="Nom" required="required" size="15" />
						</div>

						<div class="formline">
							<input class="full" type="email" name="Adresse_mail" value="<?php if(isset($_POST['Adresse_mail'])) {echo $_POST['Adresse_mail'];}?>" placeholder="Adresse mail" required="required"  />
						</div>
						<?php
						if (isset($_POST['Adresse_mail']) AND ($existMail)) {
							echo "<p><i style=\"color:red; font-size:12px;\">Mail déjà existant</i></p>";
						}
						?>

						<div class="formline cutcenter">
							<input type="password" name="Mdp" placeholder="Mot de passe" required="required"  />
							<input type="password" name="MdpConfirm" placeholder="Confirmer Mot de passe" required="required"  />
						</div>
						<?php
						if (isset($_POST['Mdp']) AND isset($_POST['MdpConfirm'])) {
							if ($_POST['Mdp'] != $_POST['MdpConfirm'] ) {
								echo "<p><i style=\"color:red; font-size:12px;\">Les mots de passe ne correspondent pas.</i></p>";
							} else {
								if (strlen($_POST['Mdp']) < 8 ) {
									echo "<p><i style=\"color:red; font-size:12px;\">Le mot de passe doit contenir au moins 8 caractères;</i></p>";
								}
							}
						}
						?>
					</div>
					<hr>

					<!--  BLOC ADRESSE -->
					<div class="formbloc">

						<div class="cutcenter">
							<label name="Birth">Date de Naissance : </label>
							<input type="date" id="DateBirth" name="DateBirth" value="<?php if (isset($_POST['DateBirth'])) {echo $_POST['DateBirth'];}?>" placeholder="DD/MM/YYYY"  maxlength="10"  />
						</div>
						<?php
						if (isset($_POST['DateBirth'])) {
							list($year,$month,$day) = explode("-",$_POST['DateBirth']);
							if ((date('Y') - $year > 18) OR ((date('Y') - $year == 18) AND (date(n) - $month > 0)) OR ((date('Y') - $year == 18) AND (date(n) - $month == 0) AND (date(j) - $day >= 0))) {
							} else {
								echo "<p><i style=\"color:red; font-size:12px;\">Il faut être majeur pour s'inscrire</i></p>";
							}
						}
						if (isset($_GET['type']) AND $_GET['type'] == "pro") {
							?>
							<div class="formline">
								<input type="text" placeholder="Spécialité" required="required" />
							</div>
							<?php
						}
						?>
						<div class="formline">
							<input class="full" type="text" name="Adresse" value="<?php if (isset($_POST['Adresse'])) {echo $_POST['Adresse'];}?>" placeholder="Adresse" required="required" />
						</div>

						<div class="formline cutcenter">
							<input type="text" name="CP" value="<?php if (isset($_POST['CP'])) {echo $_POST['CP'];}?>" placeholder="Code Postal" required="required" maxlength="5" />
							<input type="text" name="Ville" value="<?php if (isset($_POST['Ville'])) {echo $_POST['Ville'];}?>" placeholder="Ville" required="required" />
						</div>
						<?php
						if (isset($_POST['CP'])) {
							if (!preg_match("#^[0-9]{5,5}$#", $_POST['CP'])) {
								echo "<p><i style=\"color:red; font-size:12px;\">Merci d'entrer un code postal valide</i></p>";
							}
						}
						?>
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
