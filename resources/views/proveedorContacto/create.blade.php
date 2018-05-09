@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Contacto de Proveedor</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'proveedorContacto','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterProveeC" required value="{{ old('txt_apePaterProveeC') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterProveeC" required value="{{ old('txt_apeMaterProveeC') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreProveeContac" required value="{{ old('txt_nombreProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dni</label>
				<input type="text" name="txt_dniProveeContac" required value="{{ old('txt_dniProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cel - 1</label>
				<input type="text" name="txt_celu01ProveeContac" required value="{{ old('txt_celu01ProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cel - 2</label>
				<input type="text" name="txt_celu02ProveeContac" required value="{{ old('txt_celu02ProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Teléfono</label>
				<input type="text" name="txt_tele01ProveeContac" required value="{{ old('txt_tele01ProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Anexo</label>
				<input type="text" name="txt_anexoProveeContac" required value="{{ old('txt_anexoProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Email - 1</label>
				<input type="text" name="txt_correo01ProveeContac" required value="{{ old('txt_correo01ProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Email - 2</label>
				<input type="text" name="txt_correo02ProveeContac" required value="{{ old('txt_correo02ProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Skype</label>
				<input type="text" name="txt_skypeProveeContac" required value="{{ old('txt_skypeProveeContac') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Proveedor</label>
				<select class="form-control" name="txt_codiProveedor">
					@foreach($proveedores as $proveedor)
					<option value="{{ $proveedor->codiProveedor }}">{{ $proveedor->nombreProveedor }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Marca</label>
				<select class="form-control" name="txt_codiMarca">
					@foreach($marcas as $marca)
					<option value="{{ $marca->codiMarca }}">{{ $marca->nombreMarca }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Cargo</label>
				<select class="form-control" name="txt_codiCargoContac">
					@foreach($cargos as $cargo)
					<option value="{{ $cargo->codiCargoContac }}">{{ $cargo->nombreCargoContac }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Detalles</label>
				<textarea name="txt_detalle" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection