@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo contacto de cliente</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'contactosCliente','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			
				<div class="form-group">
					<label for="">Nombres</label>
					<input type="text" name="txt_nombreContacClien" class="form-control" placeholder="nombre..." value="{{old('txt_nombreContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Paterno</label>
					<input type="text" name="txt_apePaterContacC" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterContacC')}}">
				</div>
				<div class="form-group">
					<label for="">Apellido Materno</label>
					<input type="text" name="txt_apeMaterContacC" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterContacC')}}">
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="txt_correoContacClien" class="form-control" placeholder="email..." value="{{old('txt_correoContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Dirección</label>
					<input type="text" name="txt_direcContacClien" class="form-control" placeholder="dirección..." value="{{old('txt_direcContacClien')}}">
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
					<label for="">Celular 01</label>
					<input type="text" name="txt_celu01ContacClien" class="form-control" placeholder="celular 01..." value="{{old('txt_celu01ContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Celular 02</label>
					<input type="text" name="txt_celu02ContacClien" class="form-control" placeholder="celular 02..." value="{{old('txt_celu02ContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Teléfono</label>
					<input type="text" name="txt_teleContacClien" class="form-control" placeholder="teléfono..." value="{{old('txt_teleContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Anexo</label>
					<input type="text" name="txt_aneContacClien" class="form-control" placeholder="anexo..." value="{{old('txt_aneContacClien')}}">
				</div>
				<div class="form-group">
					<label for="">Cliente</label>
					<input type="text" name="txt_codiClienJuri" class="form-control" placeholder="cliente..." value="{{old('txt_codiClienJuri')}}">
				</div>
				<div class="form-group">
					<label for="">Colaborador</label>
					<input type="text" name="txt_codiCola" class="form-control" placeholder="colaborador..." value="{{old('txt_codiCola')}}">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection