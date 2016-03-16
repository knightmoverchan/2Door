@extends('layouts.headerMaps')

@section('title')
 2Door 
@stop

@section('header')
  <li><a href="senderHome">Home</a></li>
  <li class="active"><a href="requestForm">Request Delivery</a></li>
  <li><a href="rates2">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>

  <style>
    div.alert-success{
      width: 300px;
    }
  </style>
@stop

@section('content')
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

        document.getElementById('sug').innerHTML = 'You can drop your package/parcel at <br/><strong> JRS '+region+' '+cheer+' branch.</strong>'

      }
  </script>
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Request Delivery</h1>

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

          

          {!!Form::open(array('url' => '/requestForm' ,'onkeypress'=>'return event.keyCode != 13'))!!}
          <br/>  
            <div id="sug" class="alert alert-success"></div>
            Actual Branch to Drop-off<br/>
            {!! Form::select('originBranch',array('1'=>"North",'2'=>"Main",'3'=>"South"),
            "",array('id'=>'originBranch'));!!}
            {!! Form::label('Receiver First Name'); !!}
            {!! Form::text('receiverFname', '', array('class' => 'form-control', 'placeholder' => 'First')); !!} 
                        
            {!! Form::label('Last Name'); !!}
            {!! Form::text('receiverLname', '', array('class' => 'form-control', 'placeholder' => 'Last')); !!}

            <br/> {!! Form::hidden('sender_id',$sender_id); !!}
             {!! Form::hidden('originArea','', array('id'=>'originArea')); !!}

            {!! Form::label('Address'); !!}
            {!! Form::text('receiverAddress', '', array('class' => 'form-control', 'placeholder' => 'Address', 'id'=>'mapsearch')); !!}

            {!! Form::hidden('latitude','',array('id'=>'lat')); !!}
            <br/> {!! Form::hidden('longitude','',array('id'=>'lng')); !!}
             
            {!! Form::label('Contact Number'); !!}
            {!! Form::text('receiverContact', '', array('class' => 'form-control', 'placeholder' => 'Phone Number')); !!}
         
            {!! Form::label('Package Type'); !!}
            {!! Form::select('packType', array('1pounder' => '1pounder', '3pounder' => '3pounder', '5pounder' => '5pounder', 'Extra Small Box' => 'Extra Small Box', 'Express Box Small' => 'Express Box Small', 'Express Box Medium' => 'Express Box Medium', 'Express Box Large' => 'Express Box Large', 'Express Cargo' => 'Express Cargo', 'General Cargo' => 'General Cargo')); !!}
            
            {!! Form::label('Item Description'); !!}
            {!! Form::textarea('description', '', array('class' => 'form-control', 'placeholder' => 'Description', 'rows'  => '3')); !!}

            <br/>{!! Form::submit() !!}
@stop


