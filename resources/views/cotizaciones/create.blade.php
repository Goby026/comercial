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

			<style type="text/css">
				.checkbox {
				  padding-left: 20px; }
				  .checkbox label {
				    display: inline-block;
				    position: relative;
				    padding-left: 5px; }
				    .checkbox label::before {
				      content: "";
				      display: inline-block;
				      position: absolute;
				      width: 17px;
				      height: 17px;
				      left: 0;
				      margin-left: -20px;
				      border: 1px solid #cccccc;
				      border-radius: 3px;
				      background-color: #fff;
				      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
				      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
				      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
				    .checkbox label::after {
				      display: inline-block;
				      position: absolute;
				      width: 16px;
				      height: 16px;
				      left: 0;
				      top: 0;
				      margin-left: -20px;
				      padding-left: 3px;
				      padding-top: 1px;
				      font-size: 11px;
				      color: #555555; }
				  .checkbox input[type="checkbox"] {
				    opacity: 0; }
				    .checkbox input[type="checkbox"]:focus + label::before {
				      outline: thin dotted;
				      outline: 5px auto -webkit-focus-ring-color;
				      outline-offset: -2px; }
				    .checkbox input[type="checkbox"]:checked + label::after {
				      font-family: 'FontAwesome';
				      content: "\f00c"; }
				    .checkbox input[type="checkbox"]:disabled + label {
				      opacity: 0.65; }
				      .checkbox input[type="checkbox"]:disabled + label::before {
				        background-color: #eeeeee;
				        cursor: not-allowed; }
				  .checkbox.checkbox-circle label::before {
				    border-radius: 50%; }
				  .checkbox.checkbox-inline {
				    margin-top: 0; }

				.checkbox-primary input[type="checkbox"]:checked + label::before {
				  background-color: #428bca;
				  border-color: #428bca; }
				.checkbox-primary input[type="checkbox"]:checked + label::after {
				  color: #fff; }

				.checkbox-danger input[type="checkbox"]:checked + label::before {
				  background-color: #d9534f;
				  border-color: #d9534f; }
				.checkbox-danger input[type="checkbox"]:checked + label::after {
				  color: #fff; }

				.checkbox-info input[type="checkbox"]:checked + label::before {
				  background-color: #5bc0de;
				  border-color: #5bc0de; }
				.checkbox-info input[type="checkbox"]:checked + label::after {
				  color: #fff; }

				.checkbox-warning input[type="checkbox"]:checked + label::before {
				  background-color: #f0ad4e;
				  border-color: #f0ad4e; }
				.checkbox-warning input[type="checkbox"]:checked + label::after {
				  color: #fff; }

				.checkbox-success input[type="checkbox"]:checked + label::before {
				  background-color: #5cb85c;
				  border-color: #5cb85c; }
				.checkbox-success input[type="checkbox"]:checked + label::after {
				  color: #fff; }

				.radio {
				  padding-left: 20px; }
				  .radio label {
				    display: inline-block;
				    position: relative;
				    padding-left: 5px; }
				    .radio label::before {
				      content: "";
				      display: inline-block;
				      position: absolute;
				      width: 17px;
				      height: 17px;
				      left: 0;
				      margin-left: -20px;
				      border: 1px solid #cccccc;
				      border-radius: 50%;
				      background-color: #fff;
				      -webkit-transition: border 0.15s ease-in-out;
				      -o-transition: border 0.15s ease-in-out;
				      transition: border 0.15s ease-in-out; }
				    .radio label::after {
				      display: inline-block;
				      position: absolute;
				      content: " ";
				      width: 11px;
				      height: 11px;
				      left: 3px;
				      top: 3px;
				      margin-left: -20px;
				      border-radius: 50%;
				      background-color: #555555;
				      -webkit-transform: scale(0, 0);
				      -ms-transform: scale(0, 0);
				      -o-transform: scale(0, 0);
				      transform: scale(0, 0);
				      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
				      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
				      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
				      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
				  .radio input[type="radio"] {
				    opacity: 0; }
				    .radio input[type="radio"]:focus + label::before {
				      outline: thin dotted;
				      outline: 5px auto -webkit-focus-ring-color;
				      outline-offset: -2px; }
				    .radio input[type="radio"]:checked + label::after {
				      -webkit-transform: scale(1, 1);
				      -ms-transform: scale(1, 1);
				      -o-transform: scale(1, 1);
				      transform: scale(1, 1); }
				    .radio input[type="radio"]:disabled + label {
				      opacity: 0.65; }
				      .radio input[type="radio"]:disabled + label::before {
				        cursor: not-allowed; }
				  .radio.radio-inline {
				    margin-top: 0; }

				.radio-primary input[type="radio"] + label::after {
				  background-color: #428bca; }
				.radio-primary input[type="radio"]:checked + label::before {
				  border-color: #428bca; }
				.radio-primary input[type="radio"]:checked + label::after {
				  background-color: #428bca; }

				.radio-danger input[type="radio"] + label::after {
				  background-color: #d9534f; }
				.radio-danger input[type="radio"]:checked + label::before {
				  border-color: #d9534f; }
				.radio-danger input[type="radio"]:checked + label::after {
				  background-color: #d9534f; }

				.radio-info input[type="radio"] + label::after {
				  background-color: #5bc0de; }
				.radio-info input[type="radio"]:checked + label::before {
				  border-color: #5bc0de; }
				.radio-info input[type="radio"]:checked + label::after {
				  background-color: #5bc0de; }

				.radio-warning input[type="radio"] + label::after {
				  background-color: #f0ad4e; }
				.radio-warning input[type="radio"]:checked + label::before {
				  border-color: #f0ad4e; }
				.radio-warning input[type="radio"]:checked + label::after {
				  background-color: #f0ad4e; }

				.radio-success input[type="radio"] + label::after {
				  background-color: #5cb85c; }
				.radio-success input[type="radio"]:checked + label::before {
				  border-color: #5cb85c; }
				.radio-success input[type="radio"]:checked + label::after {
				  background-color: #5cb85c; }
			</style>

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