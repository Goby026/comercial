@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Colaborador</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'colaboradores','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterCola" required value="{{ old('txt_apePaterCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterCola" required value="{{ old('txt_apeMaterCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreCola" required value="{{ old('txt_nombreCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dni</label>
				<input type="number" name="txt_dniCola" required value="{{ old('txt_dniCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha de Nacimiento</label>
				<input type="date" name="txt_fechaNaciCola" required class="form-control">
			</div>
			<div class="form-group">
				<label for="">Correo Corporativo</label>
				<input type="email" name="txt_correoCorpoCola" required value="{{ old('txt_correoCorpoCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Correo Personal</label>
				<input type="email" name="txt_correoPersoCola" value="{{ old('txt_correoPersoCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Celular Corporativo</label>
				<input type="number" name="txt_celuCorpoCola" required value="{{ old('txt_celuCorpoCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Celular Personal</label>
				<input type="number" name="txt_celuPersoCola" required value="{{ old('txt_celuPersoCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" required value="{{ old('txt_codiDepar') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" required value="{{ old('txt_codiProvin') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" required value="{{ old('txt_codiDistri') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcCola" required value="{{ old('txt_direcCola') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Imagen</label>
				<input type="file" name="txt_fotoCola" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha Registro</label>
				<input type="date" name="txt_fechaRegisCola" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Contraseña</label>
				<input type="password" name="txt_contraCola" required value="{{ old('txt_contraCola') }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection