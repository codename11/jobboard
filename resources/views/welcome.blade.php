<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="larico.png" />
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                @auth

                                    <li class="nav-item">
                                        <a class="nav-link" href="/jobs">List jobs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/jobs/create">Post a job</a>
                                    </li>

                                @endauth
                            </ul>
                
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    @endif
                                @else

                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                        <ul class="navbar-nav ml-auto">
                                        
                                            <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }} <span class="caret"></span>
                                                    </a>
                            
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                            
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links {{(Route::has('login')) ? 'altTopRight' : ''}}">
                    @auth

                    @endauth
                </div>
            @endif

            <div class="content">
          
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/1.jpg" alt="Laravel1" class="imgCars">
                        </div>
                        <div class="carousel-item">
                            <img src="/2.jpg" alt="Laravel2" class="imgCars">
                        </div>
                        <div class="carousel-item">
                            <img src="/3.jpg" alt="Laravel3" class="imgCars">
                        </div>
                    </div>
                        
                </div>

                @include("inc.footer")

            </div>
        </div>
        
    </body>
</html>
