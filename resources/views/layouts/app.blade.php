<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NY Volunteer Hub</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/teambernieny.css" type="text/css" />
    <!-- Scripts-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
    <script src="js/jquery.fileupload.js"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="images/TBNY_Masthead_cropped_small.jpg">
      </a>
        <div class="container" id="navbar">
            <div class="navbar-header">

                @if(Auth::check())
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  Volunteer Hub
                </a>

            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href='/addVolunteer'>Add Volunteer Direct</a></li>
                    @if(Auth::user()->role == "admin")
                    <li><a href='/adminHome'>Admin Home </a></li>
                    <li><a href='/volSearchName'>Find Volunteer</a></li>
                    <li><a href='/addEvent'>Add Event</a></li>
                    <li><a href='/addUser'>Add User</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Search <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/volSearchZip') }}">Volunteers By Zip/Neighborhood</a></li>
                            <li><a href="{{ url('/volSearchName') }}">Individual Volunteers</a></li>
                            {{--<li><a href="{{ url('/volSearchEvent') }}">Volunteers By Event</a></li> --}}
                            <li><a href="{{ url('/volAll') }}">All Volunteers</a></li>
                            {{--<li><a href="{{ url('/eventSearchNeighborhood') }}">Event By Neighborhood</a></li>--}}
                            {{--<li><a href="{{ url('/eventSearchDate') }}">Event By Date</a></li>--}}
                            <li><a href="{{ url('/eventAll') }}">All Events</a></li>
                        </ul>
                    @endif
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>

                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('body')


    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
