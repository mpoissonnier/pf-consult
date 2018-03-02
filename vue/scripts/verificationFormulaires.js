$(document).ready(function() {
  // AutoCompletion du code postal
  $("#cp, #ville").autocomplete({
    source: function (request, response) {
      var objData = {};
      if ($(this.element).attr('id') == 'cp') {
        objData = { codePostal: request.term,  maxRows: 10 };
      } else {
        objData = { commune: request.term, maxRows: 10 };
      }
      $.ajax({
        url: "./modele/dao/codePostalComplete.php",
        dataType: "json",
        data: objData,
        type: 'GET'}).done(function (data) {
          response($.map(data, function (item) {
            console.log(data);
            return {
              label: item.CodePostal + ", " + item.Ville,
              value: function () {
                if ($(this).attr('id') == 'cp') {
                  $('#ville').val(item.Ville);
                  return item.CodePostal;
                } else {
                  $('#cp').val(item.CodePostal);
                  return item.Ville;
                }
              }
            }
          }));
        })
      },
      minLength: 3,
      delay: 600
    });


    // Validation du formulaire d'inscription
    var validForm = false;
    $("#formInscription").on('submit', function(event) {
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

      // Verification n° de tel
      var modeleTel = new RegExp(/^0[1-9]([-. ]?[0-9]{2}){4}$/);
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

    // Affichage de la specialite
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
    // }

    // if ($(location).attr('href') == "http://infoweb/~pf-consult/index.php?monCompte" || $(location).attr('href') == "http://infoweb/~pf-consult/index.php?monCompte=1") {
    // Validation du formulaire de modifications
    var validFormModif = false;
    $("#formModif").on('submit', function(event) {
      if (!validFormModif) {
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
      }

      // Verification n° de tel
      var modeleTel = new RegExp(/^0[1-9]([-. ]?[0-9]{2}){4}$/);
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
        validFormModif = true;
      }
    });

    // Validation du formulaire d'inscription de proche
    var validFormProche = false;
    $("#formProche").on('submit', function(event) {
      if (!validFormProche) {
        event.preventDefault();
      }

      check = true;

      // Verification prenom
      if ($("#prenomP").val().length < 2 || $("#prenomP").val().length > 25 ) {
        $("#prenomP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#prenomP").css({
          border : "solid green 2px"
        });
      }

      // Verification nom
      if ($("#nomP").val().length < 2 || $("#nomP").val().length > 25 ) {
        $("#nomP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#nomP").css({
          border : "solid green 2px"
        });
      }

      // Verification adresse
      if ($("#adresseP").val().length < 2 || $("#adresseP").val().length > 50 ) {
        $("#adresseP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#adresseP").css({
          border : "solid green 2px"
        });
      }

      // Verification ville
      if ($("#villeP").val().length < 2 || $("#villeP").val().length > 50 ) {
        $("#villeP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#villeP").css({
          border : "solid green 2px"
        });
      }

      // Verification n° de tel
      var modeleTel = new RegExp(/^0[1-9]([-. ]?[0-9]{2}){4}$/);
      if (!modeleTel.test($("#telP").val())) {
        $("#telP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#telP").css({
          border : "solid green 2px"
        });
      }

      // Verification du code postal
      var modeleCp = new RegExp(/^[0-9]{5,5}$/)
      if (!modeleCp.test($("#cpP").val())) {
        $("#cpP").css({
          border : "solid red 2px"
        });
        check = false;
      } else {
        $("#cpP").css({
          border : "solid green 2px"
        });
      }

      // Complétion du champ coordonnées
      var adresse = $("#adresseP").val() + " " + $("#cpP").val() + " " + $("#villeP").val();
      var geocoder = new google.maps.Geocoder();
      var geoOptions = {
        'address': adresse
      };
      geocoder.geocode(geoOptions, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var coords = results[0].geometry.location;
          $('#locationP').val(coords);
        } else {
          console.log('Geocode was not successful for the following reason: ' + status);
          check = false;
        }
      });

      if (check) {
        validFormProche = true;
      }
    });
    // }


  })
