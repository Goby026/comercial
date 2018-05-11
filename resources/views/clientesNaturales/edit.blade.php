@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{$ClientesNaturales->nombreClienNatu}} {{ $ClientesNaturales->nombreClienNatu }}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($ClientesNaturales,['method'=>'PATCH','route'=>['clientesNaturales.update',$ClientesNaturales->codiClienNatu]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreClienNatu" class="form-control" value="{{ $ClientesNaturales->nombreClienNatu }}">
			</div>
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterClienN" class="form-control" value="{{ $ClientesNaturales->apePaterClienN }}">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterClienN" class="form-control" value="{{ $ClientesNaturales->apeMaterClienN }}">
			</div>
			<div class="form-group">
				<label for="">Dni</label>
				<input type="text" name="txt_dniClienNatu" class="form-control" value="{{ $ClientesNaturales->dniClienNatu }}">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcClienNatu" class="form-control" value="{{ $ClientesNaturales->direcClienNatu }}">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" class="form-control" value="{{ $ClientesNaturales->codiDistri }}">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" class="form-control" value="{{ $ClientesNaturales->codiProvin }}">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" class="form-control" value="{{ $ClientesNaturales->codiDepar }}">
			</div>
			<div class="form-group">
				<label for="">Fecha de Nacimiento</label>
				<input type="date" name="txt_fechaNaciClienN" class="form-control" value="{{ $ClientesNaturales->fechaNaciClienN }}">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="txt_correoClienNatu" class="form-control" value="{{ $ClientesNaturales->correoClienNatu }}">
			</div>
			<div class="form-group">
				<label for="">Teléfono 01</label>
				<input type="text" name="txt_tele01ClienNatu" class="form-control" value="{{ $ClientesNaturales->tele01ClienNatu }}">
			</div>
			<div class="form-group">
				<label for="">Teléfono 02</label>
				<input type="text" name="txt_tele02ClienNatu" class="form-control" value="{{ $ClientesNaturales->tele02ClienNatu }}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection