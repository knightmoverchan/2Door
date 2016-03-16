<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>
    <!-- start: Meta -->
    <meta charset="utf-8">
    <meta name="description" content="2Door - a JRS express application"/>
    <meta name="keywords" content="Template, Theme, web, html5, css3, Bootstrap" />
    <meta name="author" content="Łukasz Holeczek from creativeLabs"/>
    <!-- end: Meta -->
    
    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link href="/gotya/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="/gotya/css/bootstrap-responsive.css" rel="stylesheet"> -->
    <link href="/gotya/css/style.css" rel="stylesheet">
  <!--   <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
     -->
    
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&libraries=places"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    #map-canvas{
      position: fixed;
      width: 700px;
      height: 480px;
      top: -550px;
      left: 400px;
    }
    </style>

</head>
  
<body>
    
    <!--start: Header -->
  <header>
    
    <!--start: Container -->
    <div class="container">
      
      <!--start: Row -->
      <div class="row">
          
        <!--start: Logo -->
        <div class="logo span3">
            
          <a class="brand" href="#"><img src="/gotya/img/logo.png" alt="Logo"></a>
            
        </div>
        <!--end: Logo -->
          
        <!--start: Navigation -->
        <div class="span9">
          
          <div class="navbar navbar-inverse">
              <div class="navbar-inner">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                      <ul class="nav">
                                    @yield('header')
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>  
    
            </div>
            <!--end: Row -->
            
        </div>
        <!--end: Container-->           
            
    </header>

    @yield('content')

         <div id="map-canvas"></div>   


        </div>               
      </div>   
    </div> 
  </div>
<script>
    
    function initialize() 
    {
    	var cent = [];
        var lat = document.getElementById('lat').value;
        var lng = document.getElementById('lng').value;
        
 		
        if(lat == "" && lng == "")
        {
          var originLat = {{$locations2->latitude}};
          var originLong = {{$locations2->longitude}};
          var latLng = new google.maps.LatLng(originLat, originLong);   

          originAreaBranch(originLat, originLong);
        }
        else
        {
            var latLng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        }
      var map = new google.maps.Map(document.getElementById('map-canvas'), 
      {
        zoom: 8,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: true
      });

      var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));

      google.maps.event.addListener(searchBox, 'places_changed',function(event)
      {
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i,place;

        for(i=0; place=places[i]; i++)
        {
          bounds.extend(place.geometry.location);
          marker.setPosition(place.geometry.location);
        }
          map.fitBounds(bounds);
          map.setZoom(15);
          var inform = bounds.getCenter().toString()
          //kuhaon ang "(" ")"
          var newInfo = inform.slice(1, -1);
          //kuhaon ang comma
          var element = newInfo.split(",")
          document.getElementById('lat').value = element[0];
          document.getElementById('lng').value = element[1];
      })

        // Update current position info.
      updateMarkerPosition(latLng);
      geocodePosition(latLng);

      google.maps.event.addListener(marker, 'drag', function() 
      {            
        updateMarkerPosition(marker.getPosition());
      });

      google.maps.event.addListener(marker, 'dragend', function()
      {         
        geocodePosition(marker.getPosition());
      });
    }
    var geocoder = new google.maps.Geocoder();
    function geocodePosition(pos) 
    {
      geocoder.geocode({
          latLng: pos
        },
        function(responses) 
        {
          if (responses && responses.length > 0) 
          {
            updateMarkerAddress(responses[0].formatted_address);
          }
          else 
          {
            ('Cannot determine');
          }
      });
    }

    function updateMarkerPosition(latLng) 
    {
      document.getElementById('lat').value = latLng.lat();
      document.getElementById('lng').value = latLng.lng();
    }

    function updateMarkerAddress(str) 
    {
      document.getElementById('mapsearch').value = str;
    }


      // Onload handler to fire off the app.
      google.maps.event.addDomListener(window, 'load', initialize);
  </script>
<script>$("form").submit(function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});</script>
  
</body>
</html>