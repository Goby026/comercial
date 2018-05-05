@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sede: {{$SedeJuridico->descSedeJur}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($SedeJuridico,['method'=>'PATCH','route'=>['sedesJuridicos.update',$SedeJuridico->codiSedeJur]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" name="txt_descSedeJur" class="form-control" value="{{$SedeJuridico->descSedeJur}}">
			</div>
			<div class="form-group">
				<label for="">Cliente</label>
				<select name="txt_codiClienJuri" class="form-control">
					@foreach($clientesJuridico as $clientes)
						@if ($clientes->codiClienJuri==$SedeJuridico->codiClienJuri)
						<option value="{{$clientes->codiClienJuri}}" selected>{{$clientes->razonSocialClienJ}}</option>
						@else
						<option value="{{$clientes->codiClienJuri}}">{{$clientes->razonSocialClienJ}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection