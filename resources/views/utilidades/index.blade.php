@extends ('layouts.admin')
@section ('contenido')
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
			</li>
			<li class="breadcrumb-item active">
				Reportes de Utilidad
			</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Reportes de utilidad <small>buscador de cotizaciones cerradas</small>
				</h1>
			</div>
			<form role="form" class="form-inline">
				<div class="form-group">

					<label for="txtFechaInicio">
						Fecha inicial
					</label>
					<input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio"/>
				</div>
				<div class="form-group">

					<label for="txtFechaFinal">
						Fecha final
					</label>
					<input type="date" class="form-control" id="txtFechaFinal" name="txtFechaFinal"/>
				</div>
				<button type="submit" class="btn btn-success">
					Mostrar
				</button>
			</form>
		</div>
	</div>
@endsection