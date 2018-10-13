@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Gastos</h3>
			{{--<a href="dolar/create"><button class="btn btn-success pull-right">Nuevo</button></a>--}}
			{{--@include('gastos.search')--}}
		</div>
	</div>
	<hr>
	<div class="row" id="gastos">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>COTIZACION</th>
						<th>CLIENTE</th>
						<th>COLABORADOR</th>
						<th>FECHA GASTO</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>
					</thead>
					<tbody>
					<tr v-for="gasto in gastos">
						<th scope="row">@{{ gasto.numCoti }}</th>
						<td>@{{ gasto.nomCli }}</td>
						<td>@{{ gasto.nombreCola }}</td>
						<td>@{{ gasto.fechaHoraIni }}</td>
						<td>@{{ gasto.monto }}</td>
						<td>
							<a class="class= btn btn-warning btn-xs" data-toggle="modal" data-target="#detalle"
							   v-on:click.prevent="editSistema(sistema)">
								Detalle
							</a>
						</td>
					</tr>
					</tbody>
				</table>
				@include('gastos.modal')
			</div>
		</div>
	</div>

	<script src="{{ asset('js/vue-gastos/gastos.js') }}"></script>
@endsection