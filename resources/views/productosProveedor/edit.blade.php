@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{$productosProv->nombreProducProveedor}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($productosProv,['method'=>'PATCH','route'=>['productosProveedor.update',$productosProv->codiProducProveedor]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Marca</label>
				<select name="txt_codiMarca" class="form-control">
					@foreach($marcas as $marca)
						@if ($marca->codiMarca==$productosProv->codiMarca)
						<option value="{{$marca->codiMarca}}" selected>{{$marca->nombreMarca}}</option>
						@else
						<option value="{{$marca->codiMarca}}">{{$marca->nombreMarca}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Producto</label>
				<input type="text" name="txt_nombreProducProveedor" required value="{{ $productosProv->nombreProducProveedor }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveProducP" required value="{{ $productosProv->nombreBreveProducP }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Código de Marca</label>
				<input type="text" name="txt_codiProducMarca" required value="{{ $productosProv->codiProducMarca }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Código Interno</label>
				<input type="text" name="txt_codInterno" required value="{{ $productosProv->codInterno }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Descripción</label>
				<textarea name="txt_decripProduc" class="form-control rounded-0" id="txt_decripProduc" rows="3">
					{{$productosProv->descripProduc}}
				</textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection