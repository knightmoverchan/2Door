@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
    <li><a href="/adminHome">Home</a></li>
    <li><a href="/allMessenger">Messenger</a></li>
    <li class="active"><a href="/allCashier">Cashier</a></li>
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
  <a href="/addCashier"> <img class="addButton" src="/gotya/img/addbutton.png"></a>
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
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Home Address</th>
                                            <th>Contact</th>    
                                        </tr>
                                    <tbody> 
                                    </thead>
                                        @foreach($cashiers as $cashier)
                                            <tr>
                                                <td>{{$cashier->id}}</td>
                                                <td>{{$cashier->fname }}</td>
                                                <td>{{$cashier->lname }}</td>
                                                @foreach($cashrs as $cashr)
                                                    @if($cashr->id == $cashier->userid)
                                                        <td>{{$cashr->address}}</td>
                                                        <td>{{$cashr->contact}}</td>              
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
                    <!-- /.panel -->
                </div>
@stop 