<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Confirmation de votre inscription</title>
    <link rel="stylesheet" type="text/css" href="vue/css/mail.css" />
  </head>
  <body>
    <!-- HEADER -->
    <header>
      <div class="logo-nav"><a href="index.php"><img src="vue/img/main-logo.png"/></a></div>
    </header>

    <!-- CONTENT -->
    <div id="content">
      <h1>Confirmation de votre inscription</h1>
      <div>
        <p>Bonjour <?php echo $_POST['prenom'] . "," ; ?></p>
        <p>Nous vous confirmons votre inscription sur notre site.</p>
        <p>Votre identifiant est votre adresse mail : <?php echo $_POST['mail']; ?></p>
        <p>Vous pouvez désormais prendre rendez-vous auprès de nos spécialistes.</p>
        <p id="signature">L'équipe de Pf-consult</p>
      </div>
    </div>

    <!-- FOOTER -->
    <footer>
      <div class="container_footer">
          <div class="coordonnees">
            <p>IUT de Nantes</p>
            <p>3 Rue Maréchal Joffre</p>
            <p>44000 Nantes</p>
          </div>
          <div class="reseaux_sociaux">
            <ul>
              <li><a href="http://www.iutnantes.univ-nantes.fr/" class="iutnantes-icon"></a></li>
              <li><a href="http://www.univ-nantes.fr/" class="univnantes-icon"></a></li>
            </ul>
          </div>
          <div class="projet">
            <p>Quentin Jollivet Castelot</p>
            <p>Maria Meriguet</p>
            <p>Maureen Poissonnier</p>
            <p>Lilian Rohou</p>
          </div>
        </div>
    </footer>

  </body>
</html>
