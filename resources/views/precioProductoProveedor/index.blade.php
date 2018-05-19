@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Precios<a href="precioProductoProveedor/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('precioProductoProveedor.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Producto</th>
						<th>Proveedor</th>
						<th>Precio</th>
						<th>Creado por</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($precios as $precio)
						<tr>
							<td>{{ $precio->nombreProducProveedor }}</td>
							<td>{{ $precio->nombreProveedor }}</td>
							<td>{{ $precio->precioProducDolar }}</td>
							<td>{{ $precio->nombreCola }}</td>
							@if($precio->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('PrecioProductoProveedorController@edit',$precio->idTPrecioProductoProveedor)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$precio->idTPrecioProductoProveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('precioProductoProveedor.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$precios->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection