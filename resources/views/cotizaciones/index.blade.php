@extends ('layouts.admin')
@section ('contenido')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10">				
				<div class="page-header">
					<h1>
						COTIZACIONES <small>Nuevo</small>
					</h1>
				</div>
			</div>
			<div class="col-md-2">
				<button class="btn btn-primary" style="width:100%;">Iniciar cotización</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							Asunto:<input type="text" name="txt_asunto" class="form-control" value="{{ old('txt_asunto') }}">
						</div>
					</div>
					<div class="col-md-2">
						Atención:<input type="text" name="txt_atencion" class="form-control" value="{{ old('txt_atencion') }}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							Cliente:
							<select name="txt_cliente" class="form-control selectpicker" data-live-search="true">
								@foreach($clientes as $cliente)
								<option value="{{ $cliente->codiClienJuri }}">{{ $cliente->razonSocialClienJ }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<br>
						<button class="btn btn-success" style="width: 100%;">Nuevo Cliente</button>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">					
					</div>
					<div class="col-md-2">
						<a href="modalBuscarProducto"><button class="btn btn-info pull-right" style="width: 100%;">Agregar Producto</button></a>
					</div>
				</div><br>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									Producto
									<input type="text" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									Cantidad
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $ SIN
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. $
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">									
							</div>
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
								<div class="form-group">
									C. U. S/.
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									TOTAL
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
								<div class="form-group">
									MARGEN C.U. S/.
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									P. U. S/.
									<input type="number" name="txt_cantiCoti" class="form-control">
								</div>
							</div>
						</div>						
						<div class="form-group">
							<a href=""><button class="btn btn-info pull-right">Guardar</button></a>
							<a href=""><button class="btn btn-danger pull-right">Eliminar</button></a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>TOTAL</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>UTILIDAD</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>MARGEN</label>
					<input type="text" name="txt_cantiCoti" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-2">
			</div>
			<div class="col-md-2">
				<button class="btn btn-warning pull-right" style="width: 100%;">GUARDAR PRE-COTIZACION</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">VER CARTA DE PRESENTACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-default pull-right" style="width: 100%;">VER COTIZACION</button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success pull-right" style="width: 100%;">GUARDAR COTIZACION</button>
			</div>
		</div>
	</div>
@endsection