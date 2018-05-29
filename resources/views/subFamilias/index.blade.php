@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Sub Familias de productos<a href="subFamilias/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('subFamilias.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nombre</th>
						<th>Nombre Breve</th>
						<th>Familia</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($subFamilias as $sub)
						<tr>
							<td>{{ $sub->nombreSubFamilia }}</td>
							<td>{{ $sub->nombreBreveSubFamilia }}</td>
							@if($sub->estado == 1)
							<td>{{ $sub->nombreFamilia }}</td>
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('SubFamiliaController@edit',$sub->codiSubFamilia)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$sub->codiSubFamilia}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('subFamilias.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$subFamilias->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection