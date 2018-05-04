@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{$ClientesJuridicos->razonSocialClienJ}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				</ul>
				@endforeach
			</div>
			@endif
			
			{!!Form::model($ClientesJuridicos,['method'=>'PATCH','route'=>['clientesJuridicos.update',$ClientesJuridicos->codiClienJuri]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Razon Social</label>
				<input type="text" name="txt_razonSocial" class="form-control" value="{{$ClientesJuridicos->razonSocialClienJ}}">
			</div>
			<div class="form-group">
				<label for="">Ruc</label>
				<input type="text" name="txt_ruc" class="form-control" value="{{$ClientesJuridicos->rucClienJuri}}">
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" name="txt_direccion" class="form-control" value="{{$ClientesJuridicos->direcClienJuri}}">
			</div>
			<div class="form-group">
				<label for="">Distrito</label>
				<input type="text" name="txt_codiDistri" class="form-control" value="{{$ClientesJuridicos->codiDistri}}">
			</div>
			<div class="form-group">
				<label for="">Provincia</label>
				<input type="text" name="txt_codiProvin" class="form-control" value="{{$ClientesJuridicos->codiProvin}}">
			</div>
			<div class="form-group">
				<label for="">Departamento</label>
				<input type="text" name="txt_codiDepar" class="form-control" value="{{$ClientesJuridicos->codiDepar}}">
			</div>
			<div class="form-group">
				<label for="">Tipo Cliente</label>
				<select name="idTipocli" class="form-control">
					@foreach($tipoClientesJuridicos as $tipos)
						@if ($tipos->codiTipoCliJur==$ClientesJuridicos->codiTipoCliJur)
						<option value="{{$tipos->codiTipoCliJur}}" selected>{{$tipos->descTipoCliJur}}</option>
						@else
						<option value="{{$tipos->codiTipoCliJur}}">{{$tipos->descTipoCliJur}}</option>
						@endif
					@endforeach
				</select>
			</div>			
			<div class="form-group">
				<label for="">Web</label>
				<input type="text" name="txt_web" class="form-control" value="{{$ClientesJuridicos->webClienJuri}}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection