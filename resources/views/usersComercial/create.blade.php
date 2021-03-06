@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Gestión de usuarios comerciales</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'usersComercial','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			{{--campos: 'name', 'username','email', 'password', 'codiCola', 'codiCargo', 'codiArea'--}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_name" required value="{{ old('txt_name') }}" class="form-control" placeholder="nombres completos...">
			</div>
			<div class="form-group">
				<label for="">Usuario</label>
				<input type="text" name="txt_username" required value="{{ old('txt_username') }}" class="form-control" placeholder="usuario...">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="txt_email" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="text" name="txt_password" class="form-control">
			</div>
			<div class="form-group">
				<label for="">DNI</label>
				<input type="text" name="txt_codiCola" class="form-control" placeholder="dni...">
			</div>
			<div class="form-group">
				<label for="">Cargo</label>
				<select name="txt_codiCargo" class="form-control">
					@foreach($cargos as $cargo)
						<option value="{{$cargo->codiCargo}}">{{$cargo->nombreCargo}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Area</label>
				<select name="txt_codiArea" class="form-control">
					@foreach($areas as $area)
						<option value="{{$area->codiArea}}">{{$area->nombreArea}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection