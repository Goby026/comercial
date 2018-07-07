@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Seleccionar colaborador
			</li>
		</ol>
	</nav>
</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar tipo de cliente: {{$tipoCliente->nombreTipoCliente}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($tipoCliente,['method'=>'PATCH','route'=>['clientes.update',$tipoCliente->codiTipoCliente]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txtNombre" class="form-control" value="{{$tipoCliente->nombreTipoCliente}}">				
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txtNombreBreve" class="form-control" value="{{$tipoCliente->nombreBreveTipoCliente}}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection