@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de estados de costeo<a href="cotizacionEstados/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('cotizacionEstados.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nombre estado</th>
						<th>Nombre breve</th>
						<th>Orden</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($cotizacionEstados as $ce)
						<tr>
							<td>{{ $ce->nombreCotiEsta }}</td>
							<td>{{ $ce->nombreBreveCotiEsta }}</td>
							<td>{{ $ce->ordenCotiEsta }}</td>							
							@if($ce->estaCotiEsta == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('CotizacionEstadoController@edit',$ce->codiCotiEsta)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ce->codiCotiEsta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('cotizacionEstados.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$cotizacionEstados->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection