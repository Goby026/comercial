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
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Asunto <small>{{ $cotizacion->asuntoCoti }}</small>
				</h1>
			</div>
			<table>
				<thead>
					<tr>
						<th width="200">
							DETALLE
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
						<th width="50" style="text-align: center;">
							MARGEN
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($productos as $producto)
					<tr>
						<td width="300">
							{{ $producto->nombreProducProveedor }}
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->cantiCoti }}" size="2" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->precioProducDolar }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoUniIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoTotalIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoUniSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoTotalSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoTotalSolesIgv * 1.35 }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ $producto->costoTotalSolesIgv * 1.35 }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="{{ ($producto->costoTotalSolesIgv * 1.35)-$producto->costoUniSolesIgv }}" size="10" style="text-align: center;">
						</td>
						<td>
							<input type="text" name="" value="S/. 25.93" size="10" style="text-align: center;">
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection