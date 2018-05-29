@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Familias de productos<a href="familias/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('familias.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nombre</th>
						<th>Nombre Breve</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($familias as $familia)
						<tr>
							<td>{{ $familia->nombreFamilia }}</td>
							<td>{{ $familia->nombreBreveFamilia }}</td>
							@if($familia->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('FamiliaController@edit',$familia->codiFamilia)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$familia->codiFamilia}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('familias.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$familias->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection