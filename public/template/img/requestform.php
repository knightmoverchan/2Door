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
    <h2 id="hd">Request Form</h2>
    <hr/>
    


 <div class="row">
 <div class="col-md-12">
 <label>Address </label>
 <div class="row">
<div class="col-sm-3"> <input type="email" class="form-control" name="Unit" placeholder="Unit" required></div>
<div class="col-sm-5"> <input type="email" class="form-control" name="Building" placeholder="Building" required></div>
<div class="col-sm-4"><input type="email" class="form-control" name="Street" placeholder="Street" required></div>
</div>
<br>
<div class="row">
<div class="col-sm-6">
 <label>Package Size</label> <select class="form-control" id="month">
    <option>Small (12x12inches or less)</option>
    <option>Medium (24x24inches or less)</option>
    <option>Large (Larger than 24inches)</option>

  </select>
  </div>
</div>

<br>
<div class="row">
<div class="col-sm-3">
 <label>Total Charge</label>
 <input type="email" class="form-control" name="Unit" placeholder="P0.00" disabled="true"></div>
  </div>


<br><br><br><br>


 <div class="col-md-12">
<center> <button type="submit" class="btn btn-default" style="margin-right: 15px;">
Submit Request </button></center>

 </div>

 </div>
 </div>
 </div>
  
  <div class="col-sm-7">
   <div id="map-canvas"></div>
</div>
</div>
  </div>
</body>
	
</html>