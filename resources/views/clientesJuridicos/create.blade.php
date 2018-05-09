@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo cliente jurídico</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'clientesJuridicos','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			
				<div class="form-group">
					<label for="">Razon Social</label>
					<input type="text" name="txt_razonSocial" class="form-control" placeholder="Razon social..." value="{{old('txt_razonSocial')}}">
				</div>
				<div class="form-group">
					<label for="">Ruc</label>
					<input type="text" name="txt_ruc" class="form-control" placeholder="Ruc..." value="{{old('txt_ruc')}}">
				</div>
				<div class="form-group">
					<label for="">Dirección</label>
					<input type="text" name="txt_direccion" class="form-control" placeholder="Dirección..." value="{{old('txt_direccion')}}">
				</div>
				<div class="form-group">
					<label for="">Distrito</label>
					<input type="text" name="txt_codiDistri" class="form-control" placeholder="Distrito..." value="{{old('txt_codiDistri')}}">
				</div>
				<div class="form-group">
					<label for="">Provincia</label>
					<input type="text" name="txt_codiProvin" class="form-control" placeholder="Provincia..." value="{{old('txt_codiProvin')}}">
				</div>
				<div class="form-group">
					<label for="">Departamento</label>
					<input type="text" name="txt_codiDepar" class="form-control" placeholder="Departamento..." value="{{old('txt_codiDepar')}}">
				</div>
				<div class="form-group">
					<label for="">Tipo Cliente</label>
					<select name="idTipocli" class="form-control">
						@foreach($tipoClientesJuridicos as $tipos)
						<option value="{{$tipos->codiTipoCliJur}}">{{$tipos->descTipoCliJur}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Web</label>
					<input type="text" name="txt_web" class="form-control" placeholder="Web..." value="{{old('txt_web')}}">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection