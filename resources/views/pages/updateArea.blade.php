@extends('layouts.headerMaps1')

@section('title')
 2Door 
@stop

@section('header')
  <li><a href="/adminHome">Home</a></li>
  <li><a href="/allMessenger">Messenger</a></li>
  <li><a href="/allCashier">Cashier</a></li>
  <li class="active"><a href="/addArea">Add Area</a></li>
  <li><a href="/rates">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>

  
<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

@stop

@section('content')
<style>
	#map-canvas{
		top:-300px;

	}
</style>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChO-fq_hhwZjwYrrwerNUF4qjgic7YOUE&libraries=geometry,places"></script>

  <script>
    function originAreaBranch(lat, lng)
    {
        var origin = new google.maps.LatLng(lat, lng);

        var main = [];
        var reg = [];
        var brn = [];



      @foreach($branches as $branch)
        main.push(new google.maps.LatLng('{{ $branch->latitude }}', '{{ $branch->longitude }}'));
        reg.push('{{ $branch->area }}');
        brn.push('{{ $branch->branch }}');
      @endforeach

      var distance = [];

      for(var m = 0; m < main.length; m++){
        distance.push(google.maps.geometry.spherical.computeDistanceBetween(main[m], origin));
      };

      var branch = 0;
      var region = 0;

      for(var y = 0; y < distance.length-1; y++){
        if(distance[y] < distance[y+1]){
          region = reg[y];
          branch = brn[y];
          distance[y+1]=distance[y];
          reg[y+1] = reg[y];
          brn[y+1] = brn[y]; 
          } 
        else{
           region = reg[y+1];
           branch = brn[y+1];
           }
          
    };
        document.getElementById('originBranch').value = branch;
        document.getElementById('originArea').value = region;
  suggest(branch, region);
      }

      function suggest(branch, region){
        if(branch == 1)
          var cheer = 'North';
        else if(branch == 2)
          var cheer = 'Main';
        else if(branch == 3)
          var cheer = 'South';
        else
          var cheer = 'Southest';



      }
  </script>
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Update Assigned</h1>

          @if(count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whooops!</strong>There's an error!
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          @endif

          

          {!!Form::open(array('url' => '/areaUpdate'.$receiver->id ,'onkeypress'=>'return event.keyCode != 13'))!!}
          <br/>  
            {!! Form::label('Name'); !!}
            {!! Form::text('areaName', $receiver->assigned, array('class' => 'form-control', 'placeholder' => 'Area Name')); !!} 

            <br/> {!! Form::hidden('sender_id',$sender_id); !!}
             {!! Form::hidden('originArea','', array('id'=>'originArea')); !!}
             {!! Form::hidden('originBranch','', array('id'=>'originBranch')); !!}

            {!! Form::hidden('latitude','',array('id'=>'lat')); !!}
            <br/> {!! Form::hidden('longitude','',array('id'=>'lng')); !!}
            <br/>
            <br/>
            <br/>
            <br/>
            
           

            <br/>{!! Form::submit() !!}
@stop