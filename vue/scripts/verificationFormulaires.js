$(document).ready(function() {
  // Verification du formulaire d'inscription
  if ($(location).attr('href') == "http://infoweb/~pf-consult/index.php?inscription=user" || $(location).attr('href') == "http://infoweb/~pf-consult/index.php?inscription=pro") {
    var validForm = false;
    $("#formInscription").on('submit', function(event) {
      // VALIDATION DU FORMULAIRE
      if (!validForm) {
        event.preventDefault();
      }

      check = true;

      // Verification prenom
      if ($("#prenom").val().length < 2 || $("#prenom").val().length > 25 ) {
        $("#prenom").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#prenom").css({
          border : "solid green 2px"
        });
      }

      // Verification nom
      if ($("#nom").val().length < 2 || $("#nom").val().length > 25 ) {
        $("#nom").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#nom").css({
          border : "solid green 2px"
        });
      }

      // Verification adresse
      if ($("#adresse").val().length < 2 || $("#adresse").val().length > 50 ) {
        $("#adresse").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#adresse").css({
          border : "solid green 2px"
        });
      }

      // Verification ville
      if ($("#ville").val().length < 2 || $("#ville").val().length > 50 ) {
        $("#ville").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#ville").css({
          border : "solid green 2px"
        });
      }

      // Verification mail
      var modeleMail = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
      if (!modeleMail.test($("#mail").val())) {
        $("#mail").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#mail").css({
          border : "solid green 2px"
        });
      }

      // Verification mot de passe
      var mdp = $("#mdp");
      var mdpConfirm = $("#mdpConfirm");
      if (mdp.val() != "" && mdpConfirm.val() != "") {
        if (mdp.val() == mdpConfirm.val()) {
          if ($("#mdp").val().length < 5 || $("#mdp").val().length > 25) {
            $("#mdp").css({
              border : "solid red 2px"
            });
            $("#mdpConfirm").css({
              border : "solid red 2px"
            });
            check = false;
          } else {
            $("#mdp").css({
              border : "solid green 2px"
            });
            $("#mdpConfirm").css({
              border : "solid green 2px"
            });
          }
        } else {
          $("#mdp").css({
            border : "solid red 2px"
          });
          $("#mdpConfirm").css({
            border : "solid red 2px"
          });
          check = false;
        }
      } else {
        $("#mdp").css({
          border : "solid red 2px"
        });
        $("#mdpConfirm").css({
          border : "solid red 2px"
        });
        check = false;
      }

      var modeleTel = new RegExp(/^0[1-9]([-. ]?[0-9]{2}){4}$/);
      // Verification n° de tel
      if (!modeleTel.test($("#tel").val())) {
        $("#tel").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#tel").css({
          border : "solid green 2px"
        });
      }

      // Verification du code postal
      var modeleCp = new RegExp(/^[0-9]{5,5}$/)
      if (!modeleCp.test($("#cp").val())) {
        $("#cp").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#cp").css({
          border : "solid green 2px"
        });
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

      if (check) {
        validForm = true;
      }
    });

    // Affichage de la specialiste
    $("#specialite").on('change', function() {
      if ($("#specialite").val() == "autre") {
        $(".spe").show();
        $("#domaine").on('change', function() {
          if ($("#domaine").val() == "MEDICAL") {
            $("#speMedecine").show();
            $("#speJuridique").hide();
          } else if ($("#domaine").val() == "JURIDIQUE") {
            $("#speMedecine").hide();
            $("#speJuridique").show();
          }
        })
      } else {
        $(".spe").hide();
      }
    })
  }


})
