@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar condición comercial: {{$condicionComercial->descripCondiComer}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($condicionComercial,['method'=>'PATCH','route'=>['condicionesComerciales.update',$condicionComercial->codiCondiComer]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Descripción</label>
				<input type="text" name="txt_descripCondiComer" value="{{ $condicionComercial->descripCondiComer }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Condición por defecto</label>
				<input type="text" name="txt_defecCondiComer" value="{{ $condicionComercial->defecCondiComer }}" class="form-control" >
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection