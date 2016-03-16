@extends('layouts.headerMaster')

@section('title')
 2Door 
@stop
<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        float: left;
        text-align: left;
        padding-top: 20px;
      }
      #directions-panel {
        margin-top: 20px;
        background-color: #FFEE77;
        padding: 10px;
      }
    </style>
    <body>
    <div id="map"></div>
    
    <script type="text/javascript">
    
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: {lat: 10.296653000000004, lng: 123.8987343411045}
  });
  directionsDisplay.setMap(map);

    calculateAndDisplayRoute(directionsService, directionsDisplay);

}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts = [];
  var loc = [];
  @foreach($address as $addresses)
  @foreach($user as $msgs)
  @if($addresses->branch == $msgs->branch && $addresses->area == $msgs->area)
    loc.push("{{$addresses->latitude}}, {{$addresses->longitude}}"); 
  @endif
  @endforeach     
  @endforeach
  

  for(var i=0; i<loc.length;i++){    
      waypts.push({
        location: loc[i],
        stopover: true
      });
    }
  directionsService.route({

    origin: "10.296653000000004, 123.8987343411045",
    destination: "10.296653000000004, 123.8987343411045",
    waypoints: waypts,
    optimizeWaypoints: true,
    provideRouteAlternatives: true,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&callback=initMap"
        async defer></script>
  </body>