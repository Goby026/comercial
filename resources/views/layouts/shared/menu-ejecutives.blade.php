<li><a href="{{url('home')}}"><i class="fa fa-building-o"></i> Inicio</a></li>
<li><a href="{{url('cotizaciones')}}"><i class="fa fa-money"></i> Cotizaciones</a></li>
{{--<li><a href="{{url('cotizaciones/cotiCola')}}"><i class="fa fa-th"></i> Cotizaciones por--}}
        {{--colaborador</a></li>--}}
<li><a href="{{url('cotizacionFinal')}}"><i class="fa fa-circle-o"></i>Cierre de Cotizaciones</a></li>
{{--<li><a href="#"><i class="fa fa-file-text-o"></i> Pipeline</a></li>--}}
{{--<li><a href="#"><i class="fa fa-file-text"></i> Forecast</a></li>--}}
@if(Auth::user()->codiCargo == '6' || Auth::user()->codiCargo == '3')
        <li><a href="{{url('utilidades')}}"><i class="fa fa-circle-o"></i>Reportes de Utilidad</a></li>
@endif
<li><a href="{{url('cartaPresentacion')}}"><i class="fa fa-file-powerpoint-o"></i> Carta de presentación</a>
</li>
<li><a href="{{url('tipoCartaPresen')}}"><i class="fa fa-cog"></i> Tipo de carta de
        presentación</a></li>
<li><a href="{{url('condicionesComerciales')}}"><i class="fa fa-list"></i> Condiciones
        comerciales</a></li>