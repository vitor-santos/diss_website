$(document).ready(function(){
    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();		
    });	
});

$("#business").click(function() {
  $('#map-placeholder').show();
});

$("#operator").click(function() {
  $('#map-placeholder').hide();
});


function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(41.148726, -8.610941);
  var address = document.getElementById('address').value;
  var mapOptions = {
    zoom: 16,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeAddress() {
  var address = document.getElementById('address').value;
  $('#mapsreturn').empty();
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
	  $("#latitude").val(results[0].geometry.location.lat().toString());
	  $("#longitude").val(results[0].geometry.location.lng().toString());	 
    } else {
      document.getElementById('mapsreturn').innerHTML='Não foi possível localizar a morada inserida. Por favor tente novamente ou contacte o administrador.</br>';
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
