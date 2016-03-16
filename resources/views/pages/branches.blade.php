<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Branches</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChO-fq_hhwZjwYrrwerNUF4qjgic7YOUE&libraries=geometry"></script>
</head> 
<body>
  <div id="map" style="width: 800px; height: 650px;"></div>

  <script type="text/javascript">
   var count = 0;
   var requests = [
  @foreach($requests as $request)
          ['{{ $request->receiverAddress }}', {{ $request->latitude }}, {{ $request->longitude }}],   
  @endforeach
  ];
  
  var infowindow = new google.maps.InfoWindow();


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: {lat: 10.267381, lng: 123.844335},
      mapTypeId: google.maps.MapTypeId.ROADMAP

    });

  var marker = new google.maps.Marker({
    position: {lat: 10.267381, lng: 123.844335},
    map: map,
    title: 'Main Branch 1'
  });

  var marker2 = new google.maps.Marker({
    position: {lat: 9.959547, lng: 123.503024},
    map: map,
    title: 'Main Branch 2'
  });

  var marker3 = new google.maps.Marker({
    position: {lat: 10.825903, lng: 123.955318},
    map: map,
    title: 'Main Branch 3'
  });


  var main1 = new google.maps.LatLng('10.267381', '123.844335');
  var main2 = new google.maps.LatLng('9.959547', '123.503024');
  var main3 = new google.maps.LatLng('10.825903', '123.955318');

  var distance1 = google.maps.geometry.spherical.computeDistanceBetween(main1, main2);
  var distance2 = google.maps.geometry.spherical.computeDistanceBetween(main1, main3);

    var mark, x;

    for (x = 0; x < requests.length; x++) {  
      var req = new google.maps.LatLng(requests[x][1], requests[x][2]);
      var dista1 = google.maps.geometry.spherical.computeDistanceBetween(main1, req);

      if(dista1 < distance1 && dista1 < distance2){
      mark = new google.maps.Marker({
        position: new google.maps.LatLng(requests[x][1], requests[x][2]),
        map: map,
        icon: 'images/reqicon.png'
      });

      google.maps.event.addListener(mark, 'click', (function(mark, x) {
        return function() {
          infowindow.setContent(requests[x][0]);
          infowindow.open(map, mark);
        }
      })(mark, x));
     }
    }

   
  
  </script>

</body>

</html>