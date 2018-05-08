@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar tipo de carta: {{$tipoCartas->nombreTipoCartaP}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($tipoCartas,['method'=>'PATCH','route'=>['tipoCartaPresen.update',$tipoCartas->codiTipoCartaPresen]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Tipo de Carta</label>
				<input type="text" name="txt_tipoCartaPresen" required value="{{ $tipoCartas->tipoCartaPresen }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_nombreTipoCartaP" required value="{{ $tipoCartas->nombreTipoCartaP }}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveTipoCartaP" value="{{ $tipoCartas->nombreBreveTipoCartaP }}" class="form-control">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection