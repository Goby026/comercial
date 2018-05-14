@extends ('layouts.admin')
@section ('contenido')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES <small>Busquedas</small><a href="nuevaCotizacion"><button class="btn btn-info pull-right">+Nueva cotización</button></a>
				</h1>
			</div>
			<div class="row">
				<div class="col-md-4">
					<a href="cotizaciones/create"><button class="btn btn-success">Busqueda</button></a>					
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
							@for ($i = 0; $i < 10; $i++)
							<tr class="active">
								<td>
									1
								</td>
								<td>
									TB - Monthly
								</td>
								<td>
									Laptop DELL i3 74898 2.9
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
							@endfor						
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection