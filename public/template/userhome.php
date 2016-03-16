<!DOCTYPE html>
<html lang="en">
<head>
<title>Door 2 Door</title>
 <style>
      #map-canvas {
        width: 750px;
        height: 600px;
      }
    </style>
 <meta charset="utf-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" style="text/css" href="bootstrap/css/styl2.css">
<link rel="stylesheet" style="text/css" href="bootstrap/css/bootstrap.css">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js"></script>

   <script>
    // Create the search box and link it to the UI element.
    
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

<nav class="navbar-inverse">
  <div class="container-fluid">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Login / Register</a></li>
      </ul>
    </div>
  </div>
</nav>

 <div class="navbar navbar-default">
  <div class="navbr-left navbar-brand"></div>
  <div class="navbr-left navbar-brand"></div>
 <div class=" navbar-brand"><img src="log.png"></div>


<div>
<ul class="nav navbar-nav navbar-right">
 <li><a><img class="sml" src="navhome.jpg"></a></li>
 <li><a><img class="sml" src="requestnav.jpg"></a></li>
 <li><a><img class="sml" src="navcontact.jpg"></a></li>
 <li><a><img class="sml" src="navabout.jpg"></a></li>
 <li><img src="navfiller.jpg"></li>


</ul>
</div>


  </div>

  <div class="container-fluid">
<br>
        <div class="row">
    	
    <div class="col-sm-5">
   
<div><img src="picture.jpg"></div>
<br>
<div class="col-md-6">
<button type="submit" class="btn btn-default" style="margin-right: 15px;">
Edit Profile </button>
<button type="submit" class="btn btn-default" style="margin-right: 15px;">
Add Picture </button>
 </div>
<br><br>
  <h2 id="hd">Door 2 Door</h2>
    
    
    Door 2 Door is the easiest way you can have your stuff delivered anytime, anywhere.

<br><br>
 <div class="form-group">
 <div class="col-md-12">
 <center><a href="requestform.php"><button type="submit" class="btn btn-default input-lg" style="margin-right: 15px;">
  Request for Delivery
 </button></a><br><br>

 

 </div>
 </div>
    </div>

  
  <div class="col-sm-7">
   <div id="map-canvas"></div>
   <input id="pac-input"></input>

</div>

    </div>
 
</div>
   



</body>
	
</html>