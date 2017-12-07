function inscriptionOk() {
  document.getElementById("divmsg").style.visibility = "visible";
  document.getElementById("divmsg").innerHTML = "Vous êtes bien inscrit !";
  setTimeout(function() {document.getElementById("divmsg").innerHTML = "";},5000);
  setTimeout(function() {document.getElementById("divmsg").style.visibility = "hidden";},5000);
}
