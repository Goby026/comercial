<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-inicio">	
	{!!Form::open(array('url'=>'cotizaciones','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Iniciar Cotización</h4>
			</div>
			<div class="modal-body">
				<p>En el momento de iniciar una cotización iniciará el contador de tiempo.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>				
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
</div>