@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Estado de costeo</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($costeoEstado,['method'=>'PATCH','route'=>['costeoEstados.update',$costeoEstado->codiCosteoEsta]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Estado</label>
				<input type="text" name="txt_nombreCosteoEsta" value="{{ $costeoEstado->nombreCosteoEsta }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre breve</label>
				<input type="text" name="txt_nombreBreveCosteoEsta" value="{{ $costeoEstado->nombreBreveCosteoEsta }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Orden</label>
				<input type="number" name="txt_ordenCosteoEsta" value="{{ $costeoEstado->ordenCosteoEsta }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection