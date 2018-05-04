@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva marca</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif

			{!!Form::open(array('url'=>'marcaProducto','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!} <!-- importante: 'files'='true', para poder trabajar con archivos. fuente= https://www.youtube.com/watch?v=UbVaRnx8nEI&list=PLZPrWDz1MolrxS1uw-u7PrnK66DCFmhDR&index=13 min 3 -->
			{{Form::token()}}
			<div class="form-group">
				<label for="">Marca</label>
				<input type="text" name="txt_nombreMarca" required value="{{ old('txt_nombreMarca') }}" class="form-control" placeholder="marca...">
			</div>
			<div class="form-group">
				<label for="">Nombre breve</label>
				<input type="text" name="txt_nombreBreveMarca" required value="{{ old('txt_nombreBreveMarca') }}" class="form-control" placeholder="nombre breve...">
			</div>
			<div class="form-group">
				<label for="">Imagen</label>
				<input type="file" name="txt_imagenMarca">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection