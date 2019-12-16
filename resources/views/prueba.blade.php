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
     <link href="{{asset('/css/custom/argon-dashboard.css')}}" rel="stylesheet">

    <link href="{{asset('css/custom/nucleo.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/datatablecss/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/datatablecss/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/datatablecss/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->

        <div class="row card w-100 bg-transparent">
            <div class="col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control" id="select">
                                    <option value="Orden">Nº Orden</option>
                                    <option value="Referencia">Referencia</option>
                                    <option value="Cedula">Cedula</option>
                                    <option value="Serial">Serial</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Nit">Nit</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatablejs/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $("#select").select2({
            placeholder: "Select a client"
        });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>



</body>

</html>
