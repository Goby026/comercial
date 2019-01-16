<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="detalle" tabindex="-1" role="dialog" aria-labelledby="detalleLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="detalleLabel">Detalle de gasto</h3><h4>Cotización: @{{ numCotizacion }}</h4>
			</div>
			<div class="modal-body">

				<p>CLIENTE: @{{ nomCli }}</p>

				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>FECHA</th>
							<th>DOCUMENTO</th>
							<th>N°</th>
							<th>CATEGORIA</th>
							<th class="pull-right">MONTO</th>
						</thead>
						<tbody>
						<tr v-for="det in detalles">
							<td>@{{ det.fechaGasto }}</td>
							<td>@{{ det.nombreTipoComproPago }}</td>
							<td>@{{ det.numeComproPago }}</td>
							<td>@{{ det.nombreCateGasto }}</td>
							<td><span class="pull-right">@{{ det.montoDetaGasto }}</span></td>
						</tr>
						<tr>
							<td colspan="4"><span class="pull-right">TOTAL</span></td>
							<td><span class="pull-right">@{{ total }}</span></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal" v-on:click="reset">Cerrar</button>
				{{--<button type="button" class="btn btn-primary">Save changes</button>--}}
			</div>
		</div>
	</div>
</div>