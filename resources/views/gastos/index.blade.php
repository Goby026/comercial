@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Gastos</h3>
			{{--<a href="dolar/create"><button class="btn btn-success pull-right">Nuevo</button></a>--}}
			@include('gastos.search')
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>COTIZACION</th>
						<th>DOCUMENTO</th>
						<th>NRO</th>
						<th>FECHA</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>
					</thead>
					<tbody>
						@foreach($gastos as $gasto)
						<tr>
							<td>{{ $gasto->numCoti }}</td>
							<td>{{ $gasto->nombreTipoComproPago }}</td>
							<td>{{ $gasto->numeComproPago }}</td>
							<td>{{ $gasto->fechaHoraFin }}</td>
							<td>{{ $gasto->Costo }}</td>
							<td>
								<a href="#"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$d->codiDolar}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						{{--@include('gastos.modal') <!-- incluimos el archivo del modal -->--}}
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$gastos->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection