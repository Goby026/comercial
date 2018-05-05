@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Colaborador: {{$colaborador->nombreCola}} {{$colaborador->apePaterCola}} {{$colaborador->apeMaterCola}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($colaborador,['method'=>'PATCH','route'=>['colaboradores.update',$colaborador->codiCola]])!!}
			{{Form::token()}}
			
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterCola" value="{{ $colaborador->apePaterCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterCola" value="{{ $colaborador->apeMaterCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreCola" value="{{ $colaborador->nombreCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dni</label>
				<input type="number" name="txt_dniCola" value="{{ $colaborador->dniCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha de Nacimiento</label>
				<input type="date" name="txt_fechaNaciCola" value="{{ $colaborador->fechaNaciCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Correo Corporativo</label>
				<input type="email" name="txt_correoCorpoCola" value="{{ $colaborador->correoCorpoCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Correo Personal</label>
				<input type="email" name="txt_correoPersoCola" value="{{ $colaborador->correoPersoCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Celular Corporativo</label>
				<input type="number" name="txt_celuCorpoCola" value="{{ $colaborador->celuCorpoCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Celular Personal</label>
				<input type="number" name="txt_celuPersoCola" value="{{ $colaborador->celuPersoCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" value="{{ $colaborador->codiDepar }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" value="{{ $colaborador->codiProvin }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" value="{{ $colaborador->codiDistri }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcCola" value="{{ $colaborador->direcCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Imagen</label>
				<input type="file" name="txt_fotoCola" value="{{ $colaborador->fotoCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha Registro</label>
				<input type="date" name="txt_fechaRegisCola" value="{{ $colaborador->fechaRegisCola }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Contraseña</label>
				<input type="password" name="txt_contraCola" value="{{ $colaborador->contraCola }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection