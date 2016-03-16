<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>
    <!-- start: Meta -->
    @yield('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">        
    <meta name="description" content="2Door - a JRS express application"/>
    <meta name="keywords" content="Template, Theme, web, html5, css3, Bootstrap" />
    <meta name="author" content="Łukasz Holeczek from creativeLabs"/>
    <!-- end: Meta -->
    
    <!-- start: Mobile Specific -->
    
    <!-- end: Mobile Specific -->   

    <!-- start: CSS -->
   <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link href="/gotya/css/bootstrap.css" rel="stylesheet">
    <link href="/gotya/css/styls.css" rel="stylesheet">
    <!-- <link href="/gotya/css/bootstrap-responsive.css" rel="stylesheet"> -->
    <link href="/gotya/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
    <script src="/gotya/js/jquery.checkAll.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    @yield('head')

</head>
  
<body>
    
    <!--start: Header -->
        <header>
        
        <!--start: Container -->
        <div class="container">
            
            <!--start: Row -->
            <div class="row">
                    
                <!--start: Logo -->
                <div class="logo span3">    
                        
                    <a class="brand" href="#"><img src="/gotya/img/logo.png" alt="Logo"></a>
                        
                </div>
                <!--end: Logo -->
                    
                <!--start: Navigation -->
                <div class="span9">
                    
                    <div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    @yield('header')

                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>  
    
            </div>
            <!--end: Row -->
            
        </div>
        <!--end: Container-->           
            
    </header>

    @yield('content')
      
</body>
</html>