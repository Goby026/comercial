@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cerrar cotizaciones<a href="cotizacionEstados/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			{{--@include('cotizacionEstados.search')--}}
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>#</th>
						<th>CodiCoti</th>
						<th>CodiCola</th>
						<th>CodiCosteo</th>
						<th>fechaHoraIni</th>
						<th>fechaHoraFin</th>
						<th>codiTipoComproPago</th>
						<th>numeComproPago</th>
						<th>codiEstaComproPago</th>
						<th>montoTotalFactuSIGV</th>
						<th>utilidadFinal</th>
						<th>margenFinal</th>
					</thead>
					<tbody>
						@foreach($CotizacionFinal as $cf)
						<tr>
							<td>{{ $cf->codiCoti }}</td>
							<td>{{ $cf->codiCola }}</td>
							<td>{{ $cf->codiCosteo }}</td>
							<td>{{ $cf->fechaHoraIni }}</td>
							<td>{{ $cf->fechaHoraFin }}</td>
							<td>{{ $cf->codiTipoComproPago }}</td>
							<td>{{ $cf->numeComproPago }}</td>
							<td>{{ $cf->codiEstaComproPago }}</td>
							<td>{{ $cf->montoTotalFactuSIGV }}</td>
							<td>{{ $cf->utilidadFinal }}</td>
							<td>{{ $cf->margenFinal }}</td>

						</tr>
						@include('cotizacionEstados.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{--{{$cotizacionEstados->render()}}--}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection