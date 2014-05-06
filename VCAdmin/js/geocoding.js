  function getAddress() {
    var latitude_string = document.getElementById("latitude").value;
    var longitude_string = document.getElementById("longitude").value;
    var geocoder = new google.maps.Geocoder();
    var lat = parseFloat(latitude_string);
    var lng = parseFloat(longitude_string);
    var latlng = new google.maps.LatLng(lat, lng);
    
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          if (results[i]) {
            document.getElementById("address").value = results[i].formatted_address;
            break;
          }
        };
        
      } else {
        
      }
    });
  }

  function getCoordinates() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById('address').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var lat = results[0].geometry.location.lat();
        var lng = results[0].geometry.location.lng();
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
        document.getElementById("coordinate").href = "https://www.google.com/maps/?q=" + encodeURIComponent(address) + "@" + lat + "," + lng;
    document.getElementById("coordinate").className = " ";

      } else {
        
      }
    });
  }

  function updateLink() {
    var address = document.getElementById('address').value;
    var lat = document.getElementById("latitude").value;
    var lng = document.getElementById("longitude").value;
    document.getElementById("coordinate").href = "https://www.google.com/maps/?q=" + encodeURIComponent(address) + "@" + lat + "," + lng;
    document.getElementById("coordinate").className = " ";

  }