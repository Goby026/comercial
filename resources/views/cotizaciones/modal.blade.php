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
				<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
			</div>
			<div class="modal-body">
				<center>Al iniciar una nueva cotización, se activará el contador de tiempo.</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success">Continuar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
</div>