//On surligne les cases non valides
function surligne(champ, erreur) {
  if(erreur)
    champ.style.backgroundColor = "#fba";
  else
    champ.style.backgroundColor = "";
}

function verifString(champ, txt, longMax) {
  if(champ.value.length > longMax) {
    surligne(champ, true);
    document.getElementById(txt).innerHTML = longMax + " caractères maximum autorisés";
    return true;
  } else {
    surligne(champ, false);
    document.getElementById(txt).innerHTML = "";
    return false;
  }
}

function verifEmail(champ, txt){
  var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
  if(!reg.test(champ.value)) {
    surligne(champ, true);
    document.getElementById(txt).innerHTML = "L'e-mail n'est pas valide.";
    return false;
  } else {
    surligne(champ, false);
    document.getElementById(txt).innerHTML = "";
    return true;
  }
}

function verifMdp(txt){
  var passw = document.getElementById("mdp");
  var passwBis = document.getElementById("mdpConfirm");
  if (passw.value != passwBis.value) {
    surligne(passw, true);
    surligne(passwBis, true);
    document.getElementById(txt).innerHTML = "Les mots de passe ne coïncident pas.";
    return false;
  } else if (passw.value.length > 20 || passw.value.length < 5) {
    surligne(passw, true);
    surligne(passwBis, true);
    document.getElementById(txt).innerHTML = "Le mot de passe doit faire 5 à 20 caractères";
    return false;
  } else {
    surligne(passw, false);
    surligne(passwBis, false);
    document.getElementById(txt).innerHTML = "";
    return true;
  }
}

function verifCodePostal(champ, txt) {
  if(champ.value.length != 5 || !/^\d+$/.test(champ.value)) {
    surligne(champ, true);
    document.getElementById(txt).innerHTML = "Le code postal doit être rentré au format XXXXX avec des chiffres";
    champ.value = "";
    return true;
  } else {
    surligne(champ, false);
    document.getElementById(txt).innerHTML = "";
    return false;
  }
}

function EnableSubmit(val) {
  var sbmt = document.getElementById("submit");
  if (val.checked == true)
    sbmt.disabled = false;
  else
    sbmt.disabled = true;
}

function VerifSubmit() {
  html = html.replace(/</g, "&lt;").replace(/>/g, "&gt;");
  var passw = document.getElementById("mdp");
  var passwBis = document.getElementById("mdpConfirm");
  if (passw.value != passwBis.value) {
    alert('Les mots de passe ne coïncident pas.');
    return false;
  }
  if (/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(document.getElementById("mail").value)) {
    return true;
  } else {
    alert("L\'adresse email n'est pas correcte !")  ;
    return false;
  }
}
