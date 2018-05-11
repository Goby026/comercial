@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Clientes Naturales<a href="clientesNaturales/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('clientesNaturales.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Cliente</th>
						<th>Dni</th>
						<th>Dirección</th>
						<th>Distrito</th>
						<th>Provincia</th>
						<th>Departamento</th>
						<th>Correo</th>
						<th>Teléfono</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($ClientesNaturales as $clientesN)
							<td>{{ $clientesN->nombreClienNatu }} {{ $clientesN->apePaterClienN }} {{ $clientesN->apeMaterClienN }}</td>
							<td>{{ $clientesN->dniClienNatu }}</td>
							<td>{{ $clientesN->direcClienNatu }}</td>
							<td>{{ $clientesN->codiDistri }}</td>
							<td>{{ $clientesN->codiProvin }}</td>
							<td>{{ $clientesN->codiDepar }}</td>
							<td>{{ $clientesN->correoClienNatu }}</td>
							<td>{{ $clientesN->tele01ClienNatu }}</td>
							<td>{{ $clientesN->estado }}</td>							
							<td>								
								<a href="{{URL::action('ClienteNaturalController@edit',$clientesN->codiClienNatu)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$clientesN->codiClienNatu}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('clientesNaturales.modal') <!-- incluimos el archivo del modal -->						
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$ClientesNaturales->render()}}
		</div>
	</div>
@endsection