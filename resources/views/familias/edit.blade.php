@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Familia</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($familia,['method'=>'PATCH','route'=>['familias.update',$familia->codiFamilia]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre Familia</label>
				<input type="text" name="txt_nombreFamilia" required class="form-control" value="{{ $igv->codiCola }}">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveFamilia" required class="form-control" value="{{ $igv->valorIgv }}">
			</div>			

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection