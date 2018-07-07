@extends ('layouts.admin')
@section ('contenido')
<style type="text/css">
	.line{
		background-color: #C4BDBD;
		height: 1px;		
	}

	.foto{
		padding: 0;
	}
</style>
<div class="row">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Cotización por colaborador
			</li>
		</ol>
	</nav>
</div>
<div class="container-fluid">	
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					COTIZACION POR COLABORADOR
				</h1>
			</div>
			<div class="row">
				
			</div>
			
			<div class="row">
				@foreach($colaboradores as $colaborador)
				<div class="col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">COD: {{ $colaborador->codiCola }}</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-5">
								<img alt="Bootstrap Image Preview" src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg" class="img-thumbnail" />
							</div>
							<div class="col-md-7">								
								<span class="form-control" style="width: 100%;">{{ $colaborador->apePaterCola }}</span>
								<span class="form-control" style="width: 100%;">{{ $colaborador->apeMaterCola }}</span>
								<span class="form-control" style="width: 100%;">{{ $colaborador->nombreCola }}</span>
							</div>
							<hr class="line">
							<label>Cotizaciones</label><br>
							Asistidos:<br>
							En elaboración:<br>
							Culminados:<br>
							Total:
						</div>
						<div class="panel panel-footer">
							<center><a href="{{URL::action('CotizacionController@detalleCoti',$colaborador->codiCola)}}"><button class="btn btn-warning">Detalles</button></a></center>
						</div>
					</div>					
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection