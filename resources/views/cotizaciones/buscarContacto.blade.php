@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ url()->previous() }}">volver</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					{!!Form::open(array('url'=>'contactosCliente','name'=>'frm_new_contact','id'=>'frm_new_contact','method'=>'POST','autocomplete'=>'off'))!!}
					{{Form::token()}}

					<div class="form-group">
						<label for="">Nombres</label>
						<input type="text" name="txt_nombreContacClien" class="form-control" placeholder="nombre..." value="{{old('txt_nombreContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Apellido Paterno</label>
						<input type="text" name="txt_apePaterContacC" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterContacC')}}">
					</div>
					<div class="form-group">
						<label for="">Apellido Materno</label>
						<input type="text" name="txt_apeMaterContacC" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterContacC')}}">
					</div>
					<div class="form-group">
						<label for="">DNI</label>
						<input type="text" name="txt_dniContacClien" class="form-control" placeholder="dni..." value="{{old('txt_dniContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" name="txt_correoContacClien" class="form-control" placeholder="email..." value="{{old('txt_correoContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Dirección</label>
						<input type="text" name="txt_direcContacClien" class="form-control" placeholder="dirección..." value="{{old('txt_direcContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Distrito</label>
						<input type="text" name="txt_codiDistri" class="form-control" placeholder="distrito..." value="{{old('txt_codiDistri')}}">
					</div>
					<div class="form-group">
						<label for="">Provincia</label>
						<input type="text" name="txt_codiProvin" class="form-control" placeholder="provincia..." value="{{old('txt_codiProvin')}}">
					</div>
					<div class="form-group">
						<label for="">Departamento</label>
						<input type="text" name="txt_codiDepar" class="form-control" placeholder="departamento..." value="{{old('txt_codiDepar')}}">
					</div>
					<div class="form-group">
						<label for="">Celular 01</label>
						<input type="text" name="txt_celu01ContacClien" class="form-control" placeholder="celular 01..." value="{{old('txt_celu01ContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Celular 02</label>
						<input type="text" name="txt_celu02ContacClien" class="form-control" placeholder="celular 02..." value="{{old('txt_celu02ContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Teléfono</label>
						<input type="text" name="txt_teleContacClien" class="form-control" placeholder="teléfono..." value="{{old('txt_teleContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Anexo</label>
						<input type="text" name="txt_aneContacClien" class="form-control" placeholder="anexo..." value="{{old('txt_aneContacClien')}}">
					</div>
					<div class="form-group">
						<label for="">Cliente</label>
						<input type="text" name="txt_codiClienJuri" class="form-control" placeholder="cliente..." value="{{old('txt_codiClienJuri')}}">
					</div>

					<div class="form-group">
						<input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
						<button id="btn_reg" class="btn btn-primary" type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
					</div>

					{!!Form::close()!!}
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<h3>Listado de Contactos</h3>
							@include('proveedorContacto.search')
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-condensed table-hover">
							<thead>
							<th>Contacto</th>
							<th>DNI</th>
							<th>Email</th>
							<th>Dirección</th>
							<th>Distrito</th>
							<th>Provincia</th>
							<th>Departamento</th>
							<th>Teléfono</th>
							<th>Cliente</th>
							<th>Estado</th>
							</thead>
							<tbody id="campos">
							@foreach($contactosCliente as $contactosC)
								<tr>
									<td>{{ $contactosC->nombreContacClien }} {{ $contactosC->apePaterContacC }} {{ $contactosC->apeMaterContacC }}</td>
									<td>{{ $contactosC->dniContacClien }}</td>
									<td>{{ $contactosC->correoContacClien }}</td>
									<td>{{ $contactosC->direcContacClien }}</td>
									<td>{{ $contactosC->codiDistri }}</td>
									<td>{{ $contactosC->codiProvin }}</td>
									<td>{{ $contactosC->codiDepar }}</td>
									<td>{{ $contactosC->teleContacClien }}</td>
									<td>{{ $contactosC->aneContacClien }}</td>
									@if($contactosC->estado == 1)
										<td>ACTIVADO</td>
									@endif
									<td>DESACTIVADO</td>
									<td>
										<a href="{{URL::action('ContactoClienteController@edit',$contactosC->codiContacClien)}}">
											<button class="btn btn-warning">Editar</button>
										</a>
										<a href="" data-target="#modal-delete-{{$contactosC->codiContacClien}}"
										   data-toggle="modal">
											<button class="btn btn-danger">Eliminar</button>
										</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- paginacion -->
			{{$contactosCliente->render()}}
			<!-- fin paginacion -->
		</div>
	</div>

	<script>
		$(document).on('submit', '#frm_new_contact', function(event){
            event.preventDefault();
		});

        $('#btn_reg').on('click', function () {
            datos = {
                '_token':$('input[name=_token]').val(),
                txt_nombreContacClien: $('input[name=txt_nombreContacClien]').val(),
                txt_apePaterContacC: $('input[name=txt_apePaterContacC]').val(),
                txt_apeMaterContacC: $('input[name=txt_apeMaterContacC]').val(),
                txt_dniContacClien: $('input[name=txt_dniContacClien]').val(),
                txt_correoContacClien: $('input[name=txt_correoContacClien]').val(),
                txt_direcContacClien: $('input[name=txt_direcContacClien]').val(),
                txt_codiDistri: $('input[name=txt_codiDistri]').val(),
                txt_codiProvin: $('input[name=txt_codiProvin]').val(),
                txt_codiDepar: $('input[name=txt_codiDepar]').val(),
                txt_celu01ContacClien: $('input[name=txt_celu01ContacClien]').val(),
                txt_celu02ContacClien: $('input[name=txt_celu02ContacClien]').val(),
                txt_teleContacClien: $('input[name=txt_teleContacClien]').val(),
                txt_aneContacClien: $('input[name=txt_aneContacClien]').val(),
                txt_codiClienJuri: $('input[name=txt_codiClienJuri]').val(),
                txt_codiCola: $('input[name=txt_codiCola]').val()
            };

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ URL::to('saveContacto') }}",
                data: datos,
                success: function (response) {
                    if (response != 0) {
                        var fila = "<tr>";
                        fila += "<td>"+response.nombreContacClien+" "+response.apePaterContacC+" "+response.apeMaterContacC+"</td>";
                        fila += "<td>"+response.dniContacClien+"</td>";
                        fila += "<td>"+response.correoContacClien+"</td>";
                        fila += "<td>"+response.direcContacClien+"</td>";
                        fila += "<td>"+response.codiDistri+"</td>";
                        fila += "<td>"+response.codiProvin+"</td>";
                        fila += "<td>"+response.codiDepar+"</td>";
                        fila += "<td>"+response.celu01ContacClien+"</td>";
                        fila += "<td>"+response.celu02ContacClien+"</td>";
                        fila += "<td>"+response.teleContacClien+"</td>";
                        fila += "<td>"+response.aneContacClien+"</td>";
                        fila += "<td>"+response.estado+"</td><td><a href=''><button class='btn btn-warning'>Editar</button></a>";
                        fila += "<a href=' data-target='#modal-delete-' data-toggle='modal'> <button class='btn btn-danger'>Eliminar</button></a></td>";
                        fila += "</tr>";

                        $('#campos').append(fila);
                    } else {
                        alert('no');
                    }
                },
                error: function (error) {
                    alert("error "+error.message);
                }
            });

//            alert("Nombres: "+datos.txt_nombreContacClien +" Apellidos: "+datos.txt_apePaterContacC+" "+datos.txt_apeMaterContacC);
        });
	</script>
@endsection