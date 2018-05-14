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
				<button class="btn btn-success pull-right">Iniciar cotización</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-10">
					Asunto:<input type="text" name="txt_asunto" class="form-control" value="{{ old('txt_asunto') }}">
				</div>
				<div class="col-md-2">
					Atención:<input type="text" name="txt_atencion" class="form-control" value="{{ old('txt_atencion') }}">
				</div>
				<div class="col-md-12">Cliente:<input type="text" name="txt_cliente" class="form-control" value="{{ old('txt_cliente') }}"></div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12"><a href="modalBuscarProducto"><button class="btn btn-info pull-right">Agregar Producto</button></a></div>
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