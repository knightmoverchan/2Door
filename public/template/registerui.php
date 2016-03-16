 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Register </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" style="text/css" href="/login/bootstrap/css/styl2.css">
<link rel="stylesheet" style="text/css" href="/login/bootstrap/css/bootstrap.css">



</head>

 <div class="container">
 <div class="row">
  <div class="col-md-11"><br></div>
 <div class="row">
<div class="col-sm-2"></div>
 <div class="col-sm-5 bord">
 <h3>Create Account</h3>
 <hr/>



 <div class="panel-body">         
    
 <form class="form-horizontal" role="form" method="POST" action="/login">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
 <div class="row">
 <div class="col-sm-6">
 <input type="text" class="form-control input-lg" name="firstname" placeholder="First Name" required></div>
 <div class="col-sm-6">
 <input type="text" class="form-control input-lg" name="lastname" placeholder="Last Name" required></div>

 </div>
 </div>

 <div class="form-group">
 <div class="row">
 <div class="col-md-10">
 <input type="email" class="form-control input-lg" name="email" placeholder="Enter email" required>
 </div>
 </div>
 </div>

 <div class="form-group">
 <div class="row">
 <div class="col-md-9">
 <input type="password" class="form-control input-lg" name="password" placeholder="Password" required>
 </div>
 </div>
 </div>

  <div class="form-group">
  <div class="row">
 <div class="col-md-9">
 <input type="password" class="form-control input-lg" name="confirmpassword" placeholder="Confirm Password" required>
 </div>
 </div>
 </div>

 <div class="form-group">
  <label for="sel1">Birthday</label>
 
  <div class="row">
  <div class="col-sm-3">
  <select class="form-control" id="month">
    <option>January</option>
  </select>
  </div>

  <div class="col-sm-3">
    <select class="form-control" id="day">
    <option>1</option>
  </select>
  </div>

<div class="col-sm-3	">
    <select class="form-control" id="year">
    <option>2015</option>
  </select>
</div>	

</div>
</div>


 <div class="form-group">
<label class="radio-inline"><input type="radio" name="optradio">Male</label>
<label class="radio-inline"><input type="radio" name="optradio">Female</label>
 </div>


<br><br>
 <div class="form-group">
 <div class="col-md-12">
 <button type="submit" class="btns btn-block input-lg" style="margin-right: 15px;">
  Create Account
 </button>

 

 </div>
 </div>
 </form>




 
 </div>
 
 </div>

<div class="col-sm-5">
<div class="row"><br><br><br><br><br><br><br><br><br></div>
<div class="row">
  <img src="ltruck.jpg">
</div>
 </div>
 </div>