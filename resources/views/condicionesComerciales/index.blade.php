@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado condiciones comerciales<a href="condicionesComerciales/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>
			@include('condicionesComerciales.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Descripción</th>
						<th>Defecto</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($condicionesComerciales as $cc)
						<tr>
							<td>{{ $cc->descripCondiComer }}</td>
							<td>{{ $cc->defecCondiComer }}</td>
							@if($cc->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('CondicionesComercialesController@edit',$cc->codiCondiComer)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cc->codiCondiComer}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('condicionesComerciales.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$condicionesComerciales->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection