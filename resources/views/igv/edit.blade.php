@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Igv</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($igv,['method'=>'PATCH','route'=>['igv.update',$igv->codiIgv]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Creado por</label>
				<input type="text" name="txt_codiCola" required class="form-control" value="{{ $igv->codiCola }}">
			</div>
			<div class="form-group">
				<label for="">Valor Igv</label>
				<input type="text" name="txt_valorIgv" required class="form-control" value="{{ $igv->valorIgv }}">
			</div>
			<div class="form-group">
				<label for="">Fecha de registro</label>
				<input type="text" name="txt_fechaInIgv" required class="form-control" value="{{ $igv->fechaInIgv }}">
			</div>
			<div class="form-group">
				<label for="">Fecha final</label>
				<input type="text" name="txt_fechaFinalIgv" required class="form-control" value="{{ $igv->fechaFinalIgv }}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection