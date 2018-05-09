@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Producto</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'productosProveedor','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Marca</label>
				<select class="form-control" name="txt_codiMarca">
					@foreach($marcas as $marca)
					<option value="{{ $marca->codiMarca }}">{{ $marca->nombreMarca }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Producto</label>
				<input type="text" name="txt_nombreProducProveedor" required value="{{ old('txt_nombreProducProveedor') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveProducP" required value="{{ old('txt_nombreBreveProducP') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Código de Marca</label>
				<input type="text" name="txt_codiProducMarca" required value="{{ old('txt_codiProducMarca') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Código Interno</label>
				<input type="text" name="txt_codInterno" required value="{{ old('txt_codInterno') }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Descripción</label>
				<textarea name="txt_decripProduc" class="form-control rounded-0" id="txt_decripProduc" rows="3"></textarea>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection