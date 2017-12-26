// Surligner les cases non valides
function surligne(champ, erreur) {
  if(erreur)
  champ.style.backgroundColor = "#fba";
  else
  champ.style.backgroundColor = "";
}

// Vérifier la longueurs d'un champ
function verifString(champ, tailleMin, tailleMax) {
  if(champ.value.length < tailleMin || champ.value.length > tailleMax) {
    surligne(champ, true);
    return false;
  } else {
    surligne(champ, false);
    return true;
  }
}

// Verifie le format de l'adresse mail
function verifMail(champ) {
  var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
  if(!regex.test(champ.value)) {
    surligne(champ, true);
    return false;
  } else {
    surligne(champ, false);
    return true;
  }
}

// Verifie la taille du mot de passe et que ce soient les memes
function verifMdp(){
  var passw = document.getElementById("mdp");
  var passwBis = document.getElementById("mdpConfirm");
  if (passw.value != passwBis.value) {
    surligne(passw, true);
    surligne(passwBis, true);
    return false;
  } else if (passw.value.length > 20 || passw.value.length < 5) {
    surligne(passw, true);
    surligne(passwBis, true);
    return false;
  } else {
    surligne(passw, false);
    surligne(passwBis, false);
    return true;
  }
}

// Verifie le format du code postal
function verifCodePostal(champ) {
  if(champ.value.length != 5 || !/^\d+$/.test(champ.value)) {
    surligne(champ, true);
    champ.value = "";
    return false;
  } else {
    surligne(champ, false);
    return true;
  }
}

// Verifier le formulaire d'inscription
function verifFormInscription(f) {
  var prenomOK = verifString(f.prenom,2,25);
  var nomOK = verifString(f.nom,2,25);
  var adresseOK = verifString(f.adresse,2,25);
  var villeOK = verifString(f.ville,2,25);
  var mailOk = verifMail(f.mail);
  var mdpOk = verifMdp();
  var cpOk = verifCodePostal(f.cp);

  if(prenomOK && nomOK && adresseOK && villeOK && mailOk && mdpOk && cpOk) {
    return true;
  } else {
    return false;
  }
}

// Verifier le formulaire de modification des infos
function verifFormModifInfos(f) {
  var prenomOK = verifString(f.prenom,2,25);
  var nomOK = verifString(f.nom,2,25);
  var adresseOK = verifString(f.adresse,2,25);
  var villeOK = verifString(f.ville,2,25);
  var mailOk = verifMail(f.mail);
  var cpOk = verifCodePostal(f.cp);

  var mdp = document.getElementById("mdp");
  var mdpConfirm = document.getElementById("mdpConfirm");
  if (mdp.value == "" && mdpConfirm.value == "") {
    var mdpOk = true;
  } else {
    var mdpOk = verifMdp();
  }

  if(prenomOK && nomOK && adresseOK && villeOK && mailOk && mdpOk && cpOk) {
    return true;
  } else {
    return false;
  }
}
