@extends('layouts.headerMaster')

@section('title')
   Tracking 
@stop

@section('header')
  <li><a href="/adminHome">Home</a></li>
  <li class="active"><a href="/allMessenger">Messenger</a></li>
  <li><a href="/allCashier">Cashier</a></li>
  <li><a href="/rates">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>
 
<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDRJXN8H1l7DsJKHsZCEhgO4u0gTfEXUI&libraries=geometry,drawing,places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

   
    <style>
      #map-canvas{
        position: fixed;
        width: 1000px;
        height: 620px;
        top: -500px;
        left: 450px;
      }
    </style>

<script>
var apiKey = 'AIzaSyDDRJXN8H1l7DsJKHsZCEhgO4u0gTfEXUI';
var map;
var lati;
var lngi;

function initialize() {

  var mapOptions = {
    zoom: 17,
    center: {lat: lati, lng: lngi}
  };

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
   
var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer();

  directionsDisplay.setMap(map);
  calculateAndDisplayRoute(directionsService, directionsDisplay);

  @foreach($track as $transac)
    lati = {{$transac->latitude}}; 
    lngi = {{$transac->longitude}};
  @endforeach

var locate = [
    @foreach($transactions as $location)
            ['{{ $location->address }}<br> {{ $location->details }}', {{ $location->latitude }}, {{ $location->longitude }}],   
    @endforeach
    ];

    var alltransaction = [
    @foreach($alltransactions as $location)
            ['{{ $location->address }}<br> {{ $location->details }}', {{ $location->latitude }}, {{ $location->longitude }}],   
    @endforeach
    ];

  var marker, i;

  marker = new google.maps.Marker({
  position: new google.maps.LatLng(lati,lngi),
  map: map,
  icon: 'images/car.jpg'
  });



     var marker, h;

    for (h = 0; h < locate.length; h++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locate[h][1], locate[h][2]),
        map: map,
        icon: 'images/star.png'
      });

    
    }


runSnapToRoad();

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


// Snap a user-created polyline to roads and draw the snapped path
function runSnapToRoad() {
  var pathValues = [];
  var pathVal = [];
  var pathcon = [];
  var utime;

  @foreach($transactions as $transaction)
    utime = '{{$transaction->updated_at}}';
  @endforeach

  @foreach($track as $transac)
    if('{{$transac->updated_at}}' < utime)
      pathVal.push("{{$transac->latitude}},{{$transac->longitude}}")
    else 
       pathValues.push("{{$transac->latitude}},{{$transac->longitude}}"); 
  @endforeach

 pathcon.push(pathVal[pathVal.length-1]);
 pathcon.push(pathValues[0]);

  $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: pathValues.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
    drawSnappedPolyline();
  });

   $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: pathcon.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
    drawSnappedPolyline();
  });

  $.get('https://roads.googleapis.com/v1/snapToRoads', {
    interpolate: true,
    key: apiKey,
    path: pathVal.join('|')
  }, function(data) {
    processSnapToRoadResponse(data);
    drawSnappedPolyline2();
  });

}

// Store snapped polyline returned by the snap-to-road method.
function processSnapToRoadResponse(data) {
snappedCoordinates = [];
placeIdArray = [];
  for (var i = 0; i < data.snappedPoints.length; i++) {
    var latlng = new google.maps.LatLng(
        data.snappedPoints[i].location.latitude,
        data.snappedPoints[i].location.longitude);
    snappedCoordinates.push(latlng);
    placeIdArray.push(data.snappedPoints[i].placeId);
  }
}

// Draws the snapped polyline (after processing snap-to-road response).
function drawSnappedPolyline() {
  var snappedPolyline = new google.maps.Polyline({
    path: snappedCoordinates,
    strokeColor: 'green',
    strokeWeight: 3
  });

  snappedPolyline.setMap(map);
  polylines.push(snappedPolyline);
}

function drawSnappedPolyline2() {
  var snappedPolyline = new google.maps.Polyline({
    path: snappedCoordinates,
    strokeColor: 'red',
    strokeWeight: 3
  });

  snappedPolyline.setMap(map);
  polylines.push(snappedPolyline);
}

$(window).load(initialize);

setInterval(function myfunction()
{
  $('#btn').click();
}, 10000);

</script>




@stop

@section('content')
<br><br><br><br><br><br>
   <div id="nam">
     <strong>
      @foreach($messengers as $messenger)
       <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$messenger->lname}}, {{$messenger->fname}}</h3>
      <form role="form" method="POST" action="/roads">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      @foreach($pictures as $pic)
      <input type="hidden" name="assignedarea" value="{{$pic->assignedArea}}">
      @endforeach
      <button id="btn" name="btn" value="{{$messenger->userid}}" hidden="hidden"></button>
      </form>
      @endforeach
       </strong>
    </div><br>
  <div>
    <div id="picture">
      @foreach($pictures as $pic)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/{{$pic->picture}}"><br><br>
        </div>
        <div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact: {{$pic->contact}}
        </div>
      @endforeach
    </div>
  
    <br><br><br><br><br>
  </div>
    <div id="map-canvas" align="left"></div>   
  
@stop