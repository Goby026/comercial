@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Contacto: {{$contactoCliente->nombreContacClien}} {{ $contactoCliente->apePaterContacC }}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($contactoCliente,['method'=>'PATCH','route'=>['contactosCliente.update',$contactoCliente->codiContacClien]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombres</label>
				<input type="text" name="txt_nombreContacClien" class="form-control"  value="{{$contactoCliente->nombreContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Apellido Paterno</label>
				<input type="text" name="txt_apePaterContacC" class="form-control"  value="{{$contactoCliente->apePaterContacC}}">
			</div>
			<div class="form-group">
				<label for="">Apellido Materno</label>
				<input type="text" name="txt_apeMaterContacC" class="form-control"   value="{{$contactoCliente->apeMaterContacC}}">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="txt_correoContacClien" class="form-control"  value="{{$contactoCliente->correoContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direcContacClien" class="form-control"  value="{{$contactoCliente->direcContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" class="form-control"  value="{{$contactoCliente->codiDistri}}">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" class="form-control"  value="{{$contactoCliente->codiProvin}}">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" class="form-control"  value="{{$contactoCliente->codiDepar}}">
			</div>
			<div class="form-group">
				<label for="">Celular 01</label>
				<input type="text" name="txt_celu01ContacClien" class="form-control"  value="{{$contactoCliente->celu01ContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Celular 02</label>
				<input type="text" name="txt_celu02ContacClien" class="form-control"   value="{{$contactoCliente->celu02ContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Teléfono</label>
				<input type="text" name="txt_teleContacClien" class="form-control"  value="{{$contactoCliente->teleContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Anexo</label>
				<input type="text" name="txt_aneContacClien" class="form-control"  value="{{$contactoCliente->aneContacClien}}">
			</div>
			<div class="form-group">
				<label for="">Cliente</label>
				<input type="text" name="txt_codiClienJuri" class="form-control"  value="{{$contactoCliente->codiClienJuri}}">
			</div>
			<div class="form-group">
				<label for="">Colaborador</label>
				<input type="text" name="txt_codiCola" class="form-control"  value="{{$contactoCliente->codiCola}}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection