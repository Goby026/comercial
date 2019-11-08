<style>
    * {
        margin: 0;
        padding: 0;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }

    .contenido {
        /*font: 12pt Georgia, "Times New Roman", Times, serif;*/
        font-size: 11px;
        line-height: 1.3;
        padding-top: 100px;
        padding-left: 50px;
        padding-right: 50px;
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

    .fecha {
        text-align: right;
    }

    .padre {
        width: 100%;
    }

    .hijo {
        display: inline-block;
    }
</style>
<div id="header">
    <img src="{{ public_path('/imagenes/Banner-comercial/header2019.jpg') }}"
         style="width: 100%; height: 80px;">
</div>  <!-- Custom HTML footer -->
<div id="footer">
    <img src="{{ public_path('/imagenes/Banner-comercial/footer2019.jpg') }}" style="width: 100%; height: 90px;" alt="">
</div>
<div class="contenido">
    <div class="fecha">
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
    </div>
    <div class="cotizacion">
        <table id="tbl_productos" style="width: 100%;">
            <thead style="border: 0.5px solid">
            <tr id="tbl-header">
                <td style="width:5%">CANT</td>
                <td style="width:65%">PRODUCTO</td>
                <td style="width:15%">UNIDAD</td>
                <td style="width:15%">TOTAL</td>
            </tr>
            </thead>
        </table>
        @foreach($costeos as $costeo)

            @foreach($items as $item)

                @if($costeo->codiCosteo == $item->codiCosteo)

                    @if($item->tipoCosteo == 1)
                        <table>
                            <tr>
                                <td width=5%>{{$item->cantiCoti}}</td>
                                <td width=65%>{{$item->descCosteoItem}}</td>
                                <td width=15%>{{$item->precioUniSoles}}</td>
                                <td width=15%>{{$item->precioTotal}}</td>
                            </tr>
                        </table>
                        <div>
                            {!! $item->descCosteoItem !!}
                        </div>
                    @else
                        <div class="padre">
                            <div class="hijo" style="width: 5%;">{{$item->cantiCoti}}</div>
                            <div class="hijo" style="width: 81%;">{!! $item->descCosteoItem !!}</div>
                            <div class="hijo" style="width: 7%;">{{$item->precioUniSoles}}</div>
                            <div class="hijo" style="width: 7%;">{{$item->precioTotal}}</div>
                        </div>

                    @endif

                @endif
            @endforeach
        @endforeach
    </div>
</div>

