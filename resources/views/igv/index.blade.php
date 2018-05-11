@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Igv<a href="igv/create"><button class="btn btn-success pull-right">Nuevo</button></a> </h3>
			@include('igv.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Creado por</th>
						<th>Valor Igv</th>
						<th>Fecha de registro</th>
						<th>Fecha final</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($igv as $i)
						<tr>
							<td>{{ $i->codiCola }}</td>
							<td>{{ $i->valorIgv/100 }}</td>
							<td>{{ $i->fechaInIgv }}</td>
							<td>{{ $i->fechaFinalIgv }}</td>
							@if($i->estaIgv == 1)
							<td>ACTIVADO</td>
							@else
							<td>DESACTIVADO</td>
							@endif
							<td>
								<a href="{{URL::action('IgvController@edit',$i->codiIgv)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$i->codiIgv}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('igv.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$igv->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection