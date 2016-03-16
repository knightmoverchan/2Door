@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
  <li class="active"><a href="/messengerHome">Home</a></li>
  <li><a href="/messengerP2P">Point2Point</a></li>
  <li><a href="/messengerProfile">Profile</a></li>
  <li><a href="auth/logout">Log out</a></li>
  
@stop

@section('content')
<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 70%;
        left: 220px;
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
    <div id="right-panel"><div id="directions-panel"></div></div>
    
    <script type="text/javascript">
    
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer();
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
  var branch = [];
  var tran = [];
  var north = [];
  var east = [];
  var west = [];
  var south = [];
  var ass = [];
  var nways = [];
  var eways = [];
  var wways = [];
  var sways = [];
  var l =0;
  var nnorth = [];
  var north1 = [];
  var east1 = [];
  var west1 = [];
  var south1 = [];
  var zz = [];
    var count = 0;

  function indexOfSmallest(a, g) {
 var lowest = 0;
 for (var i = 0; i < a.length; i++) {
  if (a[i] == g) lowest = i;
 }
 return lowest;
}



  @foreach($address as $addresses)
  @foreach($user as $msgs)
  @if($addresses->branch == $msgs->branch && $addresses->area == $msgs->area)
    loc.push("{{$addresses->latitude}}, {{$addresses->longitude}}"); 
  @endif
  @endforeach    
  @endforeach
  
  @foreach($branch as $branch)
  @foreach($user as $msgs)
  @if($branch->branch == $msgs->branch && $branch->area == $msgs->area)
    branch.push("{{$branch->latitude}}, {{$branch->longitude}}"); 
  @endif
  @endforeach     
  @endforeach

  @foreach($assignedArea as $assignedArea)
    ass.push(new google.maps.LatLng('{{ $assignedArea->latitude }}', '{{ $assignedArea->longitude }}'));
    zz.push('{{$assignedArea->assigned}}');
  @endforeach

  var assignedArea;
  @foreach($msg as $msgs123)
  	assignedArea = "{{$msgs123->assignedArea}}";
  @endforeach

  var h = zz.indexOf(assignedArea);
  @foreach($trans as $trans)
    tran.push(new google.maps.LatLng('{{ $trans->latitude }}', '{{ $trans->longitude }}'));
  @endforeach
 
  @foreach ($trans1 as $trans123)
  for(var k=0; k<ass.length;k++){
  	north.push(google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng('{{ $trans123->latitude }}', '{{ $trans123->longitude }}'), ass[k]));
  }
  var par = [];
  var sty = [];
  for(var t=0; t<north.length;t++){
  	 par.push(parseFloat(north[t]));
  	 sty.push(parseFloat(north[t]));
  }
  var s;
  for(var b=0; b<par.length-1;b++){
  	if(par[b]<par[b+1]){
  		par[b+1]=par[b];
  		s=par[b];
  	}
  	else
  		s=par[b+1];
  }
  var lowest = indexOfSmallest(sty, s);
  north = [];

  	if(lowest == h)
  		north1.push(tran[count])
  	
  count++;

  @endforeach

   for(var i=0; i<north1.length;i++){
      waypts.push({
        location: north1[i],
        stopover: true
      });
  	} 
  	
  	
  	
  directionsService.route({
    origin: branch[0],
    destination: branch[0],
    waypoints: waypts,
    optimizeWaypoints: true,
    provideRouteAlternatives: true,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status1) {
    if (status1 === google.maps.DirectionsStatus.OK) {
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChO-fq_hhwZjwYrrwerNUF4qjgic7YOUE&libraries=geometry"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&callback=initMap"
        async defer></script>
  </body>
@stop

