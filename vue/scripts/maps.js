function initMap() {
  $(document).ready(function () {
    // Initialisation de la carte
    var center = {
       lat: 48.85341,
       lng: 2.3488
    };
    var mapOptions = {
        center: center,
        zoom: 10
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Initialisation des limites de la carte
    var bounds = new google.maps.LatLngBounds();

    // Récuperation des données
    var objData = {};
    objData = { specialiste : $("#specialiste").val(), ville : $("#ville").val(), };
    $.ajax({
      url: "./modele/dao/jsonRecherche.php",
      dataType: "json",
      data: objData,
      type: 'GET'
    })
    .done(function (data) {
      $(data).each(function(ind, item) {
        var location = item.location.split(", ");
        var latLng = new google.maps.LatLng(location[0], location[1]);
        // Affichage des marqueurs
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
        });
        bounds.extend(latLng);
      })
    })
    // Ajout des limites à la carte
    map.fitBounds(bounds);

  });
}
