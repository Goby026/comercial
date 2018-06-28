@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Modelo de carta de presentacion<a href="cartaPresentacion/create"><button class="btn btn-success pull-right">Nuevo</button></a></h3>			
			<a href="{{url('pdf')}}" target="_blank"><button class="btn btn-success pull-right">Modelo de carta</button></a>
			@include('cartaPresentacion.search')
		</div>
	</div>
@endsection