@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configuración de condiciones comerciales</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>				
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'condicionesComerciales','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Descripción</label>
				<input type="text" name="txt_descripCondiComer" required value="{{ old('txt_descripCondiComer') }}" class="form-control" placeholder="descripción...">
			</div>
			<div class="form-group">
				<label for="">Condición por defecto</label>
				<input type="text" name="txt_defecCondiComer" required value="{{ old('txt_defecCondiComer') }}" class="form-control" placeholder="defecto...">
			</div>
			<div class="form-group">
				<label for="">Orden</label>
				<input type="text" name="txt_orden" required value="{{ old('txt_orden') }}" class="form-control" placeholder="orden...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection