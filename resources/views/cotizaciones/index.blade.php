@extends ('layouts.admin')
@section ('contenido')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES <small>Busquedas</small><a href="" data-target="#modal-inicio" data-toggle="modal"><button id="btn_iniciar_cotizacion" type="submit" class="btn btn-primary pull-right">+ Nueva cotización</button></a>
				</h1>
			</div>
			@include('cotizaciones.modalBuscar') <!-- incluimos el archivo del modal -->
			<div class="row">
				<div class="col-md-4">
					<a href="cotizaciones/search"><button class="btn btn-success">Busqueda</button></a>					
				</div>
				<div class="col-md-4">
					<div class="checkbox pull-right">
						<label>
							<input type="checkbox"> Ver cotizaciones asistidas
						</label>
					</div>
				</div>
				<div class="col-md-4">
					<button class="btn btn-warning pull-right">Asistir cotización</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>
									Asunto
								</th>
								<th>
									Cliente
								</th>
								<th>
									Producto
								</th>
								<th>
									Fecha
								</th>
								<th>
									Creado por
								</th>
								<th>
									Estado
								</th>
								<th>
									Total
								</th>
								<th>
									Acción
								</th>
							</tr>
						</thead>
						<tbody>							
							@foreach($cotizaciones as $coti)
							<tr class="active">
								<td>
									{{ $coti->codiCoti }}
								</td>
								
								<td>
									Producto #
								</td>
								<td>
									{{ date('d-m-Y') }}
								</td>
								<td>
									Lucia Vila
								</td>
								<td>
									Finalizado
								</td>
								<td>
									21000
								</td>
								<td>
									<a href=""><button class="btn btn-success btn-xs">Reutilizar</button></a>
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