@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
  <li><a href="/messengerHome">Home</a></li>
  <li class="active"><a href="/messengerP2P">Point2Point</a></li>
  <li><a href="/messengerProfile">Profile</a></li>
  <li><a href="auth/logout">Log out</a></li>
  
   <style>
    div.img{
      top: 100px;
      right: -150px;
      position: relative;
    }
    
    button.p2p{
      padding: 0;
      border: none;
      background: none;

          }
  </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 

  <script>
    function showlocation()
    {
      navigator.geolocation.watchPosition(callback)
    }
    
    function callback(position)
    {
        
      var geocoder = new google.maps.Geocoder();
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      document.getElementById('latitude').value=latitude;
      document.getElementById('longitude').value=longitude;
      var latLng = new google.maps.LatLng(latitude,longitude);

      geocoder.geocode({       
          latLng: latLng     
        }, 
        function(responses) 
        {     
          if (responses && responses.length > 0) 
          {        
            address(responses[0].formatted_address);     
          } 
          else 
          {       
            alert('Not getting Any address for given latitude and longitude.');     
          }   
        }
      );
    } 

    function address(str) 
    {
      document.getElementById('add').value = str;
    }

  </script>
@stop

@section('content')
<body onload="showlocation()">
  <div class="img">
    <form action="/messengerP2P" role="form" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="currentAddress" id="add">
      <button class="p2p"><a><img src="gotya/img/p2p.png"></a></button>
    </form>
    <form action="/track" role="form" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id" value="{{$messenger_id}}">
      <input type="hidden" name="latitude" id="latitude">
      <input type="hidden" name="longitude" id="longitude">
      <button id="track" hidden="hidden"></button>

    </form>

    <br/>
  </div>
<script type="text/javascript">

setTimeout(myfunction, 10000);

function myfunction()
{
  $('#track').click();
}
</script>
<script type="text/javascript">
</script>
  <br/><br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/>
          <br/><div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sender Name</th>
                                            <th>Receiver Name</th>
                                            <th>Receiver's Address</th>
                                            <th>Signature SMS</th>
                                        </tr>
                                    <tbody> 
                                    </thead>
                                        <tr>
                                          @foreach($transactions as $transaction)
                                            @if($transaction->status != "Delivered")
                                              @foreach($senderName as $sname)
                                                @if($transaction->senderid == $sname->userid)
                                                <td>{{$transaction->id}}</td>
                                                <td>{{$sname->fname." ".$sname->lname}}</td>
                                                  <td>{{$transaction->receiverFname." ".$transaction->receiverLname}}</td>
                                                  <td>{{$transaction->address}}</td>
                                                  <td>
                                                    <a class="btn btn-success btn-xs" href="{{ URL::to('statusDelivered' . $transaction->id) }}" title="Send Receiver"><i class="fa fa-pencil" >Confirm Delivery</i></a>
                                                  </td>
                                               <br/>
                                          </tr> 
                                      </tbody>
                                                @endif
                                              @endforeach
                                            @endif
                                          @endforeach
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
@stop

