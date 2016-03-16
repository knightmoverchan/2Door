@extends('layouts.headerMaster')

@section('title')
   2Door
@stop

@section('header')
  <li><a href="/messengerHome">Home</a></li>
  <li><a href="/messengerP2P">Point2Point</a></li>
  <li class="active"><a href="">Profile</a></li>
  <li><a href="auth/logout">Log out</a></li>
  
@stop

@section('content')
<br/>
  <div class="container fluid">
    <div class="row">
      <div class="col-mid-3 col-md-offset-3">
        <div class="panel panel-default">
          <br/><h1>Profile</h1>

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
	<form method="post" action="/messengerUpdate" enctype="multipart/form-data">
	<br><br>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<img src="/images/{{ $messenger->picture }}" class="pp img-circle">
		<table align="center">
		<tr>
		<td>Picture</td><td><input type="file" name="image" class="pic"></td>
		</tr>
		<tr>
		<td>First Name</td><td><input type="text" name="fname" value="{{ Auth::user()->fname }}"></td>
		</tr>
		<tr>
		<td>Last Name</td><td><input type="text" name="lname" value="{{ Auth::user()->lname }}"></td>
		</tr>
		<tr>
		<td>Email</td><td><input type="text" name="email" value="{{ Auth::user()->email }}"></td>
		</tr>
		<tr>
		<td>Plate Number</td><td><input type="text" name="plateNo" value="{{ $messenger->plateNo }}"></td>
		</tr>
		<tr>
		<td>Address</td><td><input type="text" name="address" value="{{ $messenger->address }}"></td>
		</tr>
		<tr>
		<td>Contact Number</td><td><input type="text" name="contact_num" value="{{ $messenger->contact }}"></td>
		</tr>
		<tr>
		<td>Area</td><td><input type="text" name="area" value="{{ $messenger->area }}"></td>
		</tr>
		<tr>
		<td><td><input type="submit" name="add" value="Update"></td></td>
		</tr>
		</table>
	</form>
@stop

