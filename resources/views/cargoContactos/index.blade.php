@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Cargos<a href="cargoContactos/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('cargoContactos.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre Cargo</th>
						<th>Nombre Breve</th>
						<th><center>Estado</center></th>
					</thead>
					<tbody>
						@foreach($cargos as $cargo)
						<tr>
							<td>{{ $cargo->codiCargoContac }}</td>
							<td>{{ $cargo->nombreCargoContac }}</td>
							<td>{{ $cargo->nombreBreveCargoContac }}</td>
							@if($cargo->estaCargoContac == 1)
							<td><center>ACTIVADO</center></td>
							@else
							<td><center>DESACTIVADO</center></td>
							@endif
							<td>
								<a href="{{URL::action('CargoContactoController@edit',$cargo->codiCargoContac)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cargo->codiCargoContac}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('cargoContactos.modal') <!-- incluimos el archivo del modal para eliminar -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$cargos->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection