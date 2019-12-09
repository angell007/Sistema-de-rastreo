<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mi sistema') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="bg-light" style=" background-image: url(img/bg-img/bg-10.png);
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: contain;
                                background-size: contain;
                                -webkit-background-size: contain;
                                -moz-background-size: contain;
                                -o-background-size: contain;
">

    <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white" style="background-color:;">
        <div class="container">
            <a class="nav-link pr-0" href="{{route('/')}}" role="button" aria-haspopup="true" aria-expanded="false">

                <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img src="{{asset('/img/logo.png')}}" class="img-fluid img-thumbnail " alt="Logo" style=" vertical-align: middle;
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        margin:2px;
                        ">
                    </span>
                </div>

            </a>

            <a class="navbar-brand font-weight-normal font-italic" href="{{ url('/') }}" style=" font-size:1.2em; ">
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                    <li class="nav-item">
                        <a class="navbar-brand font-weight-bold font-italic" href="{{ route('orders.index') }}"
                            style=" font-size:1.2em; line-height: 2em">
                            <i class="ni ni-settings-gear-65"></i>
                            <span> Gestión </span>
                        </a>
                    </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bold font-italic"
                            href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bold font-italic"
                            href="{{ route('register') }}">{{ __('Registrar') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold font-italic " href="#"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>Salir</span>
                            </a>

                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    @if (session('status'))
    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <strong>Error!</strong> {{ session('status') }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif





    @yield('content')



    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('/js/jquery-3.3.1.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/change.js')}}"></script>


</body>

</html>
