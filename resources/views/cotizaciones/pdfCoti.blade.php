<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            /*font: 12pt Georgia, "Times New Roman", Times, serif;*/
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
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
            margin-left: 30px;
            margin-right: 20px;
        }

        #tbl-header{
            background-color: #9f191f;
            color: #FDFDFD;
            text-align: center;
        }

        #tbl_productos {
            border:1px solid #1c2529;
            max-height: 50%;
            padding:0;
        }

        #data-row{
            text-align: center;
        }

        .fecha{
            margin-right: 30px;
            text-align: right;
        }

        .row{
            width: 100%;
        }

        .condiciones{
            margin-left: 30px;
        }

        body {
            padding-top: 80px;
        }

        #img_field{
            width: 250px;
        }

        #img-product{
            width: 100%;
        }
        .custom-page-start {
            margin-top: 20px;
        }

        .custom-footer-page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>
<!-- Custom HTML header -->
<div id="header">
    <center><img src="{{ public_path('/imagenes/Banner-comercial/SinFondo1.png') }}" style="width: 100%; height: 100px;"></center>
</div>  <!-- Custom HTML footer -->
<div id="footer">
    <img src="{{ public_path('/imagenes/Banner-comercial/SinFondo3.png') }}" style="width: 100%; height: 90px;" alt="">
</div>
<div class="row">
    <div class="fecha">
        <b> Huancayo, {{ date('d') }} de </b>
        @if (date('m') == 1)
            <b>Enero</b>
        @elseif (date('m') == 2)
            <b>Febrero</b>
        @elseif (date('m') == 3)
            <b>Marzo</b>
        @elseif (date('m') == 4)
            <b>Abril</b>
        @elseif (date('m') == 5)
            <b>Mayo</b>
        @elseif (date('m') == 6)
            <b>Junio</b>
        @elseif (date('m') == 7)
            <b>Julio</b>
        @elseif (date('m') == 8)
            <b>Agosto</b>
        @elseif (date('m') == 9)
            <b>Setiembre</b>
        @elseif (date('m') == 10)
            <b>Octubre</b>
        @elseif (date('m') == 11)
            <b>Noviembre</b>
        @elseif (date('m') == 12)
            <b>Diciembre</b>
        @endif

        <b> del {{ date('Y') }}</b> <br>
        COTIZACION N° {{ $cotizacion->numCoti }}
    </div>
</div>
<div id="container">
    <div id="main">
        <div class="row">
            <table>
                <tr>
                    <td><strong>Señores</strong></td>
                    <td width=30>&nbsp;</td>
                    <td>:
                        @if(isset($_cliente->codiClienNatu))
                            {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
                        @else
                            {{ $_cliente->razonSocialClienJ }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>Atención</strong></td>
                    <td width=30>&nbsp;</td>
                    <td>:
                        @if(isset($contactoCliente->codiContacClien))
                            {{ $contactoCliente->nombreContacClien }} {{ $contactoCliente->apePaterContacC }} {{ $contactoCliente->apeMaterContacC }}
                        @else
                            {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
                        @endif
                    </td>
                </tr>
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
        <div class="row">
            <p>Por la presente le hacemos llegar nuestra propuesta TÉCNICO - ECONÓMICA del {{ $costeo->tipoCosteo == 0 ? 'producto' : 'servicio'  }}
                solicitado:</p>
        </div>
        <br>
        <div class="row">
            <table id="tbl_productos">
                <thead>
                <tr id="tbl-header">
                    <th width=30>CANT</th>
                    <th width=300>PRODUCTO</th>
                    <th width="100">UNIDAD</th>
                    <th width="100">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td id="data-row">{{ $producto->cantiCoti }}</td>
                        <td class="desc_prod">
                            @if($producto->itemCosteo != ".")
                                {{ $producto->itemCosteo }}
                            @else
                                {{ $producto->nombreProducProveedor }}
                            @endif
                        </td>
                        <td style="text-align: center;">S/ {{ number_format( $producto->costoUniSolesIgv, 2, '.', ',' ) }}</td>
                        <td style="text-align: center;">S/ {{ number_format( $producto->costoTotalSolesIgv, 2, '.', ',' ) }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>{!! $producto->descCosteoItem !!}</td>
                        <td colspan="2" id="img_field">
                            {{--<img src="{{ public_path("imagenes/productos/$producto->imagen") }}" alt=""--}}
                                 {{--id="img-product"                            >--}}
                            {!! $producto->imagen !!}
                        </td>
                    </tr>
                @endforeach
                @if($costeo->mostrarTotal != '')
                    <tr>
                        <td colspan="3" style="text-align: center; background-color: #f7bc60;"><b>TOTAL
                                COTIZACION</b></td>
                        <td style="text-align: center; background-color: #f7bc60;">
                            <b>S/ {!! number_format( $costeo->totalVentaSoles, 2, '.', ',' ) !!}</b></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <br>
        <div class="row condiciones">
            <b><u>CONDICIONES COMERCIALES</u></b>
            <ul>
                @foreach($condicionesCom as $cond)
                    <li>{{ $cond->descripCondiComer }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

</body>
</html>