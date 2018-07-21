@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Costeo
			</li>
		</ol>
	</nav>
</div>
	{{-- cargar cambio y monto de igv --}}
	<div class="row">
		<div class="page-header">
			<h1>
				Asunto <small>{{ $cotizacion->asuntoCoti }}</small>
			</h1>
		</div>

	</div>
	<div class="row">
		<div class="col-md-12">
			<table>
				<thead>
					<th>Costeos</th>
					<th>Cambio</th>
					<th>Igv</th>
				</thead>
				<tbody>
					<td><input id="txt_total_costeos" name="txt_total_costeos" type="text" class="form-control" value="2">
					</td>
					<td><input id="txt_dolar" name="txt_dolar" type="text" class="form-control" value="3.3"></td>
					<td><input id="txt_igv" name="txt_igv" type="text" class="form-control" value="0.18"></td>
				</tbody>
			</table>
			<div class="row">
				{{-- <a href="{{ url('costeoExcel') }}">
					<button class="btn btn-success pull-right">Crear Excel</button>
				</a> --}}
			</div>
			<hr>
			<table>
				<thead>
					<tr>
						<th width="200">
							DETALLE
						</th>
						<th width="25" style="text-align: center;">
							M. COSTO
						</th>
						<th width="5" style="text-align: center;">
							CAN
						</th>
						<th width="50" style="text-align: center;">
							C.U $ SIN
						</th>
						<th width="50" style="text-align: center;">
							C.U $
						</th>
						<th width="50" style="text-align: center;">
							TOTAL
						</th>
						<th width="50" style="text-align: center;">
							C.U S/
						</th>
						<th width="50" style="text-align: center;">
							TOTAL
						</th>
						<th width="50" style="text-align: center;">
							P.U. S/
						</th>
						<th width="50" style="text-align: center;">
							TOTAL
						</th>
						<th width="50" style="text-align: center;">
							UTILIDAD
						</th>
						<th width="25" style="text-align: center;">
							M. VENTA
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($productos as $producto)
					<tr>
						<td width="300">
							@if($producto->itemCosteo != '.')
								{{ $producto->itemCosteo }}
							@else
								{{ $producto->nombreProducProveedor }}
							@endif
						</td>
						<td>
							<input type="text" id="txt_margen_cu_soles{{ $producto->numPack }}" name="txt_margen_cu_soles{{ $producto->numPack }}" value="{{ $producto->margenCoti }}" size="2" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_cantidad{{ $producto->numPack }}" name="txt_cantidad{{ $producto->numPack }}" value="{{ $producto->cantiCoti }}" size="2" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_cus_dolar_sin{{ $producto->numPack }}" name="txt_cus_dolar_sin{{ $producto->numPack }}" value="{{ $producto->precioProducDolar }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_cus_dolar{{ $producto->numPack }}" name="txt_cus_dolar{{ $producto->numPack }}" value="{{ $producto->costoUniIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_total_dolar{{ $producto->numPack }}" name="txt_total_dolar{{ $producto->numPack }}" value="{{ $producto->costoTotalIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_cus_soles{{ $producto->numPack }}" name="txt_cus_soles{{ $producto->numPack }}" value="{{ $producto->costoUniSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_total_soles{{ $producto->numPack }}" name="txt_total_soles{{ $producto->numPack }}" value="{{ $producto->costoTotalSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_pu_soles{{ $producto->numPack }}" name="txt_pu_soles{{ $producto->numPack }}" value="{{ $producto->margenCoti * $producto->costoTotalSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_pu_total_soles{{ $producto->numPack }}" name="txt_pu_total_soles{{ $producto->numPack }}" value="{{ $producto->margenCoti * $producto->costoTotalSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_utilidad_u{{ $producto->numPack }}" name="txt_utilidad_u{{ $producto->numPack }}" value="{{ $producto->utiCoti  }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" id="txt_margen_u{{ $producto->numPack }}" name="txt_margen_u{{ $producto->numPack }}" value="{{ $producto->margenVentaCoti  }}" size="10" style="text-align: center;">
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

<script>
    var numCoti = parseInt($("#txt_total_costeos").val());
    var cambio = $("#txt_dolar").val();
    var igv = $("#txt_igv").val();
    var total = 0;
    var utilidad = 0;

    $('input').click(function () {

        for (var i = 1; i < numCoti + 1; i++) {

            if ($(this).attr('name') === 'txt_cantidad' + i || $(this).attr('name') === 'txt_cus_dolar_sin' + i || $(this).attr('name') === 'txt_margen_cu_soles' + i) {

                var txt_cantidad = "#txt_cantidad" + i;
                var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                var txt_cus_dolar = "#txt_cus_dolar" + i;
                var txt_total_dolar = "#txt_total_dolar" + i;
                var txt_cus_soles = "#txt_cus_soles" + i;
                var txt_total_soles = "#txt_total_soles" + i;
                var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;//
                var txt_pu_soles = '#txt_pu_soles' + i;
                var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                var txt_utilidad_u = '#txt_utilidad_u' + i;
                var txt_margen_u = '#txt_margen_u' + i;

                $(txt_cantidad + ", " + txt_cus_dolar_sin + ", " + txt_margen_cu_soles).keyup(function () {
                    console.log($(this).attr('name'));
                    var cantidad = $(txt_cantidad).val();
                    var precioSinIgv = $(txt_cus_dolar_sin).val();

                    var totalDolaresCon = precioSinIgv * (parseFloat(igv) + 1);
                    var totalDolares = totalDolaresCon * cantidad;

                    var totalSolesInc = precioSinIgv * cambio * (parseFloat(igv) + 1);
                    var totalSoles = totalSolesInc * cantidad;

                    //montos en dolares
                    $(txt_cus_dolar).val(parseFloat(totalDolaresCon).toFixed(2));
                    $(txt_total_dolar).val(parseFloat(totalDolares).toFixed(2));

                    //montos en soles
                    $(txt_cus_soles).val(parseFloat(totalSolesInc).toFixed(2));
                    $(txt_total_soles).val(parseFloat(totalSoles).toFixed(2));

                    var margenCuSoles = $(txt_margen_cu_soles).val();//1.35
                    var pus = margenCuSoles * totalSoles;

                    $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                    var ventaTotal = pus;
                    var uti = ventaTotal - totalSoles;
                    var margen = (uti * 100) / ventaTotal;

                    $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                    $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                    $(txt_margen_u).val(parseFloat(margen).toFixed(2));

                    total += ventaTotal;
                    utilidad += uti;

                    $('#txt_ventaTotal').val(parseFloat(total).toFixed(2));
                    $('#txt_utilidadTotal').val(parseFloat(utilidad).toFixed(2));

                    // console.log(precioSinIgv);
                });
            }
        }

    });

</script>
@endsection