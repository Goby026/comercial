@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cargo: {{$cargos->nombreCargoContac}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($cargos,['method'=>'PATCH','route'=>['cargoContactos.update',$cargos->codiCargoContac]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreCargoContac" required class="form-control" value="{{ $cargos->nombreCargoContac }}">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveCargoContac" required class="form-control" value="{{ $cargos->nombreBreveCargoContac }}">
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection