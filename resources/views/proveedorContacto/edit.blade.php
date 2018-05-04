@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Contacto: <small>{{ $proveedorContactos->nombreProveeContac }} {{ $proveedorContactos->apePaterProveeC }} {{ $proveedorContactos->apeMaterProveeC }}</small></h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($proveedorContactos,['method'=>'PATCH','route'=>['proveedorContacto.update',$proveedorContactos->codiProveeContac]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterProveeC" value="{{ $proveedorContactos->apePaterProveeC }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterProveeC" value="{{ $proveedorContactos->apeMaterProveeC }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreProveeContac" value="{{ $proveedorContactos->nombreProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dni</label>
				<input type="text" name="txt_dniProveeContac" value="{{ $proveedorContactos->dniProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cel - 1</label>
				<input type="text" name="txt_celu01ProveeContac" value="{{ $proveedorContactos->celu01ProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cel - 2</label>
				<input type="text" name="txt_celu02ProveeContac" value="{{ $proveedorContactos->celu02ProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Teléfono</label>
				<input type="text" name="txt_tele01ProveeContac" value="{{ $proveedorContactos->tele01ProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Anexo</label>
				<input type="text" name="txt_anexoProveeContac" value="{{ $proveedorContactos->anexoProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Email - 1</label>
				<input type="text" name="txt_correo01ProveeContac" value="{{ $proveedorContactos->correo01ProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Email - 2</label>
				<input type="text" name="txt_correo02ProveeContac" value="{{ $proveedorContactos->correo02ProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Skype</label>
				<input type="text" name="txt_skypeProveeContac" value="{{ $proveedorContactos->skypeProveeContac }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Proveedor</label>
				<select name="txt_codiProveedor" class="form-control">
					@foreach($proveedores as $proveedor)
						@if ($proveedor->codiProveedor==$proveedorContactos->codiProveedor)
						<option value="{{$proveedor->codiProveedor}}" selected>{{$proveedor->nombreProveedor}}</option>
						@else
						<option value="{{$proveedor->codiProveedor}}">{{$proveedor->nombreProveedor}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Marca</label>
				<select name="txt_codiMarca" class="form-control">
					@foreach($marcas as $marca)
						@if ($marca->codiMarca==$proveedorContactos->codiMarca)
						<option value="{{$marca->codiMarca}}" selected>{{$marca->nombreMarca}}</option>
						@else
						<option value="{{$marca->codiMarca}}">{{$marca->nombreMarca}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Cargo</label>
				<select class="form-control" name="txt_codiCargoContac">
					@foreach($cargos as $cargo)
						@if ($cargo->codiCargoContac==$proveedorContactos->codiCargoContac)
						<option value="{{$cargo->codiCargoContac}}" selected>{{$cargo->nombreCargoContac}}</option>
						@else
						<option value="{{$cargo->codiCargoContac}}">{{$cargo->nombreCargoContac}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Detalles</label>
				<textarea name="txt_detalle" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3">
					{{ $proveedorContactos->detalle }}
				</textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection