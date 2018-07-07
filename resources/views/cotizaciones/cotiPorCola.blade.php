@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Mis cotizaciones
			</li>
		</ol>
	</nav>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES DE<small>Busquedas</small><a href="" data-target="#modal-inicio" data-toggle="modal"><button id="btn_iniciar_cotizacion" type="submit" class="btn btn-primary pull-right">+ Nueva cotización</button></a>
				</h1>
			</div>
			<div class="row">
				<div class="col-md-4">
					<a href="cotizaciones/search"><button class="btn btn-success">Busqueda</button></a>
				</div>
				<div class="col-md-4">
					<div class="checkbox pull-right">
						<label>
							<button type="button" class="btn btn-default">Ver cotizaciones asistidas</button>
						</label>
					</div>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>
									Fecha
								</th>
								<th>
									Asunto
								</th>
								<th>
									Estado
								</th>
							</tr>
						</thead>
						<tbody>/
							@foreach($cotis_cola as $coti)
							<tr class="active">
								<td>
									{{ $coti->fechaCoti }}
								</td>
								<td>
									{{ $coti->asuntoCoti }}
								</td>
								<td>
									{{ $coti->nombreCotiEsta }}
								</td>
								<td>
									@if( $coti->nombreCotiEsta == 'En construccion' )
									<a href="{{ URL::action('CotizacionController@continuar',$coti->codiCoti) }}"><button class="btn btn-info btn-xs">Asistir</button></a>
									@else
									<a href=""><button class="btn btn-success btn-xs">Reutilizar</button></a>
									@endif
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection