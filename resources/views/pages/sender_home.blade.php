@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
  <li class="active"><a href="senderHome">Home</a></li>
  <li><a href="requestForm">Request Delivery</a></li>
  <li><a href="rates2">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>
  
@stop

@section('content')
	<br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>My Requests</h1>
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
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>PackType</th>
                                            <th>Description</th>
                                            <th>Functions</th>
                                        </tr>
                                    <tbody> 
                                    </thead>@foreach($receivers as $receiver)
                                        <tr>
                                            <td>{{$receiver->id }}</td>
                                            <td>{{$receiver->receiverFname }}</td>
                                            <td>{{$receiver->receiverLname }}</td>
                                            <td>{{$receiver->receiverAddress }}</td>
                                            <td>{{$receiver->receiverContact }}</td>
                                            <td>{{$receiver->packType}}</td>
                                            <td>{{$receiver->description}}</td>
                                            
                                            <td>
                                              <a class="btn btn-success btn-xs" href="{{ URL::to('receiverUpdate' . $receiver->id) }}" title="Edit Request"><i class="fa fa-pencil"></i></a>
                                              <a class="btn btn-danger btn-xs" href="{{ URL::to('receiverDelete' . $receiver->id) }}" title="Delete Request" onclick="return confirm('Are you sure you want to delete data?')"><span class="glyphicon glyphicon-remove"></span></a>       
                                            </td>
                                        </tr>@endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

@stop


