@extends ('layouts.admin')
@section ('contenido')
	<style>
		.head_costeo{
			background-color: #9f191f;
			color: #FDFDFD;
			border: 0.5px solid lightsteelblue;
		}

		.head_datos{
			background-color: #0d6aad;
			color: #FDFDFD;
			border: 0.5px solid lightsteelblue;
		}
	</style>
<div class="row">
	<div class="col-md-12">
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ url('cotizaciones') }}">Cotizaciones</a>
				</li>
				<li class="breadcrumb-item active">
					Costeo
				</li>
			</ol>
		</nav>
	</div>
</div>
	{{-- cargar cambio y monto de igv --}}
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Asunto
					<small>{{ $cotizacion->asuntoCoti }}</small>
				</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="" method="POST">
				{{Form::token()}}
				<table>
					<thead class="head_datos">
					<th width="100" style="text-align: center;">#Coti</th>
					<th width="100" style="text-align: center;">Costeos</th>
					<th width="100" style="text-align: center;">Cambio</th>
					<th width="100" style="text-align: center;">Igv</th>
					</thead>
					<tbody>
					<td><input id="txt_numCoti" name="txt_numCoti" type="text" class="form-control"
							   style="text-align: center;" value="{{$cotizacion->numCoti}}" readonly></td>
					<td><input id="txt_total_costeos" name="txt_total_costeos" type="text" class="form-control"
							   style="text-align: center;" value="{{ count($productos) }}" readonly>
					</td>
					<td><input id="txt_dolar" name="txt_dolar" type="text" class="form-control"
							   style="text-align: center;" value="3.3" readonly></td>
					<td><input id="txt_igv" name="txt_igv" type="text" class="form-control" style="text-align: center;"
							   value="0.18" readonly></td>
					</tbody>
				</table>
				<div class="row">
					<button class="btn btn-success btn-sm pull-right add-modal-newItem" type="button"
							style="margin-right: 30px;"><i class="fa fa-plus-square"></i>&nbsp;&nbsp; Agregar costeo
					</button>
				</div>
			</form>
			<hr>
			<form action="{{ url('updateCosteo', $cotizacion->codiCoti) }}" method="POST">
				{{Form::token()}}

				<input type="hidden" name="txt_codiCoti" value="{{ $cotizacion->codiCoti }}">
				<table>
					<thead class="head_costeo">
					<tr>
						<th style="text-align: center;">
							DETALLE
						</th>
						<th style="text-align: center;">
							M. COSTO
						</th>
						<th style="text-align: center;">
							CAN
						</th>
						<th style="text-align: center;">
							C.U $ SIN
						</th>
						<th style="text-align: center;">
							C.U $
						</th>
						<th style="text-align: center;">
							TOTAL
						</th>
						<th style="text-align: center;">
							C.U S/
						</th>
						<th style="text-align: center;">
							TOTAL
						</th>
						<th style="text-align: center;">
							P.U. S/
						</th>
						<th style="text-align: center;">
							TOTAL
						</th>
						<th style="text-align: center;">
							UTILIDAD
						</th>
						<th style="text-align: center;">
							M. VENTA
						</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($productos as $producto)
						<tr>
							<td width="300">
								@if($producto->itemCosteo != '.')
									<input name="txt_new_product{{ $producto->numPack }}" class="form-control" type="text" value="{{ $producto->itemCosteo }}"
										   size="50">
								@else
									<input name="txt_new_product{{ $producto->numPack }}" class="form-control" type="text"
										   value="{{ $producto->nombreProducProveedor }}"
										   size="50">
								@endif
							</td>
							<td>
								<input class="form-control" type="text" id="txt_margen_cu_soles{{ $producto->numPack }}"
									   name="txt_margen_cu_soles{{ $producto->numPack }}"
									   value="{{ $producto->margenCoti }}" style="text-align: center;">
							</td>
							<td>
								<input class="form-control" type="text" id="txt_cantidad{{ $producto->numPack }}"
									   name="txt_cantidad{{ $producto->numPack }}" value="{{ $producto->cantiCoti }}"
									   size="2" style="text-align: center;">
							</td>
							<td>
								<input class="form-control" type="text" id="txt_cus_dolar_sin{{ $producto->numPack }}"
									   name="txt_cus_dolar_sin{{ $producto->numPack }}"
									   value="{{ number_format($producto->precioProducDolar, 2, '.', '') }}" size="10"
									   style="text-align: center;">
							</td>
							<td>
								<input class="form-control" type="text" id="txt_cus_dolar{{ $producto->numPack }}"
									   name="txt_cus_dolar{{ $producto->numPack }}"
									   value="{{ number_format($producto->costoUniIgv, 2, '.', '') }}" size="10"
									   style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_total_dolar{{ $producto->numPack }}"
									   name="txt_total_dolar{{ $producto->numPack }}"
									   value="{{ number_format($producto->costoTotalIgv, 2, '.', '') }}" size="10"
									   style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_cus_soles{{ $producto->numPack }}"
									   name="txt_cus_soles{{ $producto->numPack }}"
									   value="{{ number_format($producto->costoUniSolesIgv, 2, '.', '') }}" size="10"
									   style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_total_soles{{ $producto->numPack }}"
									   name="txt_total_soles{{ $producto->numPack }}"
									   value="{{ number_format($producto->costoTotalSolesIgv, 2, '.', '') }}" size="10"
									   style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_pu_soles{{ $producto->numPack }}"
									   name="txt_pu_soles{{ $producto->numPack }}"
									   value="{{ number_format($producto->precioUniSoles, 2, '.', '') }}"
									   size="10" style="text-align: center;">
							</td>
							<td>
								<input class="form-control" type="text" id="txt_pu_total_soles{{ $producto->numPack }}"
									   name="txt_pu_total_soles{{ $producto->numPack }}"
									   value="{{ number_format($producto->precioTotal, 2, '.', '') }}"
									   size="10" style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_utilidad_u{{ $producto->numPack }}"
									   name="txt_utilidad_u{{ $producto->numPack }}"
									   value="{{ number_format($producto->utiCoti, 2, '.', '')  }}" size="10"
									   style="text-align: center;" readonly>
							</td>
							<td>
								<input class="form-control" type="text" id="txt_margen_u{{ $producto->numPack }}"
									   name="txt_margen_u{{ $producto->numPack }}"
									   value="{{ number_format($producto->margenVentaCoti, 2, '.', '')  }}" size="10"
									   style="text-align: center;" readonly>
							</td>
						</tr>
					@endforeach
					<tr>
						<td colspan="9"></td>
						<td><input class="form-control" type="text" id="txt_ventaTotal" name="txt_ventaTotal"
								   style="text-align: center;"value="{{ $costeo->totalVentaSoles }}"></td>
						<td><input class="form-control" type="text" id="txt_utilidadTotal" name="txt_utilidadTotal"
								   style="text-align: center;"value="{{ $costeo->utilidadVentaSoles }}"></td>
						<td><input class="form-control" type="text" id="txt_margenTotal" name="txt_margenTotal"
								   style="text-align: center;"value="{{ $costeo->margenVenta }}"></td>
					</tr>

					</tbody>
				</table>
			<br>
			<div class="row">
				{{--<button type="submit" class="btn btn-warning btn-sm pull-right" style="margin-right: 30px;"><i--}}
							{{--class="fa fa-floppy-o"></i> Guardar--}}
				{{--</button>--}}
			</div>
			</form>
		</div>
	</div>



	<!-- Modal para confirmar nuevo item -->
	<div id="addModal-newItem" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">¿Desea agregar otro item?</label>
					</div>
					<div class="modal-footer-newItem">
						<a href="#" class="btn btn-success add-newItem" data-dismiss="modal">
							<span id="" class='fa fa-check'></span> Continuar
						</a>
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							<span class='fa fa-remove'></span> Cerrar
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
        var numCoti = parseInt($("#txt_total_costeos").val());
        var cambio = $("#txt_dolar").val();
        var igv = $("#txt_igv").val();
        //    var total = 0.0;
        //    var utilidad = 0;

        $('input').click(function () {

            for (var i = 1; i < numCoti + 1; i++) {

                if ($(this).attr('name') === 'txt_cantidad' + i || $(this).attr('name') === 'txt_cus_dolar_sin' + i || $(this).attr('name') === 'txt_margen_cu_soles' + i) {

                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    $(txt_cantidad + ", " + txt_cus_dolar_sin + ", " + txt_margen_cu_soles).keyup(function () {
                        // console.log($(this).attr('name'));
                        var cantidad = $(txt_cantidad).val();
                        var precioSinIgv = $(txt_cus_dolar_sin).val();

                        var totalDolaresCon = precioSinIgv * (parseFloat(igv) + 1);
                        var totalDolares = totalDolaresCon * cantidad;

                        var totalSolesInc = precioSinIgv * cambio * (parseFloat(igv) + 1);
                        var totalSoles = totalSolesInc * cantidad;

                        //montos en dolares
                        $(txt_cus_dolar).val(parseFloat(totalDolaresCon).toFixed(2));
                        $(txt_total_dolar).val(parseFloat(totalDolares).toFixed(2));

                        //montos en soles
                        $(txt_cus_soles).val(parseFloat(totalSolesInc).toFixed(2));
                        $(txt_total_soles).val(parseFloat(totalSoles).toFixed(2));

                        var margenCuSoles = $(txt_margen_cu_soles).val();//1.35
                        var pus = (margenCuSoles * totalSoles) / cantidad;

                        $(txt_pu_soles).val(parseFloat(pus).toFixed(2));

                        var ventaTotal = pus * cantidad;
                        var uti = ventaTotal - totalSoles;
                        var margen = (uti * 100) / ventaTotal;

                        $(txt_pu_total_soles).val(parseFloat(ventaTotal).toFixed(2));

                        $(txt_utilidad_u).val(parseFloat(uti).toFixed(2));

                        $(txt_margen_u).val(parseFloat(margen).toFixed(2));

//                    total += ventaTotal;
//                    utilidad += uti;
//
//                    $('#txt_ventaTotal').val(parseFloat(total).toFixed(2));
//                    $('#txt_utilidadTotal').val(parseFloat(utilidad).toFixed(2));

                        console.log(pus);
                        calcSumas();
                    });
                }
            }
        });

        function calcSumas() {
            var c = parseInt($("#txt_total_costeos").val());
            var vt = 0.0;
            var ut = 0.0;
            var sub_mt = 0.0;
            for (var i = 1; i < c + 1; i++) {
                vt += parseFloat($('#txt_pu_total_soles' + i).val());
                ut += parseFloat($('#txt_utilidad_u' + i).val());
                sub_mt += parseFloat($('#txt_margen_u' + i).val());
            }
            var mt = sub_mt / c;

            $('#txt_ventaTotal').val(vt.toFixed(2));
            $('#txt_utilidadTotal').val(ut.toFixed(2));
            $('#txt_margenTotal').val(mt.toFixed(2));

        }

	</script>

	<script>
        var numCoti = parseInt($("#txt_total_costeos").val());
        //    var cambio = $("#txt_dolar").val();
        //    var igv = $("#txt_igv").val();
        //    var total = 0;
        //    var utilidad = 0;

        $('input').click(function () {

            for (var i = 1; i < numCoti + 1; i++) {

                if ($(this).attr('name') === 'txt_pu_soles' + i) {

                    var txt_cantidad = "#txt_cantidad" + i;
                    var txt_cus_dolar_sin = "#txt_cus_dolar_sin" + i;
                    var txt_margen_cu_soles = '#txt_margen_cu_soles' + i;
                    var txt_cus_dolar = "#txt_cus_dolar" + i;
                    var txt_total_dolar = "#txt_total_dolar" + i;
                    var txt_cus_soles = "#txt_cus_soles" + i;
                    var txt_total_soles = "#txt_total_soles" + i;
                    var txt_pu_soles = '#txt_pu_soles' + i;
                    var txt_pu_total_soles = '#txt_pu_total_soles' + i;
                    var txt_utilidad_u = '#txt_utilidad_u' + i;
                    var txt_margen_u = '#txt_margen_u' + i;

                    $(txt_pu_soles).keyup(function () {
                        // console.log($(this).attr('name'));
                        var cantidad = parseFloat($(txt_cantidad).val());
                        var precioSinIgv = $(txt_cus_dolar_sin).val();
                        var margenCuSoles = $(txt_margen_cu_soles).val();//1.35

                        var totalPuSoles = $(txt_pu_soles).val();
                        var utilidad = 0.0;
                        var margen = 0.0;

                        if (cantidad > 0.0) {
                            if (parseFloat(margenCuSoles) > 0) {
                                if (parseFloat(precioSinIgv) > 0) {
                                    $(txt_pu_total_soles).val(totalPuSoles * cantidad);
                                    utilidad = parseFloat($(txt_pu_total_soles).val()) - parseFloat($(txt_total_soles).val());
                                    margen = (utilidad * 100) / parseFloat($(txt_pu_total_soles).val());
                                    $(txt_utilidad_u).val(utilidad.toFixed(2));
                                    $(txt_margen_u).val(margen.toFixed(2));

                                    calcSumas();
                                } else {
                                    console.log("Ingrese precio en dolares!!");
                                }
                            } else {
                                console.log("Ingrese margen de costo unitario!!");
                            }
                        } else {
                            console.log("Ingrese cantidad!!");
                        }

                    });
                }
            }

        });
	</script>

	<script>

        // registrar nuevo item
        $(document).on('click', '.add-modal-newItem', function () {
            $('.modal-title').text('Confirmar nuevo item');
            $('#addModal-newItem').modal('show');
        });

        $('.modal-footer-newItem').on('click', '.add-newItem', function () {
            //registrar nuevo itemCosteo
            datos = {
                '_token': $('input[name=_token]').val(),
                codiCoti: $('input[name=txt_codiCoti]').val()
            };
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('addItem') }}",
                data: datos,
                success: function (response) {
                    console.log(response);

                    if (response == '1') {
                        location.reload();
                    } else {
                        console.log("error");
                    }
                }
            });
        });
	</script>
@endsection