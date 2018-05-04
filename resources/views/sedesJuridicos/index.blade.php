@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Sedes clientes <a href="sedesJuridicos/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('sedesJuridicos.search')
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Fecha creación</th>
						<th>Cliente</th>
					</thead>
					<tbody>
						@foreach($SedesJuridico as $sede)
						<tr>
							<td>{{ $sede->codiSedeJur }}</td>
							<td>{{ $sede->descSedeJur }}</td>
							<td>{{ $sede->fechaSistema }}</td>
							<td>{{ $sede->Cliente }}</td>
							<td>
								<a href="{{URL::action('SedeJuridicoController@edit',$sede->codiSedeJur)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$sede->codiSedeJur}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sedesJuridicos.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$SedesJuridico->render()}}
		</div>
	</div>
@endsection