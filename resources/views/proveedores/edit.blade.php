@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{$proveedores->nombreProveedor}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($proveedores,['method'=>'PATCH','route'=>['proveedores.update',$proveedores->codiProveedor]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreProveedor" required class="form-control" value="{{ $proveedores->nombreProveedor }}">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveProveedor" required class="form-control" value="{{ $proveedores->nombreBreveProveedor }}">
			</div>
			<div class="form-group">
				<label for="">Ruc</label>
				<input type="text" name="txt_RucProveedor" required class="form-control" value="{{ $proveedores->RucProveedor }}">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcProveedor" required class="form-control" value="{{ $proveedores->direcProveedor }}">
			</div>
			<div class="form-group">
				<label for="">Web</label>
				<input type="text" name="txt_webProveedor" required class="form-control" value="{{ $proveedores->webProveedor }}">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" required class="form-control" value="{{ $proveedores->codiDistri }}">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" required class="form-control" value="{{ $proveedores->codiProvin }}">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" required class="form-control" value="{{ $proveedores->codiDepar }}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection