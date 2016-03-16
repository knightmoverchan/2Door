@extends('layouts.headerMaster')

@section('title')
 2Door 
@stop

@section('header')
  <li><a href="/adminHome">Home</a></li>
  <li><a href="/allMessenger">Messenger</a></li>
  <li><a href="/allCashier">Cashier</a></li>
  <li class="active"><a href="/rates">Delivery Rates</a></li>
    <li><a href="/addArea">Add Area</a></li>
  
  <li><a href="/auth/logout">Log out</a></li>
@stop

@section('head')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&libraries=places"></script>
  <script src="jquery-1.12.0.min.js"></script>  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function () {
  $('#1pounder').show();
  $('#3pounder').hide();
  $('#5pounder').hide();
  $('#ExtraSmallBox').hide();
  $('#ExpressBoxSmall').hide();
  $('#ExpressBoxMedium').hide();
  $('#ExpressBoxLarge').hide();
  $('#GeneralCargo').hide();
    $('#myselect').change(function() {
      if ($(this).val() == "1pounder") {
        $('#1pounder').show();
        $('#3pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
         } 
      else if ($(this).val() == "3pounder"){
        $('#3pounder').show();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
      }
      else if ($(this).val() == "5pounder"){
        $('#5pounder').show();
        $('#1pounder').hide();
        $('#3pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
      }
      else if ($(this).val() == "ExtraSmallBox"){
        $('#ExtraSmallBox').show();
        $('#3pounder').hide();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
      }
      else if ($(this).val() == "ExpressBoxSmall"){
        $('#ExpressBoxSmall').show();
        $('#3pounder').hide();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
      }
      else if ($(this).val() == "ExpressBoxMedium"){
        $('#ExpressBoxMedium').show();
        $('#3pounder').hide();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').hide();
      }
      else if ($(this).val() == "ExpressBoxLarge"){
        $('#ExpressBoxLarge').show();
        $('#3pounder').hide();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#GeneralCargo').hide();
      }
      else{
        
        $('#3pounder').hide();
        $('#1pounder').hide();
        $('#5pounder').hide();
        $('#ExtraSmallBox').hide();
        $('#ExpressBoxSmall').hide();
        $('#ExpressBoxMedium').hide();
        $('#ExpressBoxLarge').hide();
        $('#GeneralCargo').show();  
      }
    });
  });
</script>
@stop

@section('content')
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
        <br><br><br/><h1>Delivery Rates</h1>

        <br><br>

        {!! Form::open() !!}
        {!! Form::select('packType', array('1pounder' => '1pounder', '3pounder' => '3pounder', '5pounder' => '5pounder', 'ExtraSmallBox' => 'Extra Small Box', 'ExpressBoxSmall' => 'Express Box Small', 'ExpressBoxMedium' => 'Express Box Medium', 'ExpressBoxLarge' => 'Express Box Large', 'GeneralCargo' => 'General Cargo'), null, array('class' => 'form-control', 'id'=>'myselect')); !!}
        {!! Form::close() !!} 

        @foreach($rate as $rates)
  
       
   
        <form name="{{ $rates->type }}" id="{{ $rates->type }}" role="form" method="POST" action="/rates/{{ $rates->type }}" style="display:none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <br>
         Rate <input type="text" name="rate"  value="{{ $rates->rate }}"> <br><br>
         Package Weigth <input type="text" name="weight" value="{{ $rates->weight }}">  <br><br>
         Additional Cost for excess weight <input type="text" name="ecost" value="{{ $rates->ecost}}"> <br><br>
         Excess range <input type="text" name="excess" value="{{ $rates->excess }}">  <br><br><br>
          <button class="btn"> Change Rate  </button> <br><br><br>
          

           </form>   
 
         
        @endforeach

       

@stop


