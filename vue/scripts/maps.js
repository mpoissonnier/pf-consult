function geolocaliseAdresse(adresse) {
  var geocoder = new google.maps.Geocoder();
  var geoOptions = {
      'address': adresse
  };
  geocoder.geocode(geoOptions, function(results, status) {
  	if (status == google.maps.GeocoderStatus.OK) {
    	var coords = results[0].geometry.location;
      alert(coords);
		}
  });
}
