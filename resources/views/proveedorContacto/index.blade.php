@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Contactos<a href="proveedorContacto/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('proveedorContacto.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Contacto</th>
						<th>Dni</th>
						<th>Cel - 1</th>
						<th>Cel - 2</th>
						<th>Email - 1</th>
						<th>Proveedor</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($proveedorContactos as $provContac)
						<tr>
							<td>{{ $provContac->codiProveeContac }}</td>
							<td>{{ $provContac->nombreProveeContac }} {{ $provContac->apePaterProveeC }} {{ $provContac->apeMaterProveeC }}</td>
							<td>{{ $provContac->dniProveeContac }}</td>
							<td>{{ $provContac->celu01ProveeContac }}</td>
							<td>{{ $provContac->celu02ProveeContac }}</td>
							<td>{{ $provContac->correo01ProveeContac }}</td>
							<td>{{ $provContac->nombreProveedor }}</td>
							@if($provContac->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('ProveedorContactoController@edit',$provContac->codiProveeContac)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$provContac->codiProveeContac}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('proveedorContacto.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$proveedorContactos->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection