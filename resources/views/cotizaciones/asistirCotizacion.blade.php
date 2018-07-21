@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
				</li>
				<li class="breadcrumb-item active">
					Asistir colaborador
				</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-header">
				<h3>
					Asistir cotización <small>seleccionar colaborador</small>
				</h3>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Colaborador</th>
						<th>Dni</th>
						<th>Correo corporativo</th>
						<th>Celular corporativo</th>
					</thead>
					<tbody>
						@foreach($colaborador as $col)
						<tr>
							<td>{{ $col->nombreCola }} {{ $col->apePaterCola }} {{ $col->apeMaterCola }}</td>
							<td>{{ $col->dniCola }}</td>
							<td>{{ $col->correoCorpoCola }}</td>
							<td>{{ $col->celuCorpoCola }}</td>
							<td>
								<a href="{{URL::action('CotizacionController@find_by_cola',$col->codiCola)}}"><button class="btn btn-warning btn-sm">Cotizaciones</button></a>
							</td>
						</tr>
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