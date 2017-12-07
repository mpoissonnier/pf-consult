<?php

/**
 * Classe permettant de gérer la vue d'accueil du site.
 */
class vueConnexion {

	/**
	 * Fonction permettant de générer la vue d'accueil du site.
	 */
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
          <p>Pas encore membre ? <a class="lien_visible" href="http://infoweb/~pf-consult/inscription.php?type=user">Inscrivez-vous</a> gratuitement. </p>
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
}
?>
