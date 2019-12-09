<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                {{-- <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png" alt=""></a> --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    @auth
                    <div class="classynav">
                        <ul>
                            <li>
                                <a href="{{route('orders.index')}}">
                                    Gestión
                                </a>

                            </li>
                        </ul>
                    </div>
                    @endauth
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- User Login Info -->
                <div class="user-login-info">
                    {{-- <a href="#"><img src="img/core-img/user.svg" alt=""></a> --}}
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li>
                            @guest
                            <a class="" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                            @if (Route::has('register'))
                            <a class="" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            @endif
                            @else
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Welcome Area Start ##### -->


    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-10.png);">
        <div class="">

            @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show m-5" role="alert">
                <strong>Error!</strong> {{ session('status') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h2>Sistema de Seguimiento</h2>
                        {{-- <a href="#" class="btn essence-btn">Mas Informacón</a> --}}
                        {{-- <small>Entrgando siempre</small> --}}
                    </div>

                </div>

                <div class="row card w-100 bg-transparent">
                    <div class="col-12">
                        <form action="{{route('seguimientos')}}" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" id="trackType" name="filtro"
                                            onchange="changeText(this);">
                                            <option value="Orden">Nº Orden</option>
                                            <option value="Referencia">Referencia</option>
                                            <option value="Cedula">Cedula</option>
                                            <option value="Serial">Serial</option>
                                            <option value="Pasaporte">Pasaporte</option>
                                            <option value="Nit">Nit</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text"
                                            placeholder="Ingresa el número de orden del servicio" id="trackNumber"
                                            name="numero">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-sm btn-info">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ##### Footer Area Start ##### -->
    {{-- <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i
                                    class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('/js/jquery-3.3.1.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <!-- Classy Nav js -->
    <script src="{{asset('/js/custom/classy-nav.min.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('/js/custom/active.js')}}"></script>

    <script src="{{asset('js/change.js')}}"></script>


</body>

</html>
