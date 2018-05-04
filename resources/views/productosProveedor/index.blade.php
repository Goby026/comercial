@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Productos por Proveedor<a href="productosProveedor/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('productosProveedor.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Producto</th>
						<th>Nombre Breve</th>
						<th>Marca</th>
						<th>Código de Marca</th>
						<th>Código Interno</th>
						<th>Descripción</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($productosProv as $prod)
						<tr>
							<td>{{ $prod->nombreProducProveedor }}</td>
							<td>{{ $prod->nombreBreveProducP }}</td>
							<td>{{ $prod->Marca }}</td>
							<td>{{ $prod->codiProducMarca }}</td>
							<td>{{ $prod->codInterno }}</td>
							<td>{{ $prod->descripProduc }}</td>
							@if($prod->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('ProductoProveedorController@edit',$prod->codiProducProveedor)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$prod->codiProducProveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('productosProveedor.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$productosProv->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection