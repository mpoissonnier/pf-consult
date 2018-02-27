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
				} else {
					$class = "searchbar_jur";
					$type = 2;
				}
				?>

				<div class="searchbar <?php echo $class; ?>" >
					<form class="searchbar" action="index.php?search=<?php echo $type; ?>" method="post">
						<div id="search_dom1" class="search_dom">
							<svg width="20" height="20" viewBox="0 0 20 20"><path d="M19.6 16.92c.48.6.53 1.12.14 1.58l-1.2 1.2c-.58.48-1.16.48-1.72 0l-4.8-4.86a7.6 7.6 0 0 1-3.96 1.1 7.65 7.65 0 0 1-5.64-2.44A7.8 7.8 0 0 1 7.82 0C10 0 11.9.8 13.5 2.42a7.74 7.74 0 0 1 1.23 9.74l4.86 4.76zM2.36 7.86c0 1.5.58 2.8 1.74 3.96 1.16 1.16 2.48 1.73 3.96 1.73s2.76-.54 3.8-1.63a5.35 5.35 0 0 0-.09-7.76A5.44 5.44 0 0 0 7.82 2.4c-1.52 0-2.8.55-3.8 1.64a5 5 0 0 0-1.65 3.8z"></path></svg>
							<input type="text" name="specialiste" placeholder="<?php if($domaine == 1) {echo "Médecin, spécialité..."; } else { echo "Avocat, spécialité..."; }?>" onfocus="focused(1)" onblur="unfocused(1)" >
						</div>
						<div id="search_dom2" class="search_dom">
							<svg width="16" height="20" viewBox="0 0 16 20"><path d="M16 7.5c0-1-.2-2-.7-3-.3-.8-1-1.6-1.7-2.3A8.69 8.69 0 0 0 8 0C7 0 6 .2 5 .6c-1 .4-2 1-2.7 1.6C1.6 3 1 3.7.7 4.6a6.4 6.4 0 0 0 0 5.8c0 .4.4 1 .8 1.4l5.2 7.5c.4.5.8.7 1.3.7s1-.2 1.3-.7l5.2-7.5c.4-.5.7-1 .8-1.4.5-1 .7-2 .7-3zm-6 2c-.5.5-1.2.8-2 .8s-1.5-.3-2-1c-.7-.4-1-1-1-1.8s.3-1.4 1-2c.5-.5 1.2-.8 2-.8s1.5.3 2 .8c.7.6 1 1.2 1 2 0 .7-.3 1.4-1 2z"></path></svg>
							<input type="text" name="ville" placeholder="Où ?" onfocus="focused(2)" onblur="unfocused(2)" >
						</div>
						<div class="valid_dom">
							<input type="submit" onvalue=unfocused(this) value="Rechercher >" >
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
							<svg width="20" height="20" viewBox="0 0 20 20"><path d="M19.6 16.92c.48.6.53 1.12.14 1.58l-1.2 1.2c-.58.48-1.16.48-1.72 0l-4.8-4.86a7.6 7.6 0 0 1-3.96 1.1 7.65 7.65 0 0 1-5.64-2.44A7.8 7.8 0 0 1 7.82 0C10 0 11.9.8 13.5 2.42a7.74 7.74 0 0 1 1.23 9.74l4.86 4.76zM2.36 7.86c0 1.5.58 2.8 1.74 3.96 1.16 1.16 2.48 1.73 3.96 1.73s2.76-.54 3.8-1.63a5.35 5.35 0 0 0-.09-7.76A5.44 5.44 0 0 0 7.82 2.4c-1.52 0-2.8.55-3.8 1.64a5 5 0 0 0-1.65 3.8z"></path></svg>
							<input type="text" name="specialiste" placeholder="Médecin, spécialité..." onfocus="focused(1)" onblur="unfocused(1)" >
						</div>
						<div id="search_dom2" class="search_dom">
							<svg width="16" height="20" viewBox="0 0 16 20"><path d="M16 7.5c0-1-.2-2-.7-3-.3-.8-1-1.6-1.7-2.3A8.69 8.69 0 0 0 8 0C7 0 6 .2 5 .6c-1 .4-2 1-2.7 1.6C1.6 3 1 3.7.7 4.6a6.4 6.4 0 0 0 0 5.8c0 .4.4 1 .8 1.4l5.2 7.5c.4.5.8.7 1.3.7s1-.2 1.3-.7l5.2-7.5c.4-.5.7-1 .8-1.4.5-1 .7-2 .7-3zm-6 2c-.5.5-1.2.8-2 .8s-1.5-.3-2-1c-.7-.4-1-1-1-1.8s.3-1.4 1-2c.5-.5 1.2-.8 2-.8s1.5.3 2 .8c.7.6 1 1.2 1 2 0 .7-.3 1.4-1 2z"></path></svg>
							<input type="text" name="ville" placeholder="Où ?" onfocus="focused(2)" onblur="unfocused(2)" >
						</div>
						<div class="valid_dom">
							<input type="submit" onvalue=unfocused(this) value="Rechercher >" >
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
