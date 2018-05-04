@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Marca: {{$marcasProductos->nombreMarca}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($marcasProductos,['method'=>'PATCH','route'=>['marcaProducto.update',$marcasProductos->codiMarca],'files'=>'true'])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Marca</label>
				<input type="text" name="txt_nombreMarca" required value="{{ $marcasProductos->nombreMarca }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre breve</label>
				<input type="text" name="txt_nombreBreveMarca" required value="{{ $marcasProductos->nombreBreveMarca }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Imagen</label>
				<input type="file" name="txt_imagenMarca">

				@if(($marcasProductos->imagenMarca)!= "")
					<img src="{{ asset('imagenes/marcas/'.$marcasProductos->imagenMarca) }}" alt="{{ $marcasProductos->nombreBreveMarca }}" style="width: 20%;">
				@endif

			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection