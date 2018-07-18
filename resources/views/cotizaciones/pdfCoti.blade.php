<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<style>
    * {
        margin: 0 10px 0 8px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 10px;
        padding: 0;
    }

    html, body {
        height: 100%;
    }

    #container {
        min-height: 100%;
    }

    #main{
        overflow: auto;
        padding-bottom: 100px;
    }

    #tbl-header{
        background-color: #9f191f;
        color: #FDFDFD;
        text-align: center;
    }

    #tbl_productos {
        border:1px solid #1c2529;
        padding:0;
    }

    #tbl_productos tr td{

    }

    #data-row{
        text-align: center;

    }

    #img-product{
        border: 1px solid;
    }

    #footer{
        height: 80px;
        /*background:black;*/
        width:100%;
        position:absolute;
        bottom:0;
        left:0;
    }

    .fecha{
        text-align: right;
    }

    .row{
        width: 100%;
    }

</style>
<div class="banner">
    <center><img src="../public/img/SinFondo1.png" style="width: 100%; height: 100px;"></center>
</div>
<!-- fecha -->
<div class="row">
    <div class="fecha"><b> Huancayo, {{ date('d') }} de {{ date('m') }} del {{ date('Y') }}</b></div>
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
        <div class="row">
            <p>Por la presente le hacemos llegar nuestra propuesta TÉCNICO - ECONÓMICA del {{ $costeo->tipoCosteo == 0 ? 'producto' : 'servicio'  }}
                solicitado:</p>
        </div>
        <div class="row">
            <table id="tbl_productos">
                <thead>
                <tr id="tbl-header">
                    <th>CANT</th>
                    <th width=385>PRODUCTO</th>
                    <th width=60>UNIDAD</th>
                    <th width=60>TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td id="data-row">{{ $producto->cantiCoti }}</td>
                        <td class="desc_prod">
                            {{ $producto->itemCosteo }}
                        </td>
                        <td style="text-align: center;">{{ $producto->costoUniSolesIgv }}</td>
                        <td style="text-align: center;">{{ $producto->costoTotalSolesIgv }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>{!! $producto->descCosteoItem !!}</td>
                        <td id="img-product" colspan="2">&nbsp;</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <b><u>CONDICIONES COMERCIALES</u></b>
            <ul>
                @foreach($condicionesCom as $cond)
                    <li>{{ $cond->descripCondiComer }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="row">
    firma
</div>

<div id="footer">
    <img src="{{ public_path('img/SinFondo3.png') }}" style="width: 100%; height: 90px;" alt="">
</div>

</body>
</html>