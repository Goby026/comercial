@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de clientes<a href="clientes/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>
			@include('clientes.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Cliente</th>						
						<th>Tipo de cliente</th>
						<th>DNI / RUC</th>
						<th>ESTADO</th>
					</thead>
					<tbody>
						@foreach($clientes as $cli)
						<tr>
							@if( $cli->codiClienNatu != '001' )
							<td>{{ $cli->apePaterClienN }} {{ $cli->apeMaterClienN }} {{ $cli->nombreClienNatu }}</td>
							@else
							<td>{{ $cli->razonSocialClienJ }}</td>
							@endif
							<td>{{ $cli->nombreTipoCliente }}</td>
							@if( $cli->codiClienNatu != '001' )
							<td>{{ $cli->dniClienNatu }}</td>
							@else
							<td>{{ $cli->rucClienJuri }}</td>
							@endif
							@if($cli->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('ClienteController@edit',$cli->codiClien)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cli->codiClien}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{ $clientes->render() }}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection