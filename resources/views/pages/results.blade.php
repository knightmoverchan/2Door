@extends('layouts.headerMaps')

@section('title')
 2Door 
@stop

@section('header') 

  <li class="active"><a href="cashierhome"> Requests </a></li>
  <li><a href="receipt">Transactions</a></li>
  <li><a href="auth/logout">Log out</a></li>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBQkmmSeG_XteRRMhuYBPaGk6mM3sKX6s&libraries=places"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChO-fq_hhwZjwYrrwerNUF4qjgic7YOUE&libraries=geometry"></script>
  <script type="text/javascript">
function getBranch(){
  @foreach($result as $res)
    var loc = new google.maps.LatLng('{{ $res->latitude }}', '{{ $res->longitude }}');
  @endforeach

var main = [];
var reg = [];
var brn = [];
var brnName = [];

  @foreach($branches as $branch)
    main.push(new google.maps.LatLng('{{ $branch->latitude }}', '{{ $branch->longitude }}'));
    reg.push('{{ $branch->area }}');
    brn.push('{{ $branch->branch }}');
    brnName.push('{{ $branch->branchName }}');
  @endforeach

  var distance = [];

  for(var m = 0; m < main.length; m++){
    distance.push(google.maps.geometry.spherical.computeDistanceBetween(main[m], loc));
  };

  var branch = 0;
  var branchName = 0;
  var region = 0;

  for(var y = 0; y < distance.length-1; y++){
    if(distance[y] < distance[y+1]){
      region = reg[y];
      branch = brn[y];
      branchName = brnName[y];
      distance[y+1]=distance[y];
      reg[y+1] = reg[y];
      brn[y+1] = brn[y]; 
      brnName[y+1] = brnName[y]; 
      } 
    else{
       region = reg[y+1];
       branch = brn[y+1];
       branchName = brnName[y+1];
       }
      
    };

    var assignarea = [];
    var assign = []

  @foreach($assignedarea as $assign)
  if(region == '{{$assign->area}}' && branch == '{{$assign->branch}}')
  {
    assignarea.push(new google.maps.LatLng('{{$assign->latitude}}', '{{$assign->longitude}}'));
    assign.push('{{$assign->assigned}}');
  }
  @endforeach

  var areaassign = [];
  var lowest;

  for(var g = 0; g < assignarea.length; g++){
    areaassign.push(google.maps.geometry.spherical.computeDistanceBetween(assignarea[g], loc));
  }

Array.prototype.min = function() {
  return Math.min.apply(null, this);
};

 low = areaassign.indexOf(areaassign.min());

var lowest;
for(var mon = 0; mon < assign.length; mon++){
if(low == mon)
  lowest = assign[mon];
}

  branchnumber(branch, region, lowest, branchName);
  }

  function branchnumber(branch, region, lowest, branchName){
    document.getElementById('myBranch').value = branch;
    document.getElementById('myBranchName').value = branchName;
    document.getElementById('myRegion').value = region;
    document.getElementById('myassigned').value = lowest;
  }

   function suggestion(){
     var cheer = document.getElementById('wei').value;
     var num = [];
     var weights = [];
     var val;

    @foreach($rates as $rate)
      num.push('{{$rate->type}}');
      weights.push({{$rate->weight}});
    @endforeach

for(var i = 0; i < num.length; i++){
     if(cheer < weights[i])
       {
          val = num[i];
          break;
        }
        else if(cheer >= 10000)
          val = 'ExpressBoxLarge';
} 

   document.getElementById('package').value = val;


   }



  </script>


@stop

@section('content')
<body onload="getBranch()">
  <br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
    <br/><h1>Request Delivery</h1>
      
     
          <br/>  

           @foreach($result as $results)

       
            <form role="form" method="POST" action="/cost">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" value="{{ $results->id }}">
              <input type="hidden" name="branchnumber" id="myBranch">
              <input type="hidden" name="branchName" id="myBranchName">
              <input type="hidden" name="area" id="myRegion">
              <input type="hidden" name="assignedarea" id="myassigned">
              <br/>  
              <label></label> 
              @foreach($sender as $send)
                <input type="hidden" name="sendercontact" value="{{ $send->senderContact}}">
              @endforeach
                <input type="hidden" name="receivercontact" value="{{ $results->receiverContact}}"> 
                <input type="hidden" name="latitude" id ="lat" value="{{ $results->latitude}}"> 
                <input type="hidden" name="longitude" id ="lng" value="{{ $results->longitude}}">
                <input type="hidden" name="receiverFname" value="{{ $results->receiverFname}}">
                <input type="hidden" name="receiverLname" value="{{ $results->receiverLname}}">
                <input type="hidden" name="senderid" value="{{ $results->sender_id}}">
           
              <label> <strong>Transaction No: {{ $results->id }}</strong> </label><br>
              <label>Receiver's Name</label><input type="text" placeholder="{{ $results->receiverLname }}, {{ $results->receiverFname }}" disabled="true">  <br><br>
           
              <label>Address</label><input type="text" name="receiverAddress" id ="mapsearch" value="{{ $results->receiverAddress}}">  <br><br>
              {!! Form::select('packType', array('1pounder' => '1pounder', '3pounder' => '3pounder', '5pounder' => '5pounder', 'ExtraSmallBox' => 'Extra Small Box', 'ExpressBoxSmall' => 'Express Box Small', 'ExpressBoxMedium' => 'Express Box Medium', 'ExpressBoxLarge' => 'Express Box Large', 'Express Cargo' => 'Express Cargo', 'GeneralCargo' => 'General Cargo'), $results->packType, array('id' => 'package')); !!}

           
              <br> <br><label>Description</label><textarea rows="3" name="description" value="{{ $results->description}}">{{ $results->description}}</textarea> <br><br>
              <input type="text" id="wei" name="weight" onchange="suggestion()" placeholder="weight in grams."> grams  <br><br>
              <button class="btn"> Submit  </button>

            </form>



          @endforeach             

@stop


