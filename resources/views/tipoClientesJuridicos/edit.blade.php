@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar tipo de cliente: {{$tipoClientesJuridicos->descTipoCliJur}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($tipoClientesJuridicos,['method'=>'PATCH','route'=>['clientes.update',$tipoClientesJuridicos->codiTipoCliJur]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Descripción</label>
				<input type="text" name="txtDescripcion" class="form-control" value="{{$tipoClientesJuridicos->descTipoCliJur}}">				
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection