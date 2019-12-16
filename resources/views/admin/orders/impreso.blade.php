<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Orden</title>
</head>

<body style="background-color:white">

    <table width="100%" style=" padding: 2px; margin: 0em .1em .1em 0em; border: #000 1px solid; border-radius: 15px">
        <tr>
            <td style="background-color: #fff; text-align: left; padding: 0">
                <div style="width: 100%; margin:3px 0; display: inline-block;text-align: center">
                    <img style="padding: 0; width: 100px; margin: 1px" src="{{asset('/img/logo.png')}}">
                </div>
            </td>
            <td style="background-color: #fff; text-align: center; padding: 0">
                <div style="width: 100%;margin:1px 0; display: inline-block;text-align: center">



                    <li style="list-style:none;">
                        <h3 style="text-align:center;margin: 0 5px 0 0;font-size: 20px">
                            {{$empresa->nombre}}
                        </h3>
                    </li>

                    <li style="list-style:none; font-weight:500;">Nit:<span> {{$empresa->nit}}</span></li>
                    <li style="list-style:none; font-weight:500;">Telefono:<span> {{$empresa->telefono}}</span></li>
                    <li style="list-style:none; font-weight:500;">Email:<span> {{$empresa->email}}</span></li>
                    <li style="list-style:none; font-weight:500;">Direccion:<span> {{$empresa->direccion}}</span></li>

                </div>
            </td>

            <td style="background-color: #fff; text-align: right; padding: 0">
                <div style="width: 100%;margin:1px 0; display: inline-block;text-align: center">


                    <li style="list-style:none;">
                        <h3 style="text-align:center;margin: 0 5px 0 0;font-size: 20px">
                            Detalles de Orden
                        </h3>
                    </li>

                    <li style="list-style:none; font-weight:500;">Nº.</span></li>
                    <li style="list-style:none; font-weight:500;"><span> {{$order->consecutivo}} </span></li>
                    <li style="list-style:none; font-weight:500;">Fecha de expedicón </span></li>
                    <li style="list-style:none; font-weight:500;"><span> {{ date('Y-m-d') }}</span></li>
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style=" margin: 0em .1em .1em 0em;">
        <tr>

            <td style="background-color: #fff; text-align: left;border: #000 1px solid;border-radius: 15px">

                <h4 style="text-align:center;margin: .2em 0em 0em 0em;">
                    Detalles de Equipo
                </h4>
                <li style="margin: 0em 0em 0em 1em; list-style:none;">Referencia de equipo :
                    <span> {{$order->referencia}}</span>
                </li>
                <li style="margin: 0em 0em 0em 1em; list-style:none;">Serial de equipo :
                    <span> {{$order->serial}}</span>
                </li>

                <li style="margin: 0em 0em 0em 1em; list-style:none;"> Estado :
                    <span style="font-size: 1em; color : #1976D2; font-weight: bolder;"> {{$order->estado}}</span>
                </li>

                @if (!empty($order->fecha_salida))
                <li style="margin: 0em 0em 0em 1em; list-style:none;"> Fecha entregado :
                    <span> {{$order->fecha_salida}}</span>
                </li>
                @endif

            </td>

            <td style="background-color: #fff; text-align: left;border: #000 1px solid;border-radius: 15px">

                <h4 style="text-align:center;margin: .2em 0em 0em 0em;">
                    Datos del cliente
                </h4>

                <li style="margin: 0em 0em 0em 1em; list-style:none;" ;>Nombres :
                    <span> {{$order->cliente->nombre}} </span>
                </li>
                <li style="margin: 0em 0em 0em 1em; list-style:none;" ;>Apellidos :
                    <span> {{$order->cliente->apellido}}</span>
                </li>
                <li style="margin: 0em 0em 0em 1em; list-style:none;" ;>Tipo de Identificacion :
                    <span> {{$order->cliente->tipo_identificacion}}</span>
                </li>
                <li style="margin: 0em 0em 0em 1em; list-style:none;" ;> Numero :
                    <span> {{$order->cliente->identificacion}}</span>
                </li>
            </td>
        </tr>

    </table>
    <table width="100%" style=" margin: 0em .1em .1em 0em;">
        @if (!empty($order->observaciones))
        <tr>
            <td style="background-color: #fff; text-align: left; padding: 0;border: #000 1px solid;border-radius: 10px">
                <h4 style="text-align:left; margin: 0em 0em .3em 1em;">
                    Observaciones:
                </h4>
                <p style="text-align: justify; margin: 0em .3em .3em 1em;">{{$order->observaciones}}</p>
            </td>
        </tr>
        @endif

        @if (!empty($order->diagnostico))
        <tr>
            <td style="background-color: #fff; text-align: left; padding: 0;border: #000 1px solid;border-radius: 10px">
                <h4 style="text-align:left; margin: 0em 0em .3em 1em;">
                    Diagnostico:
                </h4>
                <p style="text-align: justify; margin:  0em .3em .3em 1em;">{{$order->diagnostico}}</p>
            </td>
        </tr>
        @endif

    </table>

    <table width="100%"
        style="background-color: #fff; text-align: left; padding: 0;border-top: #000 1px solid; margin-top:5px">
        <tr>
            <td>
                <p style="text-align:left; margin: 0 0 0 1em;  font-weight:600">
                    Acciones:
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="text-align:center;">
                    @foreach ($order->accions as $accion)
                    <tr>
                        <td>{{$accion->nombre}}:</td>
                        <td style="border: #000 1px solid;border-radius: 5px">${{$accion->valor_total}}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>

    <table width="100%" style=" margin: .8em 0 0 1em;">
        <tr>
            <td style="font-weight:600; text-align: left;">Total, Servicios:</td>
            <td style="font-weight:bold; font-size:20px; text-align: right; color:#f44336;">${{$order->valor_total}}
            </td>
        </tr>

    </table>

    <table width="100%" style=" margin: 2em .1em .1em 0em;">
        <tr>
            <td>
                <h3 style="text-align:left; margin: 0 0 0 1em;">x</h3>
                <p style="text-align: center; margin: 0;">___________________________________</p>
                <p style="text-align: center; margin: 0;">Recibo a conformidad</p>
                <p style="text-align: center; margin: 0;">Propietario o encargado</p>
            </td>

            <td>
                <h3 style="text-align:left; margin: 0 0 0 1em;">x</h3>
                <p style="text-align: center; margin:  0 ;">___________________________________</p>
                <p style="text-align: center; margin:  0 ;">Quien entrega</p>
                <p style="text-align: center; margin:  0 ;">Personal autorizado</p>
            </td>
        </tr>

    </table>

    @if (!empty($empresa->publicidad))

    <table width="100%" style=" margin: 3em 1em 1em 1em; ">
        <tr>
            <td>
                <div width="100%" style="
                        padding: 5px;
                        margin: 0 0 25px;
                        overflow: hidden;
                        width: 680px;
                        height: 70px;
                        background-color:#1976D2;
                        border-radius: 10px 0px 10px 0px;
                        font-family:Verdana;
                        font-size: 20px;
                        font-style:oblique;
                        font-weight: 400;
                        text-align: justify;
                        text-shadow: black 6px 6px 4px;
                        color: #fff;
                        vertical-align: middle;
                        border: 2px solid #5878ca;
                  ">

                    {{$empresa->publicidad}}


                </div>
            </td>
        </tr>
    </table>
    @endif

    <footer style="position:absolute;
                        bottom: 20px;
                        text-align: justify;
                        color: #000;
                        font-family: 'Times New Roman', Times, serif;
                        margin-top:20px;">
        <small style="font-size: 0.8rem;">
            Clausulas.
            @foreach ($clausulas as $key => $clausula)
            {{$key+1}}). {{$clausula->descripcion}}
            @endforeach
        </small>
    </footer>

</body>

</html>
