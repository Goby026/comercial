@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Contactos<a href="contactosCliente/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('contactosCliente.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Contacto</th>
						<th>Email</th>
						<th>Dirección</th>
						<th>Distrito</th>
						<th>Provincia</th>
						<th>Departamento</th>
						<th>Teléfono</th>
						<th>Cliente</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($contactosCliente as $contactosC)
							<td>{{ $contactosC->nombreContacClien }} {{ $contactosC->apePaterContacC }} {{ $contactosC->apeMaterContacC }}</td>
							<td>{{ $contactosC->correoContacClien }}</td>
							<td>{{ $contactosC->direcContacClien }}</td>
							<td>{{ $contactosC->codiDistri }}</td>
							<td>{{ $contactosC->codiProvin }}</td>
							<td>{{ $contactosC->codiDepar }}</td>
							<td>{{ $contactosC->teleContacClien }}</td>
							<td>{{ $contactosC->aneContacClien }}</td>
							@if($contactosC->estado == 1)
							<td>ACTIVADO</td>
							@endif
							<td>DESACTIVADO</td>
							<td>								
								<a href="{{URL::action('ContactoClienteController@edit',$contactosC->codiContacClien)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$contactosC->codiContacClien}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('contactosCliente.modal') <!-- incluimos el archivo del modal -->						
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$contactosCliente->render()}}
		</div>
	</div>
@endsection