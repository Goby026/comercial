@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Clientes Jurídicos<a href="clientesJuridicos/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('clientesJuridicos.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Cod</th>
						<th>Razon Social</th>
						<th>Ruc</th>
						<th>Dirección</th>
						<th>Distrito</th>
						<th>Provincia</th>
						<th>Departamento</th>
						<th>Tipo Cliente</th>
						<th>Web</th>
						<th>Operaciones</th>
					</thead>
					<tbody>
						@foreach($ClientesJuridicos as $clientesJ)
						<tr>
							<td>{{ $clientesJ->codiClienJuri}}</td>
							<td>{{ $clientesJ->razonSocialClienJ }}</td>
							<td>{{ $clientesJ->rucClienJuri }}</td>
							<td>{{ $clientesJ->direcClienJuri }}</td>
							<td>{{ $clientesJ->codiDistri }}</td>
							<td>{{ $clientesJ->codiProvin }}</td>
							<td>{{ $clientesJ->codiDepar }}</td>
							<td>{{ $clientesJ->tipo }}</td>
							<td>{{ $clientesJ->webClienJuri }}</td>
							<td>
								<a href="" data-target="#modal-sedes-{{$clientesJ->codiClienJuri}}" data-toggle="modal"><button class="btn btn-info">Sedes</button></a>
								<a href="{{URL::action('ClienteJuridicoController@edit',$clientesJ->codiClienJuri)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$clientesJ->codiClienJuri}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('clientesJuridicos.modal') <!-- incluimos el archivo del modal -->
						@include('clientesJuridicos.modalSedes') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$ClientesJuridicos->render()}}
		</div>
	</div>
@endsection