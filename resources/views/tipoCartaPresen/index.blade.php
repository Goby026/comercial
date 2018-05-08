@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado tipos de carta de presentación<a href="tipoCartaPresen/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>
			@include('tipoCartaPresen.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Tipo de carta</th>
						<th>Nombre</th>
						<th>Nombre breve</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($tipoCartas as $tipo)
						<tr>
							<td>{{ $tipo->tipoCartaPresen }}</td>
							<td>{{ $tipo->nombreTipoCartaP }}</td>
							<td>{{ $tipo->nombreBreveTipoCartaP }}</td>
							@if($tipo->estaTipoCartaPresen == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('TipoCartaPresenController@edit',$tipo->codiTipoCartaPresen)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$tipo->codiTipoCartaPresen}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('tipoCartaPresen.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$tipoCartas->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection