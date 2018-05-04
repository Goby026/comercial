@extends ('layouts.admin')
@section ('contenido')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">				
				<div class="page-header">
					<h1>
						COTIZACIONES <small>Nuevo</small>
					</h1>
				</div>
			</div>
			<div class="col-md-4">
				<button class="btn btn-success">Iniciar cotización</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					Asunto:<input type="" name="" class="form-control">					
				</div>
				<div class="col-md-4">
					Atención:<input type="" name="" class="form-control">
				</div>
				<div class="col-md-8">Cliente:<input type="" name="" class="form-control"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12"><a href=""><button class="btn btn-info pull-right">Agregar Producto</button></a></div>
				<table class="table">
					<thead>
						<th>#</th>
						<th>Producto</th>
						<th>Cant</th>
						<th>C.U</th>
						<th>Total</th>
					</thead>
					<tbody>
						<td>1</td>
						<td>Productos 1</td>
						<td>1</td>
						<td>10</td>
						<td>100</td>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection