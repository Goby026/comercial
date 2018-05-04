@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Marcas<a href="marcaProducto/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>
			@include('marcaProducto.search')
			<a href="{{ URL::action('ExcelController@index',[]) }}"><button class="btn btn-success pull-right">Crear Excel</button></a>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>						
						<th>Marca</th>
						<th>Nombre Breve</th>
						<th><center>Logo</center></th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($marcasProductos as $marcas)
						<tr>							
							<td>{{ $marcas->nombreMarca }}</td>
							<td>{{ $marcas->nombreBreveMarca }}</td>
							<td>
								<center>
								<img src="{{ asset('imagenes/marcas/'.$marcas->imagenMarca) }}" alt="{{ $marcas->nombreBreveMarca }}" style="width: 20%;">
								</center>
							</td>
							@if($marcas->estaMarca == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif							
							<td>
								<a href="{{URL::action('MarcaProductoController@edit',$marcas->codiMarca)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$marcas->codiMarca}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('marcaProducto.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$marcasProductos->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection