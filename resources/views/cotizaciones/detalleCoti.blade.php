@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Seleccionar colaborador
			</li>
		</ol>
	</nav>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACIONES DE<small> {{ $colaborador->nombreCola }} {{ $colaborador->apePaterCola }} {{ $colaborador->apeMaterCola }}</small>
				</h1>
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
									Cliente
								</th>
								<th>
									Producto
								</th>
								<th>
									Total
								</th>
								<th>
									Estado
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
									{{ date('d-m-Y') }}
								</td>
								<td>
									Cliente {{$i+1}}
								</td>
								<td>
									Laptop DELL i3 74898 2.9
								</td>
								<td>									
									21000
								</td>
								<td>
									Activo
								</td>
								<td>
									<a href="">Ver Cotización</a>									
								</td>
								<td>
									
								</td>
							</tr>
							@endfor						
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-info">
					  <div class="panel-heading">
					    <h3 class="panel-title">Métrica de cotizaciones</h3>
					  </div>
					  <div class="panel-body">
					  	<table style="width: 100%;">
					  		<tr>
					  			<td>Tiempo promedio de cotizaciones</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  		<tr>
					  			<td>Promedio cotizaciones al día</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  		<tr>
					  			<td>Total cotizaciones cerradas</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  		<tr>
					  			<td>Total cotizaciones canceladas</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  		<tr>
					  			<td>Total cotizaciones asistidas</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  	</table>
					  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
					  <div class="panel-heading">
					    <h3 class="panel-title">Métrica de alcance</h3>
					  </div>
					  <div class="panel-body">
					    <table style="width: 100%;">
					  		<tr>
					  			<td>Total páginas impresas</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>
					  		<tr>
					  			<td>Total correos enviados</td>
					  			<td><input type="" name="" class="form-control"></td>
					  		</tr>					  		
					  	</table>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection