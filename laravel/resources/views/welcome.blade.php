<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BedMem</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                {{--<a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>--}}
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row tiles">
            <div class="tile col-md-4" data-scale="1.02">
                <div class="photo" style="background-image: url('img/bed.jpg');"></div>
                <div class="txt">
                    <div class="btn">
                        Speel!
                    </div>
                </div>
            </div>
            <div class="tile col-md-4" data-scale="1.02">
                <div class="photo" style="background-image: url('img/desk.jpg');"></div>
                <div class="txt">
                    <div class="btn">
                        Speel!
                    </div>
                </div>
            </div>
            <div class="tile col-md-4" data-scale="1.02">
                <div class="photo" style="background-image: url('img/computer.jpg');"></div>
                <div class="txt">
                    <div class="btn">
                        Speel!
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <p>test</p>
        </div>
        {{--        <div class="row">
                    <div class="half-height">
                        <p>test</p>
                    </div>
                </div>--}}
    </div>
</div>
<!-- Scripts -->
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<script src="/js/main.js"></script>
</body>
</html>
