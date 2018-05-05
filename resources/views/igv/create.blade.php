@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configurar Igv</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif

			{!!Form::open(array('url'=>'igv','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Colaborador</label>
				<select class="form-control" name="txt_codiCola">
					@foreach($colaboradores as $colaborador)
					<option value="{{ $colaborador->codiCola }}">{{ $colaborador->nombreCola }} {{ $colaborador->apePaterCola }} {{ $colaborador->apeMaterCola }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Valor igv</label>
				<input type="text" name="txt_valorIgv" required value="{{ old('txt_valorIgv') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha ingreso</label>
				<input type="date" name="txt_fechaInIgv" required value="{{ old('txt_fechaInIgv') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Fecha final</label>
				<input type="date" name="txt_fechaFinalIgv" required value="{{ old('txt_fechaFinalIgv') }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection