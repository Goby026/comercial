@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar usuario: {{$user->name}} - {{ $user->codiCola }}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($user,['method'=>'PATCH','route'=>['usersComercial.update',$user->id]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombres y apellidos completos</label>
				<input type="text" name="txt_name" required value="{{ $user->name }}" class="form-control"
					   placeholder="nombres completos">
			</div>
			<div class="form-group">
				<label for="">Usuario</label>
				<input type="text" name="txt_username" required value="{{ $user->username }}"
					   class="form-control" placeholder="venta...">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="txt_email" class="form-control" value="{{ $user->email }}">
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" name="txt_password" class="form-control" value="{{ $user->password }}">
			</div>
			<div class="form-group">
				<label for="">DNI</label>
				<input type="text" name="txt_codiCola" class="form-control" value="{{ $user->codiCola }}">
			</div>
			<div class="form-group">
				<label for="">Cargo</label>
				<select name="txt_codiCargo" class="form-control">
					@foreach($cargos as $cargo)
						@if($cargo->codiCargo == $user->codiCargo)
							<option value="{{$cargo->codiCargo}}" selected>{{$cargo->nombreCargo}}</option>
						@else
							<option value="{{$cargo->codiCargo}}">{{$cargo->nombreCargo}}</option>
						@endif

					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Area</label>
				<select name="txt_codiArea" class="form-control">
					@foreach($areas as $area)
						@if($area->codiArea == $user->codiArea)
							<option value="{{$area->codiArea}}" selected>{{$area->nombreArea}}</option>
						@else
							<option value="{{$area->codiArea}}">{{$area->nombreArea}}</option>
						@endif

					@endforeach
				</select>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection