<?php

/**
 * Classe permettant de gérer la vue d'accueil du site.
 */
class vueDomaine {

	/**
	 * Fonction permettant de générer la vue d'accueil du site.
	 */
	public function genereVueDomaine($domaine){
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
	      <?php
	      if ($domaine == 1) {
	      ?>
	      <!-- DOMAINE MEDICAL  -->
	      <div class="searchbar_med">

	      </div>
	      <?php
			} else if ($domaine == 2) {
	      ?>
	      <!--  DOMAINE JURIDIQUE -->
	      <div class="searchbar_jur">

	      </div>
	      <?php
	        }
	      ?>
	    </div>
	<!--  SLIDESHOW-->
		<!-- <?php  include 'includes/slideshow.php' ?> -->

	<!--  FOOTER -->
	    <?php  include 'includes/footer.php' ?>

	  </body>
	</html>
<?php
  }
}
?>
