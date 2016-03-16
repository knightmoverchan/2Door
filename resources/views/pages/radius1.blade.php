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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=drawing,places"></script>
   
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



  var mapOptions = {
    zoom: 17,
    center: {lat: lati, lng: lngi}
  };

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker, i;

  marker = new google.maps.Marker({
  position: new google.maps.LatLng(lati,lngi),
  map: map,
  icon: 'images/car.jpg'
  });


    var marker, a;

    for (a = 0; a < alltransaction.length; a++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(alltransaction[a][1], alltransaction[a][2]),
        map: map,
        icon: 'images/request.png'
      });

    
    }

     var marker, h;

    for (h = 0; h < locate.length; h++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locate[h][1], locate[h][2]),
        map: map,
        icon: 'images/request.png'
      });

    
    }


runSnapToRoad();

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
}, 5000);

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