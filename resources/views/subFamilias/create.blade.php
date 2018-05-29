@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Crear Sub Familias</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'subFamilias','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Familia</label>
				<select class="form-control" name="txt_codiFamilia">
					@foreach($familias as $familia)
					<option value="{{ $familia->codiFamilia }}">{{ $familia->nombreFamilia }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Nombre Sub Familia</label>
				<input type="text" name="txt_nombreSubFamilia" required value="{{ old('txt_nombreSubFamilia') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveSubFamilia" required value="{{ old('txt_nombreBreveSubFamilia') }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection