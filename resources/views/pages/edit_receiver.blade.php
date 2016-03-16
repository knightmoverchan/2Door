@extends('layouts.headerMaps')

@section('title')
 2Door 
@stop

@section('header')
  <li><a href="senderHome">Home</a></li>
  <li class="active"><a href="requestForm">Request Delivery</a></li>
  <li><a href="rates2">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>
@stop

@section('head')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&libraries=places"></script>
   

@stop

@section('content')
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Request Delivery</h1>
          <br/>  
           <label>Transaction No: {{ $results->id}} </label> 
  
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

          {!!Form::open(array('url' => '/receiverUpdate'.$results->id ,'onkeypress'=>'return event.keyCode != 13'))!!}
          <br/>  

            {!! Form::label('Receiver First Name'); !!}
            {!! Form::text('receiverFname', $results->receiverFname, array('class' => 'form-control')); !!} 
                        
            {!! Form::label('Last Name'); !!}
            {!! Form::text('receiverLname', $results->receiverLname, array('class' => 'form-control')); !!}
            {!! Form::hidden('sender_id',$results->sender_id); !!}
            {!! Form::label('Address'); !!}
            {!! Form::text('receiverAddress', $results->receiverAddress, array('class' => 'form-control', 'id'=>'mapsearch')); !!}

            {!! Form::hidden('latitude',$results->latitude,array('id'=>'lat')); !!}
            <br/> {!! Form::hidden('longitude',$results->longitude,array('id'=>'lng')); !!}
            
            {!! Form::label('Contact Number'); !!}
            {!! Form::text('receiverContact', $results->receiverContact, array('class' => 'form-control')); !!}
            
            {!! Form::label('Package Type'); !!}
            {!! Form::select('packType', array('1pounder' => '1pounder', '3pounder' => '3pounder', '5pounder' => '5pounder', 'Extra Small Box' => 'Extra Small Box', 'Express Box Small' => 'Express Box Small', 'Express Box Medium' => 'Express Box Medium', 'Express Box Large' => 'Express Box Large', 'Express Cargo' => 'Express Cargo', 'General Cargo' => 'General Cargo'), $results->packType); !!}
            
            {!! Form::label('Item Description'); !!}
            {!! Form::textarea('description', $results->description, array('class' => 'form-control', 'rows' => '3')); !!}
            <br/>
            {!! Form::submit('Update'); !!}
                           
          {!!Form::close()!!}

@stop


