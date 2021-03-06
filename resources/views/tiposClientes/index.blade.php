@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Tipos de cliente <a href="tiposClientes/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('tiposClientes.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Nombre Breve</th>
						<th>Entidad</th>
					</thead>
					<tbody>
						@foreach($tipoClientes as $tipos)
						<tr>
							<td>{{ $tipos->codiTipoCliente }}</td>
							<td>{{ $tipos->nombreTipoCliente }}</td>
							<td>{{ $tipos->nombreBreveTipoCliente }}</td>
							<td>{{ $tipos->entidad }}</td>
							<td>
								<a href="{{URL::action('TipoClienteController@edit',$tipos->codiTipoCliente)}}"><button class="btn btn-info">Editar</button></a>
								<!-- <a href="{{URL::action('TipoClienteController@destroy',$tipos->codiTipoCliente)}}"><button class="btn btn-danger">Eliminar</button></a> -->
								<a href="" data-target="#modal-delete-{{$tipos->codiTipoCliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('tiposClientes.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$tipoClientes->render()}}
		</div>
	</div>
@endsection