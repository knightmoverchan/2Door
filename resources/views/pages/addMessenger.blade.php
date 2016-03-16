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
@stop

@section('content')
<br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Add Messenger</h1>

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
	<form method="post" action="/addMessenger">
	<br><br>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table align="center">
		<tr>
		<td>First Name</td><td><input type="text" name="fname"></td>
		</tr>
		<tr>
		<td>Last Name</td><td><input type="text" name="lname"></td>
		</tr>
		<tr>
		<td>Email</td><td><input type="text" name="email"></td>
		</tr>
		<tr>
		<td>Password</td><td><input type="password" name="password"></td>
		</tr>
		<tr>
            <td>Confirm Password</td><td>    
                <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirm Password" required>
			</td>
		</tr>
		<tr>
		<td>Plate Number</td><td><input type="text" name="plateNo"></td>
		</tr>
		<tr>
		<td>Address</td><td><input type="text" name="address"></td>
		</tr>
		<tr>
		<td>Contact Number</td><td><input type="text" name="contact_num"></td>
		</tr>
		<tr>
		<td>Assigned Area</td><td>
			 <select class="form-control" name="assignedArea">
    @foreach($assigned as $assign)
      <option value="{{$assign->assigned}}">{{$assign->assigned}}</option>
    @endforeach
  </select>
		</td>
		</tr>
		<tr>
		<td><td><input type="submit" name="add" value="Add Messenger"></td></td>
		</tr>
		</table>
	</form>
@stop

