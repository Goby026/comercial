@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado tipos de cambio<a href="dolar/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>
			@include('dolar.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Compra</th>
						<th>Venta</th>
						<th>Fecha</th>
						<th>Entidad</th>
						<th>Creado por</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($dolar as $d)
						<tr>
							<td>{{ $d->dolarCompra }}</td>
							<td>{{ $d->dolarVenta }}</td>
							<td>{{ $d->fechaCambio }}</td>
							<td>{{ $d->codiDolarProveedor }}</td>
							<td>{{ $d->codiCola }}</td>
							@if($d->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('DolarController@edit',$d->codiDolar)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$d->codiDolar}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('dolar.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$dolar->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection