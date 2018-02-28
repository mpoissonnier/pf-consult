// Verifier le formulaire de modification des infos
function verifFormModifInfos(f) {
  var prenomOK = verifString(f.prenom,2,25);
  var nomOK = verifString(f.nom,2,25);
  var adresseOK = verifString(f.adresse,2,25);
  var villeOK = verifString(f.ville,2,25);
  var mailOk = verifMail(f.mail);
  var cpOk = verifCodePostal(f.cp);
  var telOK = verifTel(f.tel);

  var mdp = document.getElementById("mdp");
  var mdpConfirm = document.getElementById("mdpConfirm");
  if (mdp.value == "" && mdpConfirm.value == "") {
    var mdpOk = true;
  } else {
    var mdpOk = verifMdp();
  }

  if(prenomOK && nomOK && adresseOK && villeOK && mailOk && mdpOk && cpOk && telOK) {
    return true;
  } else {
    return false;
  }
}
