<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <title>Document</title>
    <style>
        *{
            margin: 0;
            /*padding: 0;*/
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
        }
        body {
            /*font: 12pt Georgia, "Times New Roman", Times, serif;*/
            font-size: 11px;
            line-height: 1.3;
            padding-top: 80px;
            padding-bottom: 80px;
        }

        #header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        #footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: -80px;
            z-index: 1;
        }

        #container{
            /*position: relative;*/
            /*background-color: #f7bc60;*/
            height: 690px !important;
            /*margin-top: 200px;*/
            margin-left: 30px;
            margin-right: 20px;
        }

        #tbl-header{
            background-color: #9f191f;
            color: #FDFDFD;
            text-align: center;
        }

        #tbl_productos {
            border:0.5px solid #9f191f;
            max-height: 100%;
            margin: 0;
            padding:0;
        }

        .fecha{
            margin-right: 30px;
            text-align: right;
        }

        /*.row{*/
            /*width: 100%;*/
        /*}*/

        #relativo{
            /*background-color: #00ca6d;*/
            position: relative;
        }

        #movido{
            /*background-color: #ff5500;*/
            position: absolute;
            top: 15px;
            left: 375px;
            margin-left: 40px;
            height: 230px;
            width: 265px;
        }

        #movido img{
            background-color: #FFC414 !important;
            margin-top: 0px !important;
            margin-left: 20px;
            height: auto;
            width: 90%;
        }

        .desc_prod img{
            margin-top: 0px !important;
            height: auto;
            width: 40%;
        }

        table {border-collapse:collapse; border: none;}

        td {padding: 0;}
    </style>
</head>
<body>
<!-- Custom HTML header -->
<div id="header">
    <center><img src="{{ public_path('/imagenes/Banner-comercial/SinFondo1.png') }}"
                 style="width: 100%; height: 100px;"></center>
</div>  <!-- Custom HTML footer -->
<div id="footer">
    <img src="{{ public_path('/imagenes/Banner-comercial/Sinfondo.png') }}" style="width: 100%; height: 90px;" alt="">
</div>
<div>
    <div class="fecha">
        <b>Lima, {{ Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('d') }} de </b>
        @if ( Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 1 )
            <b>Enero</b>
        @elseif ( Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 2)
            <b>Febrero</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 3)
            <b>Marzo</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 4)
            <b>Abril</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 5)
            <b>Mayo</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 6)
            <b>Junio</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 7)
            <b>Julio</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 8)
            <b>Agosto</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 9)
            <b>Setiembre</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 10)
            <b>Octubre</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 11)
            <b>Noviembre</b>
        @elseif (Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('m') == 12)
            <b>Diciembre</b>
        @endif

        <b> del {{ Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('Y') }}</b> <br>
        COTIZACION N° {{ $cotizacion->numCoti }}
    </div>
</div>
<div id="container">
    <div>
        <table>
            <tr>
                <td><strong>Señores</strong></td>
                <td width=30>&nbsp;</td>
                <td width="120">:
                    @if($cotizacion->codiClien == 1)
                        {{ $cotizacion->nomCli  }}
                    @else
                        @if(isset($_cliente->codiClienNatu))
                            {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
                        @else
                            {{ $_cliente->razonSocialClienJ }}
                        @endif
                    @endif

                </td>
            </tr>
            @if($cotizacion->codiContacClien != 1)
                <tr>
                    <td><strong>Atención</strong></td>
                    <td width=30>&nbsp;</td>
                    <td width="120">:
                        @if(isset($contactoCliente->codiContacClien))
                            {{ $contactoCliente->nombreContacClien }} {{ $contactoCliente->apePaterContacC }} {{ $contactoCliente->apeMaterContacC }}
                        @else
                            {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
                        @endif
                    </td>
                </tr>
            @elseif($cotizacion->nomContac != '')
                <tr>
                    <td><strong>Atención</strong></td>
                    <td width=30>&nbsp;</td>
                    <td>: {{$cotizacion->nomContac}}
                    </td>
                </tr>
            @endif
            <tr>
                <td><strong>Asunto</strong></td>
                <td width=30>&nbsp;</td>
                <td>:
                    {{ $cotizacion->asuntoCoti }}
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <p>Por la presente le hacemos llegar nuestra propuesta TÉCNICO - ECONÓMICA
            del {{ $costeo->tipoCosteo == 0 ? 'producto' : 'servicio'  }}
            solicitado:</p>
    </div>
    <br>
    <div>
        <table id="tbl_productos">
            <thead>
            <tr id="tbl-header">
                <th width=30>CANT</th>
                <th width=320>PRODUCTO</th>
                <th width="100">UNIDAD</th>
                <th width="100">TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td valign="top"
                        style="vertical-align: text-top; text-align: center; border-bottom: 0.5px solid #9f191f;">{{ str_pad($producto->cantiCoti, 2, "0", STR_PAD_LEFT) }}</td>
                    <td class="desc_prod" style="border-bottom: 0.5px solid #9f191f;">
                        @if($producto->itemCosteo != ".")
                            <b>{{ $producto->itemCosteo }}</b><br>
                        @else
                            <b>{{ $producto->nombreProducProveedor }}</b><br>
                        @endif
                        @if(strlen($producto->descCosteoItem) >= 0 && strlen($producto->descCosteoItem) < 10 )
                                @if($producto->imagen == "" || $producto->imagen == "<p>default.jpg</p>" || $producto->imagen == "default.jpg")
                                <div id="relativo"
                                     style="height:auto !important; ">
                                    {!! $producto->descCosteoItem !!}<br>
                                </div>
                            @else
                                <div id="relativo"
                                     style="height:230px !important; ">
                                    {!! $producto->descCosteoItem !!}<br>
                                    <div id="movido">
                                        {!! $producto->imagen !!}
                                    </div>
                                </div>
                            @endif
                        @elseif(strlen($producto->descCosteoItem) > 10 && strlen($producto->descCosteoItem) < 50)
                            @if($producto->imagen == "" || $producto->imagen == "<p>default.jpg</p>" || $producto->imagen == "default.jpg")
                                <div id="relativo"
                                     style="height:auto !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                </div>
                            @else
                                <div id="relativo"
                                     style="height:230px !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                    {{--{{strlen($producto->descCosteoItem)}}--}}
                                    <div id="movido">
                                        {!! $producto->imagen !!}
                                    </div>
                                </div>
                            @endif
                        @elseif(strlen($producto->descCosteoItem) > 50 && strlen($producto->descCosteoItem) < 150)
                                @if($producto->imagen == "" || $producto->imagen == "<p>default.jpg</p>" || $producto->imagen == "default.jpg")
                                <div id="relativo"
                                     style="height:auto !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                </div>
                            @else
                                <div id="relativo"
                                     style="height:230px !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                    <div id="movido">
                                        {!! $producto->imagen !!}
                                    </div>
                                </div>
                            @endif
                        @elseif(strlen($producto->descCosteoItem) > 150 && strlen($producto->descCosteoItem) < 300)
                                @if($producto->imagen == "" || $producto->imagen == "<p>default.jpg</p>" || $producto->imagen == "default.jpg")
                                <div id="relativo"
                                     style="height:auto !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                </div>
                            @else
                                <div id="relativo"
                                     style="height:230px !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                    <style>
                                        #movido img {
                                            height: 90% !important;
                                        }
                                    </style>
                                    <div id="movido">
                                        {!! $producto->imagen !!}
                                    </div>
                                </div>
                            @endif
                        @elseif(strlen($producto->descCosteoItem) > 300 && strlen($producto->descCosteoItem) < 500)
                                @if($producto->imagen == "" || $producto->imagen == "<p>default.jpg</p>" || $producto->imagen == "default.jpg")
                                <div id="relativo"
                                     style="height:auto !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                </div>
                            @else
                                <div id="relativo"
                                     style="height:230px !important;">
                                    {!! $producto->descCosteoItem !!}<br>
                                    <style>
                                        #movido img {
                                            height: 90% !important;
                                        }
                                    </style>
                                    <div id="movido">
                                        {!! $producto->imagen !!}
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="relativo">
                                {!! $producto->descCosteoItem !!}<br>
                                {{--{{strlen($producto->descCosteoItem)}}--}}
                                <style>
                                    #movido img {
                                        /*height: 88% !important;*/
                                        width: 90% !important;
                                    }
                                </style>
                                <div id="movido">
                                    {!! $producto->imagen !!}
                                </div>
                            </div>
                        @endif
                    </td>
                    <td valign="top"
                        style="vertical-align: text-top; text-align: center; border-bottom: 0.5px solid #9f191f;">
                        <b>S/ {{ number_format( $producto->precioUniSoles, 2, '.', ',' ) }}</b>
                    </td>
                    <td valign="top"
                        style="vertical-align: text-top; text-align: center; border-bottom: 0.5px solid #9f191f;">
                        <b>S/ {{ number_format( $producto->precioTotal, 2, '.', ',' ) }}</b>
                    </td>
                </tr>
                {{--<tr>--}}
                    {{--<td style="border-bottom: 0.5px solid #9f191f;">&nbsp;</td>--}}
                    {{--<td style="border-bottom: 0.5px solid #9f191f;">--}}
                    {{--</td>--}}
                    {{--<td colspan="2"--}}
                        {{--style="text-align: center; border-bottom: 0.5px solid #9f191f;">--}}
                    {{--</td>--}}
                {{--</tr>--}}
            @endforeach
            @if($costeo->mostrarTotal == 1)
                <tr>
                    <td colspan="3" style="text-align: center; background-color: #f7bc60;">
                        <b>TOTAL COTIZACION</b>
                    </td>
                    <td style="text-align: center; background-color: #f7bc60;">
                        <b>S/ {!! number_format( $costeo->totalVentaSoles, 2, '.', ',' ) !!}</b>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{--@if(count($productos) >= 2)--}}
        {{--<div class="row" style="height: {{190}}px !important;">&nbsp;</div>--}}
    {{--@endif--}}
    <br>
    <div id="condiciones" style="margin-left: 30px; margin-top: {{ $cotizacion->margen_condi }}px;">
        <b><u>CONDICIONES COMERCIALES</u></b>
        <ul>
            @foreach($condicionesCom as $cond)
                <li>{{ $cond->descripcion }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <div style="margin-top: 5px; text-align: left; margin-top: {{ $cotizacion->margen_firma }}px; margin-left: 540px">
            <b><u>Firma</u></b>
            <p>{{ $colaborador->nombreCola }} {{ $colaborador->apePaterCola }} {{ $colaborador->apeMaterCola }}</p>
            <p>{{ $cargo->nombreCargo }}</p>
            <p>{{ $colaborador->correoCorpoCola }}</p>
            <p>{{ $colaborador->celuCorpoCola }}</p>
        </div>
    </div>
</div>

</body>
</html>