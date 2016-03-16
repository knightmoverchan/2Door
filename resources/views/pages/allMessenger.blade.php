@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
    <li><a href="/adminHome">Home</a></li>
    <li class="active"><a href="/allMessenger">Messenger</a></li>
    <li><a href="/allCashier">Cashier</a></li>
    <li><a href="/rates">Delivery Rates</a></li>
    <li><a href="/addArea">Add Area</a></li>
    
    <li><a href="auth/logout">Log out</a></li>
   
    <style>
       img.addButton{
            right: 200px;
            position:absolute;
        }
    </style>
@stop

@section('content')
<br/><br/>
  <a href="/addMessenger"> <img class="addButton" src="/gotya/img/addbutton.png"></a>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/>
          <br/><div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Assigned Area</th>
                                            <th>Contact</th>
                                            <th>Plate #</th>  
                                        </tr>
                                    <tbody> 
                                    </thead>
                                        @foreach($messenger as $messenger)
                                            <tr>
                                                <td>{{$messenger->id}}</td>
                                                <td>{{$messenger->fname}}</td>
                                                <td>{{$messenger->lname}}</td>

                                                @foreach($msg as $msgs)
                                                    @if($msgs->id == $messenger->userid)
                                                        <td>{{$msgs->assignedArea}}</td>
                                                        <td>{{$msgs->contact}}</td>              
                                                        <td>{{$msgs->plateNo}}</td>
                                                        <form role="form" method="POST" action="/roads">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="assignedarea" value="{{$msgs->assignedArea}}">
                                                        <td><button class="btn" name="btn" value="{{$msgs->id}}"> Track </button>
                                                        </form>
                                                        <a class="btn btn-xs" href="{{ URL::to('/viewAssigned' . $msgs->id) }}" title="View Report">View<i class="fa fa-pencil"></i></a><td>
                                                    @endif
                                                @endforeach
                                                
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    @if(empty($transactions))
                    @else
                    <div style="position: absolute; width: 1000px;top:400px; ">
                   
                     <h3> ASSIGNED TRANSACTIONS : {{$msgName->fname}} {{$msgName->lname}} </h3>

                       <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sender's Name</th>
                                                        <th>Source Branch</th>
                                                        <th>Receiver's Name</th>
                                                        <th>Destination Branch</th>
                                                        <th>Package Type</th>
                                                        <th>View Transaction</th>
                                                    </tr>
                                                <tbody> 
                                                </thead>
                                                 
                                                    @foreach($transactions as $transaction)
                                                        
                                                        @foreach($senderNames as $senderName)

                                                          @if($senderName->userid == $transaction->senderid)

                                                            <tr>
                                                                <td>{{$transaction->id }}</td>
                                                                <td>{{$senderName->fname." ".$senderName->lname }}</td>
                                                                <td>{{$transaction->areaOrigin }}</td>
                                                                <td>{{$transaction->receiverFname." ".$transaction->receiverLname }}</td>
                                                                <td>{{$transaction->branchName }}</td>
                                                                <td>{{$transaction->type}}</td>
                                                                <td>
                                                                  <a class="btn btn-success btn-xs" href="{{ URL::to('/viewReport' . $transaction->id) }}" title="View Report">View<i class="fa fa-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                         @endif
                                                        @endforeach
                                                
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                            </div>
                    @endif
                    </div>
                    <!-- /.panel -->

                </div>


@stop 