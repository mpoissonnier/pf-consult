<?php

  class ControleurMail {

    /* Constructeur de la classe. */
    public function __construct(){
    }

    /* Fonction permettant l'affichage de la vue d'accueil. */
    public function envoiMailInscription() {
      // Déclaration de l'adresse de destination.
      $mail = $_POST['mail'];

      if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) {
        $passage_ligne = "\r\n";
      } else {
        $passage_ligne = "\n";
      }

      //=====Déclaration des messages au format texte et au format HTML.
      $message_txt = 'Bonjour <?php echo $_POST[\'prenom\'] . "," ; ?> \n
        Nous vous confirmons votre inscription sur notre site. \n
        Votre identifiant est votre adresse mail : <?php echo $_POST[\'mail\']; ?>\n
        Vous pouvez désormais prendre rendez-vous auprès de nos spécialistes.\n
        L\'équipe de Pf-consult\n
      ';

      $message_html = '
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
              <p>Bonjour <?php echo $_POST[\'prenom\'] . "," ; ?></p>
              <p>Nous vous confirmons votre inscription sur notre site.</p>
              <p>Votre identifiant est votre adresse mail : <?php echo $_POST[\'mail\']; ?></p>
              <p>Vous pouvez désormais prendre rendez-vous auprès de nos spécialistes.</p>
              <p id="signature">L\'équipe de Pf-consult</p>
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
      ';

      //==========

      //=====Création de la boundary
      $boundary = "-----=".md5(rand());
      //==========

      //=====Définition du sujet.
      $sujet = "Confirmation de votre inscription";
      //=========

      //=====Création du header de l'e-mail.
      $header = "From: \"Pf-consult\"<noreply@pf-consult.com>".$passage_ligne;
      $header.= "Reply-to: \"Pf-consult\"<noreply@pf-consult.com>".$passage_ligne;
      $header.= "MIME-Version: 1.0".$passage_ligne;
      $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
      //==========

      //=====Création du message.
      $message = $passage_ligne."--".$boundary.$passage_ligne;
      //=====Ajout du message au format texte.
      $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
      $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
      $message.= $passage_ligne.$message_txt.$passage_ligne;
      //==========
      $message.= $passage_ligne."--".$boundary.$passage_ligne;
      //=====Ajout du message au format HTML
      $message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
      $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
      $message.= $passage_ligne.$message_html.$passage_ligne;
      //==========
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      //==========

      //=====Envoi de l'e-mail.
      echo mail($mail,$sujet,$message,$header);
      //==========
    }
  }
?>
