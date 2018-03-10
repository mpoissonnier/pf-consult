<?php

/**
* Classe permettant de gérer la vue d'accueil du site.
*/
class vueDomaine {

	/* Fonction permettant de générer la vue du domaine. */
	public function genereVueDomaine($domaine){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<title>Recherche</title>
			<?php include 'includes/headHTML.php' ?>
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div class="content">
				<?php if ($domaine == 1) {
					$class = "searchbar_med";
					$type = 1;
					$_SESSION['domaine'] = "MEDICAL";
				} else {
					$class = "searchbar_jur";
					$type = 2;
					$_SESSION['domaine'] = "JURIDIQUE";
				}
				?>

				<div class="searchbar <?php echo $class; ?>" >
					<form class="searchbar" action="index.php?search=<?php echo $type; ?>" method="post">
						<div id="search_dom1" class="search_dom">
							<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
    						<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
    						<path d="M0 0h24v24H0z" fill="none"/>
							</svg>
							<input id="specialiste" type="text" name="specialiste" placeholder="<?php if($domaine == 1) {echo "Médecin, spécialité..."; } else { echo "Avocat, spécialité..."; }?>" >
						</div>
						<div id="search_dom2" class="search_dom">
							<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
    						<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
    						<path d="M0 0h24v24H0z" fill="none"/>
							</svg>
							<input id="ville" type="text" name="ville" placeholder="Où ?" >
						</div>
						<div class="valid_dom">
							<input type="submit" value="Rechercher >" >
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
	/* Fonction permettant de générer la vue de recherche des spécialistes. */
	public function genereVueRecherche($domaine){
		?>
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<title>Recherche</title>
			<?php include 'includes/headHTML.php' ?>
		</head>
		<body>
			<!--  HEADER-->
			<?php  include 'includes/header.php' ?>

			<!--  CONTENT -->
			<div class="content">
				<?php if ($domaine == 1) {
					$class = "searchbar_med";
					$type = 1;
				} else {
					$class = "searchbar_jur";
					$type = 2;
				}
				?>

				<div class="searchbar mini" >
					<form class="searchbar mini" action="index.php?search=<?php echo $type; ?>" method="post">
						<div id="search_dom1" class="search_dom">
							<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
								<path d="M0 0h24v24H0z" fill="none"/>
							</svg>
							<input type="text" name="specialiste" placeholder="Médecin, spécialité..." >
						</div>
						<div id="search_dom2" class="search_dom">
							<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
    						<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
    						<path d="M0 0h24v24H0z" fill="none"/>
							</svg>
							<input type="text" name="ville" placeholder="Où ?" >
						</div>
						<div class="valid_dom">
							<input type="submit" value="Rechercher >" >
						</div>
					</form>
				</div>

				<!-- <?php
					for ($i=0; $i < 5 ; $i++) {

				 ?>
				 	<div class="pro">
						<div class="coordonnes">
							<p>Martin Dupont</p>
							<p>10 rue de la prairie</p>
							<p>44000 Nantes</p>
						</div>
						<div class="dispo">

						</div>
					</div>
				<?php
					}
				 ?> -->
			</div>

			<!--  FOOTER -->
			<?php  include 'includes/footer.php' ?>

		</body>
		</html>
		<?php
	}
}
?>
