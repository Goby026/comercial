@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Proveedores<a href="proveedores/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('proveedores.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre Proveedor</th>
						<th>Nombre Breve</th>
						<th>Ruc</th>
						<th>Dirección</th>
						<th>Web</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($proveedores as $proveedor)
						<tr>
							<td>{{ $proveedor->codiProveedor }}</td>
							<td>{{ $proveedor->nombreProveedor }}</td>
							<td>{{ $proveedor->nombreBreveProveedor }}</td>
							<td>{{ $proveedor->RucProveedor }}</td>
							<td>{{ $proveedor->direcProveedor }}</td>
							<td>{{ $proveedor->webProveedor }}</td>
							@if($proveedor->estaProveedor == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('ProveedorController@edit',$proveedor->codiProveedor)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$proveedor->codiProveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('proveedores.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$proveedores->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection