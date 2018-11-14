<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cotizacion</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
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

        #tbl-header{
            background-color: #9f191f;
            color: #FDFDFD;
            text-align: center;
        }
    </style>
</head>
<body>
<div id="header">
    <center><img src="{{ public_path('/imagenes/Banner-comercial/SinFondo1.png') }}"
                 style="width: 100%; height: 100px;"></center>
</div>  <!-- Custom HTML footer -->
<div id="footer">
    <img src="{{ public_path('/imagenes/Banner-comercial/Sinfondo.png') }}" style="width: 100%; height: 90px;" alt="">
</div>
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="pull-right">
                <b>Lima, {{ Carbon\Carbon::parse($cotizacion->fechaCoti)->format('d') }} de </b>
                @if ( Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 1 )
                    <b>Enero</b>
                @elseif ( Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 2)
                    <b>Febrero</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 3)
                    <b>Marzo</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 4)
                    <b>Abril</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 5)
                    <b>Mayo</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 6)
                    <b>Junio</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 7)
                    <b>Julio</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 8)
                    <b>Agosto</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 9)
                    <b>Setiembre</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 10)
                    <b>Octubre</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 11)
                    <b>Noviembre</b>
                @elseif (Carbon\Carbon::parse($cotizacion->fechaCoti)->format('m') == 12)
                    <b>Diciembre</b>
                @endif

                <b> del {{ Carbon\Carbon::parse($costeo->fechaIniCosteo)->format('Y') }}</b> <br>
                COTIZACION N° {{ $cotizacion->numCoti }}
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <table>
                <tr>
                    <td><strong>Señores</strong></td>
                    <td>&nbsp;</td>
                    <td>:
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
                        <td>&nbsp;</td>
                        <td>:
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
                        <td>&nbsp;</td>
                        <td>: {{$cotizacion->nomContac}}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td><strong>Asunto</strong></td>
                    <td>&nbsp;</td>
                    <td>:
                        {{ $cotizacion->asuntoCoti }}
                    </td>
                </tr>
                @if($cotizacion->referencia != '')
                    <tr>
                        <td><strong>Referencia</strong></td>
                        <td>&nbsp;</td>
                        <td>: {{$cotizacion->referencia}}
                        </td>
                    </tr>
                @endif
            </table>
            <p style="margin-top: 5px;">Por la presente le hacemos llegar nuestra propuesta TÉCNICO - ECONÓMICA
                del {{ $costeo->tipoCosteo == 0 ? 'producto' : 'servicio'  }}
                solicitado:</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <table id="tbl_productos" style="width: 100%;">
                <thead style="border: 0.5px solid">
                <tr id="tbl-header">
                    <td width=30>CANT</td>
                    <td width=320>PRODUCTO</td>
                    <td width="100">UNIDAD</td>
                    <td width="100">TOTAL</td>
                </tr>
                </thead>
            </table>
            @foreach($productos as $producto)
                <div style="border: 0.5px solid">
                    <table id="tbl_productos" style="width: 100%;">
                        <thead>
                            <tr>
                                <td width=30 style="text-align: center;">
                                    <b>{{ str_pad($producto->cantiCoti, 2, "0", STR_PAD_LEFT) }}</b></td>
                                <td width=320><b>{{ $producto->itemCosteo }}</b></td>
                                <td width="100" style="text-align: center;">
                                    <b>
                                        @if($costeo->currency == 0)
                                            S/ {{ number_format( $producto->precioUniSoles, 2, '.', ',' ) }}
                                        @else
                                            $ @convert($producto->precioUniSoles/$dolar->dolarVenta)
                                        @endif
                                    </b>
                                </td>
                                <td width="100" style="text-align: center;">
                                    <b>
                                        @if($costeo->currency == 0)
                                            S/ {{ number_format( $producto->precioTotal, 2, '.', ',' ) }}
                                        @else
                                            {{--$ {{ number_format( ($producto->precioTotal/$dolar->dolarVenta), 2, '.') }}--}}
                                            $ @convert($producto->precioTotal/$dolar->dolarVenta)
                                        @endif
                                    </b>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <div style="width: 100%; padding: 5px; margin-left: 37px;">
                        {!! $producto->descCosteoItem !!}
                    </div>
                </div>
            @endforeach

            @if($costeo->mostrarTotal == 1)
            <table style="width: 100%;">
                <thead style="border: 0.5px solid">
                    <tr>
                        <td colspan="3" style="text-align: center; background-color: #f7bc60;">
                            <b>TOTAL COTIZACION</b>
                        </td>
                        <td style="text-align: center; background-color: #f7bc60;">
                            <b>
                                @if($costeo->currency == 0)
                                    S/ {!! number_format( $costeo->totalVentaSoles, 2, '.', ',' ) !!}
                                @else
                                    {{--$ {{ number_format( ($producto->totalVentaSoles/$dolar->dolarVenta), 2, '.') }}--}}
                                    $ @convert($costeo->totalVentaSoles/$dolar->dolarVenta)
                                @endif
                            </b>
                        </td>
                    </tr>
                </thead>
            </table>
            @endif
        </div>
    </div>

    <br>
    <div id="condiciones" style="margin-left: 30px; margin-top: {{ $cotizacion->margen_condi }}px;">
        <b>TERMINOS COMERCIALES</b>
        <ul style="list-style-type: none; margin: 0; padding: 0;">
            @foreach($condicionesCom as $cond)
                <li>{{ $cond->descripcion }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <div style="margin-top: 5px; padding: 0px; text-align: left; margin-top: {{ $cotizacion->margen_firma }}px; margin-left: 500px">
            <b>Firma</b>
            <ul style="list-style-type: none; margin: 0; padding: 0;">
                <li>{{ $colaborador->nombreCola }} {{ $colaborador->apePaterCola }} {{ $colaborador->apeMaterCola }}</li>
                <li>{{ $cargo->nombreCargo }}</li>
                <li>{{ $colaborador->correoCorpoCola }}</li>
                <li>{{ $colaborador->celuCorpoCola }}</li>
            </ul>
        </div>
    </div>

</div>

</body>
</html>