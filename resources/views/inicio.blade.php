@extends('welcome')
@section('content')

<div class="container" style="
    text-align: letf;
    position: absolute;
    top: 35%;
    /* left: 3%; */
    color: #000;
    font-family: Tahoma, Geneva, Verdana, sans-serif
  ">

    {{-- <h1 class="text  font-normal" style="
                        font-size:6vw;
                ">{{ config('app.name', 'Mi sistema') }}</h1> --}}

</div>

<div class="row card col-11 bg-transparent" style="position:absolute;
bottom: 10%;
margin-left: 4%;
font-family: 'Times New Roman', Times, serif;
border: 1px solid #c3c3c3;

">
    <form action="{{route('seguimientos')}}" method="get">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" id="trackType" name="filtro" onchange="changeText(this);">
                        <option value="Orden">Nº Orden</option>
                        <option value="Referencia">Referencia</option>
                        <option value="Cedula">Cedula</option>
                        <option value="Serial">Serial</option>
                        <option value="Pasaporte">Pasaporte</option>
                        <option value="Nit">Nit</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="Ingresa el número de orden del servicio"
                        id="trackNumber" name="numero">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">Consultar</button>
                </div>
            </div>
    </form>
</div>

@stop
