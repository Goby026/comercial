@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo cliente natural</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'clientesNaturales','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			
				<div class="form-group">
					<label for="">Nombres</label>
					<input type="text" name="txt_nombreClienNatu" class="form-control" placeholder="nombre..." value="{{old('txt_nombreClienNatu')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Paterno</label>
					<input type="text" name="txt_apePaterClienN" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterClienN')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Materno</label>
					<input type="text" name="txt_apeMaterClienN" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterClienN')}}">
				</div>
				<div class="form-group">
					<label for="">Dni</label>
					<input type="text" name="txt_dniClienNatu" class="form-control" placeholder="dni..." value="{{old('txt_dniClienNatu')}}">
				</div>
				<div class="form-group">
					<label for="">Dirección</label>
					<input type="text" name="txt_direcClienNatu" class="form-control" placeholder="dirección..." value="{{old('txt_direcClienNatu')}}">
				</div>
				<div class="form-group">
					<label for="">Distrito</label>
					<input type="text" name="txt_codiDistri" class="form-control" placeholder="distrito..." value="{{old('txt_codiDistri')}}">
				</div>
				<div class="form-group">
					<label for="">Provincia</label>
					<input type="text" name="txt_codiProvin" class="form-control" placeholder="provincia..." value="{{old('txt_codiProvin')}}">
				</div>
				<div class="form-group">
					<label for="">Departamento</label>
					<input type="text" name="txt_codiDepar" class="form-control" placeholder="departamento..." value="{{old('txt_codiDepar')}}">
				</div>
				<div class="form-group">
					<label for="">Fecha de Nacimiento</label>
					<input type="date" name="txt_fechaNaciClienN" class="form-control" placeholder="fecha de nacimiento..." value="{{old('txt_fechaNaciClienN')}}">
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="txt_correoClienNatu" class="form-control" placeholder="email..." value="{{old('txt_correoClienNatu')}}">
				</div>
				<div class="form-group">
					<label for="">Teléfono 01</label>
					<input type="text" name="txt_tele01ClienNatu" class="form-control" placeholder="telefono 01..." value="{{old('txt_tele01ClienNatu')}}">
				</div>
				<div class="form-group">
					<label for="">Teléfono 02</label>
					<input type="text" name="txt_tele02ClienNatu" class="form-control" placeholder="telefono 02..." value="{{old('txt_tele02ClienNatu')}}">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection