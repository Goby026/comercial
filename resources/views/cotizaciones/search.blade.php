@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			

			{!!Form::open(array('url'=>'cotizaciones','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<fieldset>
			<legend>Parámetros de busqueda</legend>

				<div class="checkbox checkbox-success">
					<input id="checkbox1" type="checkbox">
					<label for="checkbox1">
						Producto
					</label>
					<input type="text" name="txtProducto" class="form-control" disabled placeholder="producto..." value="{{old('txtProducto')}}">
				</div>
				<div class="checkbox checkbox-success">
					<input id="checkbox2" type="checkbox">
					<label for="checkbox2">
						N° Cotización
					</label>
					<input type="text" name="txtCoti" class="form-control" disabled placeholder="cotización..." value="{{old('txtCoti')}}">
				</div>

				<div class="checkbox checkbox-success">
					<input id="checkbox3" type="checkbox">
					<label for="checkbox3">
						Asunto
					</label>
					<input type="text" name="txtCoti" class="form-control" disabled placeholder="asunto..." value="{{old('txtCoti')}}">
				</div>

				<div class="checkbox checkbox-success">
					<input id="checkbox4" type="checkbox">
					<label for="checkbox4">
						Cliente
					</label>
					<input type="text" name="txtCoti" class="form-control" disabled placeholder="cliente..." value="{{old('txtCoti')}}">
				</div>

				<div class="checkbox checkbox-success">
					<input id="checkbox5" type="checkbox">
					<label for="checkbox5">
						Fechas
					</label>
					<p>
						Desde<input type="date" name="txtFechaInicio" disabled class="form-control">
				  		Hasta<input type="date" name="txtFechaFinal" disabled class="form-control">
					</p>
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit" >Iniciar busqueda</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>

			</fieldset>

			{!!Form::close()!!}
		</div>
	</div>
@endsection