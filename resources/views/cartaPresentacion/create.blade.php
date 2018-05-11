@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Configuración de carta de presentación</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'cartaPresentacion','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Cabecera</label>
				<textarea class="form-control" rows="12">
					El motivo de la presente, es para hacerle llegar un cordial saludo y, a la vez, presentarle nuestra empresa PERU DATA CONSULT E.I.R.L con mas de 10 años de experiencia, dedicados a la distribución e implementación de equipos y servicios informáticos, ofreciendo las mejores marcas del mercado.
					Nuestro objetivo es brindar las mejores soluciones en Tecnologías de la Información. Estamos convencidos de la competitividad de nuestros precios, ademas contamos con el mejor equipo de profesionales capacitados que le brindarán el soporte, orientación y asesoría técnica sobre los productos de nuestro portafolio.
					Asimismo, trabajamos desde el año 2012 con los catálogos electrónicos de CONVENIO MARCO, ahora PERÚ COMPRAS, como adjudicatarios en los siguientes catálogos:
				</textarea>
			</div>
				
			<div class="form-group">
				<label for="">Catálogo</label>
				<a href="#" onclick="AgregarCampos();"><button class="btn btn-success pull-right">Agregar catálogo</button></a>
				<ul>
					<li>
						<input type="" name="" value="Impresoras y suministros" class="form-control">
					</li>
					<li>
						<input type="" name="" value="Computadoras, portátiles, proyectores y scanner" class="form-control">
					</li>
					<li>
						<input type="" name="" value="Útiles de escritorio y oficina" class="form-control">
					</li>
					<div id="campos"></div>
				</ul>
				<textarea class="form-control" rows="1">Además, ofrecemos los siguientes productos y servicios:</textarea>
			</div>

			<div class="form-group">
				<label for="">Productos y servicios</label>
				<table class="table">
					<thead>
						<th>PRODUCTOS</th>
						<th>SERVICIOS</th>
					</thead>
					<tbody>
						<tr>
							<td>Producto 1</td>
							<td>Servicio 1</td>
						</tr>
						<tr>
							<td>Producto 2</td>
							<td>Servicio 2</td>
						</tr>
						<tr>
							<td>Producto 3</td>
							<td>Servicio 3</td>
						</tr>
						<tr>
							<td>Producto 4</td>
							<td>Servicio 4</td>
						</tr>
						<tr>
							<td>Producto 5</td>
							<td>Servicio 5</td>
						</tr>
						<tr>
							<td>Producto 6</td>
							<td>Servicio 6</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="form-group">
				<textarea class="form-control" rows="6">
					Nuestra filosofía de mejora contínua y responsabilidad social, nos han permitido ampliar nuestra cobertura, razón por la cual sería un privilegio para nosotros poder formar parte de su lista de proveedores. Para cotizaciones o información adicional que requieran, ponemos a su disposición a nuestros representantes.
				</textarea>				
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>

	<script type="text/javascript">
		var nextinput = 0;
		function AgregarCampos(){
			nextinput++;
			campo = '<li id="rut'+nextinput+'"><input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; class="form-control"/></li>';
			$("#campos").append(campo);
		}
	</script>
@endsection