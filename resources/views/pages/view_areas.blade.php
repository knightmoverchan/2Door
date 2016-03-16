@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
  <li><a href="/adminHome">Home</a></li>
  <li><a href="/allMessenger">Messenger</a></li>
  <li><a href="/allCashier">Cashier</a></li>
  <li><a href="/addArea">Add Area</a></li>
  <li><a href="/rates">Delivery Rates</a></li>
  <li><a href="auth/logout">Log out</a></li>
  
@stop

@section('content')
	<br/><br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Assigned Area</h1>
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
                                            <th>Branch</th>
                                            <th>Area</th>
                                            <th>Assigned Area</th>
                                        </tr>
                                    <tbody> 
                                    </thead>@foreach($assigned as $receiver)
                                        <tr>
                                            <td> {{$receiver->id }}</td>
                                            <td>{{$receiver->branch }}</td>
                                            <td>{{$receiver->area }}</td>
                                            <td>{{$receiver->assigned }}</td>
                                            <td>
                                              <a class="btn btn-success btn-xs" href="{{ URL::to('areaUpdate' . $receiver->id) }}" title="Edit Request"><i class="fa fa-pencil"></i></a>
                                              <a class="btn btn-danger btn-xs" href="{{ URL::to('areaDelete' . $receiver->id) }}" title="Delete Request" onclick="return confirm('Are you sure you want to delete data?')"><span class="glyphicon glyphicon-remove"></span></a>       
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


