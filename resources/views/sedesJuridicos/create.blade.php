@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Sede</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'sedesJuridicos','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Descripción</label>
				<input type="text" name="txt_descSedeJur" class="form-control" placeholder="Descripción...">
			</div>
			<div class="form-group">
				<label for="">Cliente</label>
				<select name="txt_codiClienJuri" class="form-control">
					@foreach($clientesJuridico as $clientes)
						<option value="{{$clientes->codiClienJuri}}">{{$clientes->razonSocialClienJ}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection