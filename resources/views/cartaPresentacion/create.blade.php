@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-12">
			<h3>CONFIGURAR CARTA DE PRESENTACION</h3>
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

			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">BANNER</h3>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
			  		<center><img src="{{asset('imagenes/Banner-comercial/SinFondo1.png')}}" class="img" style= " width: 80%; border-style: dotted;"></center>
			  	</div>
			    
			  	<button type="button" class="btn btn-warning pull-right">Modificar</button>
			  </div>
			</div>

			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">CABECERA</h3>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
			  		<center>
			  		<textarea class="form-control" rows="12" style="width: 99%">
						El motivo de la presente, es para hacerle llegar un cordial saludo y, a la vez, presentarle nuestra empresa PERU DATA CONSULT E.I.R.L con mas de 10 años de experiencia, dedicados a la distribución e implementación de equipos y servicios informáticos, ofreciendo las mejores marcas del mercado.
						Nuestro objetivo es brindar las mejores soluciones en Tecnologías de la Información. Estamos convencidos de la competitividad de nuestros precios, ademas contamos con el mejor equipo de profesionales capacitados que le brindarán el soporte, orientación y asesoría técnica sobre los productos de nuestro portafolio.
						Asimismo, trabajamos desde el año 2012 con los catálogos electrónicos de CONVENIO MARCO, ahora PERÚ COMPRAS, como adjudicatarios en los siguientes catálogos:
					</textarea>
					</center>
			  	</div>
			  </div>
			</div>

			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">CATALOGO</h3>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
			  		<center>
			  		<textarea class="form-control" name="txt_" rows="1" style="width: 99%">
						<p>Computadoras portátiles, proyectores y scanner.</p>
						<p>Útiles de escritorio y oficina.</p>
						<p>Impresoras y suministros.</p>
					</textarea>
					</center>
			  	</div>
			  </div>
			</div>
				
			<div class="form-group">
				<p>ADEMAS, OFRECEMOS LOS SIGUIENTES PRODUCTOS Y SERVICIOS:</p>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-danger">
						  <div class="panel-heading">
						    <h3 class="panel-title">Productos</h3>
						  </div>
						  <div class="panel-body">
						  	<div class="row">
						  		@foreach ($prodCartas as $prodCarta)
								<input type="text" name="" class="form-control" value="{{ $prodCarta->descripcion }}" disabled>
								@endforeach
						  	</div>						  	
						  </div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-danger">
						  <div class="panel-heading">
						    <h3 class="panel-title">Servicios</h3>
						  </div>
						  <div class="panel-body">
						  	<div class="row">
						  		@foreach ($servCartas as $servCarta)
								<input type="text" name="" class="form-control" value="{{ $servCarta->descripcion }}" disabled>
								@endforeach
						  	</div>
						  </div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title">CIERRE DE DOCUMENTO</h3>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
			  		<center>
			  		<textarea class="form-control" rows="3" style="width: 99%">
						Nuestra filosofía de mejora contínua y responsabilidad social, nos han permitido ampliar nuestra cobertura, razón por la cual sería un privilegio para nosotros poder formar parte de su lista de proveedores. Para cotizaciones o información adicional que requieran, ponemos a su disposición a nuestros representantes.
					</textarea>
					</center>
			  	</div>
			  </div>
			</div>

			<div class="form-group">
				<button class="btn btn-warning" type="button">Vista previa</button>
				<button class="btn btn-primary pull-right" type="submit">Guardar</button>
				<button class="btn btn-danger pull-right" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>

	<script>
		var editor_config = {
			selector:'textarea',
			height:200,
			theme: 'modern',
			menubar: true,
			plugins: ['print preview wordcount emoticons'],
			toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect",
		}

		tinymce.init(editor_config);
	</script>
@endsection