<?php

/**
 * Classe permettant de gérer la vue d'accueil du site.
 */
class vueAccueil {

	/**
	 * Fonction permettant de générer la vue d'accueil du site.
	 */
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
}
?>
