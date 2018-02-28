$(document).ready(function() {


  // Verification du formulaire d'inscription
  var check = false;
  $("#formInscription").on('submit', function(event) {
    // VALIDATION DU FORMULAIRE
    if (!check) {
      event.preventDefault();
    }

    // Verification prenom
    if ($("#prenom").val().length < 2 || $("#prenom").val().length > 25 ) {
      console.log("prenom");
      check = false;
    }

    // Verification nom
    if ($("#nom").val().length < 2 || $("#nom").val().length > 25 ) {
      console.log("nom");
      check = false;
    }

    // Verification adresse
    if ($("#adresse").val().length < 2 || $("#adresse").val().length > 50 ) {
      console.log("adresse");
      check = false;
    }

    // Verification ville
    if ($("#ville").val().length < 2 || $("#ville").val().length > 50 ) {
      console.log("ville");
      check = false;
    }

    // Verification mail
    var modeleMail = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    if (!modeleMail.test($("#mail").val())) {
      console.log("mail");
      check = false;
    }

    // Verification mot de passe
    var mdp = $("#mdp");
    var mdpConfirm = $("#mdpConfirm");
    if (mdp.val() != "" && mdpConfirm.val() != "") {
      if (mdp.val() == mdpConfirm.val()) {
        if ($("#mdp").val().length < 5 || $("#mdp").val().length > 25) {
          console.log("mdp1");
          check = false;
        }
      } else {
        console.log("mdp2");
        check = false;
      }
    } else {
      console.log("mdp3");
      check = false;
    }

    var modeleTel = new RegExp(/^0[1-9]([-. ]?[0-9]{2}){4}$/);
    // Verification n° de tel
    if (!modeleTel.test($("#tel").val())) {
      check = false;
    }

    // Verification du code postal
    var modeleCp = new RegExp(/^[0-9]{5,5}$/)
    if (!modeleCp.test($("#cp").val())) {
      check = false;
    }

    // Complétion du champ coordonnées
    var adresse = $("#adresse").val() + " " + $("#cp").val() + " " + $("#ville").val();
    var geocoder = new google.maps.Geocoder();
    var geoOptions = {
        'address': adresse
    };
    geocoder.geocode(geoOptions, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var coords = results[0].geometry.location;
        $('#location').val(coords);
      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
        check = false;
      }
    });

    check = true;

  })

})
