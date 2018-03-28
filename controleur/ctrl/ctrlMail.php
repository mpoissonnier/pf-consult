<?php

/* CONTROLEUR MAIL : gestion de l'envoi des mails */
  class ControleurMail {

    /* Constructeur de la classe. */
    public function __construct(){
    }

    /* Envoi du mail de reset de mot de passe provisoire */
    public function envoiMailReset($mdp) {
      $mail = $_POST['mail'];

      if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) {
        $passage_ligne = "\r\n";
      } else {
        $passage_ligne = "\n";
      }

      //=====Déclaration des messages au format texte et au format HTML.
      $message_txt = "Bonjour, \n
      Voici votre nouveau mot de passe provisoire : ". $mdp. ". \n
      Nous vous conseillons de le changer lors de votre prochaine connexion. \n
      L'équipe de Pf-consult\n";

      $message_html = "
      <!DOCTYPE html>
      <html>
      <head>
      <meta charset=\"utf-8\">
      <title>Confirmation de votre inscription</title>
      <style>
      @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);
      * { padding: 0;  margin: 0;  text-decoration: none;  color: black;  font-family: \'Lato\', sans-serif; list-style: none;}
      h1 { color: #4d4959; font-variant: small-caps;}
      #content { width: 50%; margin:auto;}
      #content div { margin: 25px;}
      </style>
      </head>
      <body>
      <!-- CONTENT -->
      <div id=\"content\">
      <h1>Nouveau mot de passe provisoire :</h1>
      <div>
      <p>Bonjour,</p>
      <p>Voici votre nouveau mot de passe provisoire : ". $mdp . "</p>
      <pNous vous conseillons de le changer lors de votre prochaine connexion.</p>
      <p id=\"signature\">L'équipe de Pf-consult</p>
      </div>
      </div>
      </body>
      </html>
      ";
      //==========

      //=====Création de la boundary
      $boundary = "-----=".md5(rand());
      //==========

      //=====Définition du sujet.
      $sujet = "Mot de passe provisoire";
      //=========

      //=====Création du header de l'e-mail.
      $header = "From: \"Pf-consult\"<noreply@pf-consult.com>".$passage_ligne;
      $header.= "Reply-to: \"Pf-consult\" <noreply@pf-consult.com>".$passage_ligne;
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
      $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
      $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
      $message.= $passage_ligne.$message_html.$passage_ligne;
      //==========
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      //==========

      //=====Envoi de l'e-mail.
      mail($mail,$sujet,$message,$header);
      //==========
    }

    /* Envoi du mai de confirmation d'inscription */
    public function envoiMailInscription() {
      $mail = $_POST['mail'];

      if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) {
        $passage_ligne = "\r\n";
      } else {
        $passage_ligne = "\n";
      }

      //=====Déclaration des messages au format texte et au format HTML.
      $message_txt = "Bonjour " . $_POST['prenom'] . ", \n
      Nous vous confirmons votre inscription sur notre site. \n
      Votre identifiant est votre adresse mail : " . $_POST['mail'] . "\n
      Vous pouvez désormais prendre rendez-vous auprès de nos spécialistes.\n
      L'équipe de Pf-consult\n";

      $message_html = "
      <!DOCTYPE html>
      <html>
      <head>
      <meta charset=\"utf-8\">
      <title>Confirmation de votre inscription</title>
      <style>
      @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);
      * { padding: 0;  margin: 0;  text-decoration: none;  color: black;  font-family: \'Lato\', sans-serif; list-style: none;}
      h1 { color: #4d4959; font-variant: small-caps;}
      #content { width: 50%; margin:auto;}
      #content div { margin: 25px;}
      </style>
      </head>
      <body>
      <!-- CONTENT -->
      <div id=\"content\">
      <h1>Confirmation de votre inscription</h1>
      <div>
      <p>Bonjour " . $_POST['prenom'] . " </p>
      <p>Nous vous confirmons votre inscription sur notre site.</p>
      <p>Votre identifiant est votre adresse mail : " . $_POST['mail'] . "</p>
      <p>Vous pouvez désormais prendre rendez-vous auprès de nos spécialistes.</p>
      <p id=\"signature\">L'équipe de Pf-consult</p>
      </div>
      </div>
      </body>
      </html>
      ";
      //==========

      //=====Création de la boundary
      $boundary = "-----=".md5(rand());
      //==========

      //=====Définition du sujet.
      $sujet = "Confirmation de votre inscription";
      //=========

      //=====Création du header de l'e-mail.
      $header = "From: \"Pf-consult\"<noreply@pf-consult.com>".$passage_ligne;
      $header.= "Reply-to: \"Pf-consult\" <noreply@pf-consult.com>".$passage_ligne;
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
      $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
      $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
      $message.= $passage_ligne.$message_html.$passage_ligne;
      //==========
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
      //==========

      //=====Envoi de l'e-mail.
      mail($mail,$sujet,$message,$header);
      //==========
    }
  }
?>
