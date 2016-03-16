

@extends('layouts.headerMaps')

@section('title')
 2Door 
@stop

@section('header')
 <li><a href="cashierhome"> Requests </a></li>
 <li class="active"><a href="receipt">Transactions</a></li>
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
        <br><br><br/><h1>Receipt</h1><br><br>

          <div class="row">
           <div class="span12" style="border: 2px solid green">
          @foreach($transact as $tran)
      
          Receivers Name: <strong> {{ $tran->receiverFname }} {{ $tran->receiverLname }} </strong><br><br>
          Receivers Address: <strong> {{ $tran->address }}</strong><br><br>
         

        
        
              Total Cost: <strong> PHP {{ $tran->cost }}</strong><br><br>
              Package Type: <strong> {{ $tran->type }}</strong><br><br>
              Weight: <strong> {{ $tran->weight }} </strong><br><br>

         @endforeach 


       </div>
    
   
    
     </div>
         
          <br/>  

       
        </div>               
      </div>   
    </div> 
  </div>

@stop


