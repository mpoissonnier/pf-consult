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
	    <div class="content">
				<h3>Bienvenue sur votre compte <?php echo $_SESSION['user']; ?></h3>
        <form action="index.php?monCompte=1" method="post" onSubmit="return verifFormModifInfos(this);">
          <table id="profil">
            <!--  Modification de l'adresse mail -->
            <tr>
              <th colspan="2">Modifier votre adresse mail :</th>
            </tr>
            <tr>
              <td colspan="2">
                <input type="mail" name="mail" value="<?php echo $user->getMail(); ?>" >
							</td>
            </tr>
            <!--  Modification du mot de passe -->
            <tr>
              <th colspan="2">Modifier votre mot de passe :</th>
            </tr>
            <tr>
              <td>
                <label>Nouveau mot de passe :</label>
                <input id="mdp" type="password" name="mdp" >
              </td>
              <td>
                <label>Confirmer le mot de passe :</label>
                <input id="mdpConfirm" type="password" name="mdpConfirm" >
              </td>
            </tr>
            <!--  Modification de l'adresse -->
            <tr>
              <th colspan="2">Modifier votre adresse :</th>
            </tr>
            <tr>
              <td colspan="2">
                <label>Adresse :</label>
                <input type="text" name="adresse" value="<?php echo $user->getAdresse(); ?>" >
                <label>Code postal :</label>
                <input type="text" name="cp" maxlength="5" value="<?php echo $user->getCp(); ?>" >
                <label>Ville :</label>
                <input type="text" name="ville" value="<?php echo $user->getVille(); ?>" >
              </td>
            </tr>
            <!--  Confirmation -->
            <tr>
              <th colspan="2">
                <label>Veuillez entrer votre mot de passe :</label>
                <input type="password" name="mdpUser" >
              </th>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" value="Enregistrer">
              </td>
            </tr>
          </table>
        </form>
	    </div>

	<!--  FOOTER -->
	    <?php  include 'includes/footer.php' ?>

	  </body>
	</html>
<?php
  }
}
?>
