@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Tipos de cliente Jurídicos<a href="tipoClientesJuridicos/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('tipoClientesJuridicos.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Descripción</th>						
					</thead>
					<tbody>
						@foreach($tipoClientesJuridicos as $tipos)
						<tr>
							<td>{{ $tipos->codiTipoCliJur }}</td>
							<td>{{ $tipos->descTipoCliJur }}</td>
							<td>
								<a href="{{URL::action('TipoClienteJuridicoController@edit',$tipos->codiTipoCliJur)}}"><button class="btn btn-info">Editar</button></a>
								<!-- <a href="{{URL::action('TipoClienteController@destroy',$tipos->codiTipoCliJur)}}"><button class="btn btn-danger">Eliminar</button></a> -->
								<a href="" data-target="#modal-delete-{{$tipos->codiTipoCliJur}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('tipoClientesJuridicos.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$tipoClientesJuridicos->render()}}
		</div>
	</div>
@endsection