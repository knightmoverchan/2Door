<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
      #map-canvas {
        width: 750px;
        height: 600px;
      }
    </style>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>

    <script>
   
    
    var marker;
    var map;
  function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      zoom: 14,
    }
    map = new google.maps.Map(mapCanvas, mapOptions);
     if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var image = 'cusicon.png'
     marker = new google.maps.Marker({
        map: map,
        position: pos,
        title: 'Im Here!',
        icon:image
      });

       marker.setAnimation(google.maps.Animation.BOUNCE);


      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

}

   google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </head>
<body>

  <div class="container">
  <div class="jumbotron">
    <h1>Door 2 Door</h1> 
    <p>Delivery requests at ease.</p> 
  </div>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-8"> <div id="map-canvas"></div>
</div>
</div>
   
</div>

</body>
</html>