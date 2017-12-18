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
			<title>Recherche</title>
	    <link rel="shortcut icon" href="vue/img/favicon.ico" />
	    <link rel="stylesheet" type="text/css" href="vue/css/styles.css" />
	  </head>
	  <body>
	<!--  HEADER-->
	    <?php  include 'includes/header.php' ?>

	<!--  CONTENT -->
	    <div class="content">
        <form action="" method="post">
          <table id="profil">
            <!--  Modification de l'adresse mail -->
            <tr>
              <th colspan="2">Modifier votre adresse mail :</th>
            </tr>
            <tr>
              <td>
                <label>Votre adresse mail :</label>
                <input type="text" name="mail" value="" >
              </td>
              <td>
                <label>Nouvelle adresse mail :</label>
                <input type="text" name="newMail" >
              </td>
            </tr>
            <!--  Modification du mot de passe -->
            <tr>
              <th colspan="2">Modifier votre mot de passe :</th>
            </tr>
            <tr>
              <td>
                <label>Nouveau mot de passe :</label>
                <input type="password" name="newMdp" >
              </td>
              <td>
                <label>Confirmer le mot de passe:</label>
                <input type="password" name="newMdpConfirm" >
              </td>
            </tr>
            <!--  Modification de l'adresse -->
            <tr>
              <th colspan="2">Modifier votre adresse :</th>
            </tr>
            <tr>
              <td>
                <label>Adresse :</label>
                <input type="text" name="adresse" value="" >
                <label>Code postal :</label>
                <input type="text" name="cp" value="" >
                <label>Ville :</label>
                <input type="text" name="ville" value="" >
              </td>
              <td>

                <label>Nouvelle adresse :</label>
                <input type="text" name="newAdresse" >
                <label>Nouveau code postal :</label>
                <input type="text" name="newCp" >
                <label>Nouvelle ville :</label>
                <input type="text" name="newVille" >
              </td>
            </tr>
            <!--  Confirmation -->
            <tr>
              <td colspan="2">
                <label>Veuillez entrer votre mot de passe :</label>
                <input type="password" name="" value="">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" name="" value="Enregistrer">
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
