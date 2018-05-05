@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Colaboradores<a href="colaboradores/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('colaboradores.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Colaborador</th>
						<th>Dni</th>
						<th>Correo corporativo</th>
						<th>Celular corporativo</th>
						<th style="width:20%"><center>Imagen</center></th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($colaborador as $col)
						<tr>
							<td>
								<a href="{{URL::action('ColaboradorController@edit',$col->codiCola)}}">{{ $col->nombreCola }} {{ $col->apePaterCola }} {{ $col->apeMaterCola }}</a>
							</td>
							<td>{{ $col->dniCola }}</td>
							<td>{{ $col->correoCorpoCola }}</td>
							<td>{{ $col->celuCorpoCola }}</td>
							<td>
								<center>
									<img src="{{asset('imagenes/colaboradores/'.$col->fotoCola)}}" class="img-circle" style="width:20%">
								</center>								
							</td>
							@if($col->estado == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('ColaboradorController@edit',$col->codiCola)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$col->codiCola}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('colaboradores.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$colaborador->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection