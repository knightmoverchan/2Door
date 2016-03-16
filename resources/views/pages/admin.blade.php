@extends('layouts.headerMaster')

@section('title')
   Branches & Requests
@stop

@section('header')

    <li class="active"><a href="/adminHome">Home</a></li>
    <li><a href="/allMessenger">Messenger</a></li>
    <li><a href="/allCashier">Cashier</a></li>
    <li><a href="/rates">Delivery Rates</a></li>
    <li><a href="/addArea">Add Area</a></li>
    <li><a href="auth/logout">Log out</a></li>
   
<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript" src="gotya/js/jquery.checkAll.js"></script>
  <script src="/gotya/js/tabcontent.js" type="text/javascript"></script>
  <script src="/gotya/template1/tabcontent.css" type="text/javascript"></script>

@stop

@section('content')
  Welcome Admin <strong>{{$branchType}} {{$adminArea}} ({{$adminBranch}})</strong>!
    <div id="users">
      <div style="position:absolute;top:10px;left: 50px; width: 500px; margin: 0 auto; padding: 120px 0 40px;">
        <ul class="tabs" data-persist="true">
          <strong>
            <a href="#view1">OUTGOING</a>/ 
            <a href="#view2">INCOMING</a>
          </strong><br/>
        </ul>
        
        <div class="tabcontents">
  
          <div id="view1">
              
              {!!Form::open(array('url' => '/submitTransaction' ,'onkeypress'=>'return event.keyCode != 13'))!!}
                <table class="table table-hover" style="position: absolute; top:150px;width: 600px; left: 100px">
                  <thead>
                    <tr>
                      <th><input class="check-all-callback" type="checkbox"></th>
                      <th>#</th>
                      <th>Description</th>
                      <th>Package Type</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                    <tbody class="list">
                      {!! Form::hidden('branchType', $branchType)!!}
                      {!! Form::hidden('type',"Outgoing")!!}  
                      @foreach($transOut as $transaction) 
                          <tr>
                            @if($transaction->area == $adminArea)
                              @if($transaction->branch == $adminBranch)
                                <td></td>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td> 
                                @if($adminBranch == "2")
                                  <td>To Messengers({{$transaction->assign}})</td>
                                @elseif($transaction->area == $adminArea && $transaction->branch == $adminBranch)
                                  <td>To Messenger({{$transaction->assign}})</td>
                                @else
                                  <td>To {{$transaction->area}} Main Branch</td>
                                @endif 
                              @else
                                <td><input type="checkbox" name="transactions[]" value="{{$transaction->id}}"></td>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td> 
                                @if($adminBranch == "2")
                                  <td>To {{$transaction->branchName}} Sub-Branch</td>
                                @else
                                  <td>To {{$transaction->area}} Main Branch</td>
                                @endif 
                              @endif
                            @else
                             <td><input type="checkbox" name="transactions[]" value="{{$transaction->id}}"></td>
                             
                              <td>{{$transaction->id}}</td>
                              <td>{{$transaction->description}}</td>
                              <td>{{$transaction->type}}</td> 
                              @if($adminArea == $transaction->areaOrigin && $adminBranch != 2)
                              <td>To {{$transaction->areaOrigin}} Main Branch</td>
                              @else
                              <td>To {{$transaction->areaOrigin}} Port</td>
                              @endif
                            @endif 
                            <br/>
                          </tr>                     
                      @endforeach

                    </tbody>   
                    <button class="btn btn-success" style="position: absolute; top: 200px;">Dispatch</button> 
                </table><ul class="pagination" style="position: relative;left:400px; top: 350px;"></ul>
        
              {!! Form::close()!!}
            </div> 

            <div id="view2">
              {!!Form::open(array('url' => '/submitTransaction' ,'onkeypress'=>'return event.keyCode != 13'))!!}
                <table class="table table-hover" style="position: absolute; top:150px;width: 600px; left: 100px">
                  <thead>
                    <tr>
                      <th><input class="check-all-callback" type="checkbox"></th>
                      <th>#</th>
                      <th>Description</th>
                      <th>Package Type</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    @foreach($transIn as $transaction) 
                       <tr>
                            @if($transaction->area == $adminArea)
                              @if($transaction->branch == $adminBranch)
                                <td></td>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td> 
                                <td>To Messengers({{$transaction->assign}})</td> 
                              @else
                                <td><input type="checkbox" name="transactions[]" value="{{$transaction->id}}"></td>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td> 
                                <td>To {{$transaction->branchName}} Sub-Branch</td>  
                              @endif
                            @else
                             <td><input type="checkbox" name="transactions[]" value="{{$transaction->id}}"></td>        
                              <td>{{$transaction->id}}</td>
                              <td>{{$transaction->description}}</td>
                              <td>{{$transaction->type}}</td> 
                              <td>To {{$transaction->areaOrigin}} Port</td>
                            @endif 
                            <br/>
                          </tr>                    
                      @endforeach
                    {!! Form::hidden('branchType',$branchType)!!}
                    {!! Form::hidden('type',"Incoming")!!}
                  </tbody>   
                <button class="btn btn-success" style="position: absolute; top: 200px;">Dispatch</button> 
              </table><ul class="pagination" style="position: relative;left:400px; top: 1000px;"></ul>
            {!! Form::close()!!}                
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
    // Callback usage
    $('.check-all-callback').checkAll({
      onMasterClick: function($master_checkbox, $scope) {
        console.log($master_checkbox);
        console.log($scope);
      },
          
    });
  </script>

  <div id="map" style="width: 600px; height: 500px; right: 30px; top: 100px; position: absolute;"></div>

  <script type="text/javascript">
   
   var locations = [
    @foreach($locations as $location)
            ['{{ $location->address }}<br> {{ $location->details }}', {{ $location->latitude }}, {{ $location->longitude }}],   
    @endforeach
    ];

     var requests = [
    @foreach($requests as $request)
            ['{{ $request->address }}', {{ $request->latitude }}, {{ $request->longitude }}],   
    @endforeach
    ];
    var areas = [
    @foreach($areas as $area)
            [{{ $area->latitude }}, {{ $area->longitude }}],   
    @endforeach
    ];


    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: locations[0][1], lng: locations[0][2]},
      zoom: 11,
      mapTypeId: google.maps.MapTypeId.ROADMAP

    });


    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'images/building.png'
      });

    
    }
    var marke, b;

    for (b = 0; b < areas.length; b++) {  
      marke = new google.maps.Marker({
        position: new google.maps.LatLng(areas[b][0], areas[b][1]),
        map: map,
        icon: '/images/request.png'
      });

    } 

    var mark, x;

    for (x = 0; x < requests.length; x++) {  
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
   
  </script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  
  <script src="http://listjs.com/no-cdn/list.js"></script>
  <script src="http://listjs.com/no-cdn/list.pagination.js"></script>
  
  <script type="text/javascript">

  
  </script>

  <a style="top: 120px;left: 470px; position: absolute;" href="/allTransReports">>> View Transaction Reports</a>
@stop

