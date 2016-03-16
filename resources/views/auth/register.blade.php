 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Register </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" style="text/css" href="/template/bootstrap/css/styl2.css">
  <link rel="stylesheet" style="text/css" href="/template/bootstrap/css/bootstrap.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <br/>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-5 bord">
          <h3>Create Account</h3>
            <hr/>
          <div class="panel-body"> 

            @if(count($errors) > 0)
              <div class="alert alert-danger">
                <strong>Whooops!</strong>There's an error!
                <ul>
                  @foreach($errors->all() as $error)
                    <li>
                      {{ $error }}
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
  
            <form class="form-horizontal" role="form" method="POST" action="/register">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control input-lg" name="fname" placeholder="First Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control input-lg" name="lname" placeholder="Last Name" required>
                  </div>
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
                    <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirm Password" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-9">
                    <input type="text" class="form-control input-lg" name="senderAddress" placeholder="Address" required>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-9">
                    <input type="text" class="form-control input-lg" name="senderContact" placeholder="Contact" required>
                  </div>
                </div>
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
              <img src="/template/img/truck.jpg">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>