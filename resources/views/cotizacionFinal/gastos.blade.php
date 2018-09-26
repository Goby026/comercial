@extends ('layouts.admin')
@section ('contenido')
    <style>
        .opt, .hospedaje , .newEmpresa , .error_no, .exito{
            display: none;
        }
    </style>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('cotizacionFinal') }}">Cierres</a>
                </li>
                <li class="breadcrumb-item active" style="margin-left: 20px;">
                    Gastos
                </li>
            </ol>
        </nav>
    </div>
    @if(isset($cotiFinalGasto))
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="page-header">
                    <h2 style="margin-left: 20px;">
                        Gastos <br>
                        <small>{{$cotiFinal->nombreTipoComproPago}} :{{$cotiFinal->numeComproPago}}</small><br>
                        <small>COTIZACION : </small>
                        {{--{{dd($cotiFinal)}}--}}
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <input type="text" name="cantGastos" value="{{ count($gastoPorCola) }}">
                @foreach($gastoPorCola as $gastoCola)
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $gastoCola->nombreCola }}
                                <div class="pull-right">ASIGNADO : S/. {{ $gastoCola->totalGasto }}</div>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <h3 class="panel-title">LISTA DE GASTOS <a
                                            href="#modal-add{{ $gastoCola->codiCotiFinalGasto }}"
                                            data-target="#modal-add{{ $gastoCola->codiCotiFinalGasto }}"
                                            data-toggle="modal"
                                            class="btn btn-danger btn-xs pull-right"
                                            style="margin-top: -8px; color: #FDFDFD;">
                                        <i class="fa fa-money"></i>
                                        Agregar gasto</a>
                                </h3>
                                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                                     role="dialog" tabindex="-1" id="modal-add{{ $gastoCola->codiCotiFinalGasto }}">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                 style="background-color: #9f191f; color: #FDFDFD;">
                                                <button class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                                <h4 class="modal-title">DETALLE DE GASTO - ASUNTO:
                                                    <small>asunto___coti</small>
                                                </h4>
                                                <hr>
                                                <h4>COTIZADO POR:
                                                    <small>nombre___colaborador___coti</small>
                                                </h4>
                                            </div>
                                            <form>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="text" name="txtcodiCotiFinalGasto"
                                                       value="{{ $gastoCola->codiCotiFinalGasto }}">
                                                <div class="modal-body">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="txtCategoria"
                                                                   class="control-label">CATEGORIA</label>
                                                            <select class="form-control" id="txtCategoria"
                                                                    name="txtCategoria">
                                                                @foreach($categoriaGasto as $catGasto)
                                                                    <option value="{{$catGasto->codiCateGasto}}">{{$catGasto->nombreCateGasto}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtFecha"
                                                                   class="control-label">FECHA</label>
                                                            <input type="date" class="form-control" id="txtFecha"
                                                                   name="txtFecha">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtEmpresa"
                                                                   class="control-label">EMPRESA</label>
                                                            <select id="txtEmpresa"
                                                                    name="txtEmpresa"
                                                                    class="form-control selectpicker"
                                                                    data-live-search="true">
                                                                <option value="1">DEFAULT</option>
                                                                <option value="2">NUEVA EMPRESA</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtComprobante"
                                                                   class="control-label">COMPROBANTE</label>
                                                            <select class="form-control" id="txtComprobante"
                                                                    name="txtComprobante">
                                                                @foreach($tipoComproPago as $tcp)
                                                                    <option value="{{$tcp->codiTipoComproPago}}">{{$tcp->nombreTipoComproPago}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtNumComprobante"
                                                                   class="control-label">N°</label>
                                                            <input type="text" class="form-control"
                                                                   id="txtNumComprobante"
                                                                   name="txtNumComprobante">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtMonto"
                                                                   class="control-label">MONTO</label>
                                                            <input type="text" class="form-control" id="txtMonto"
                                                                   name="txtMonto">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtDescripcion"
                                                                   class="control-label">DESCRIPCION</label>
                                                            <textarea name="txtDescripcion" id="txtDescripcion"
                                                                      cols="42"
                                                                      rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txtEstado"
                                                                   class="control-label">ESTADO</label>
                                                            <select class="form-control" id="txtEstado"
                                                                    name="txtEstado">
                                                                <option value="FINALIZADO">FINALIZADO</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group opt" id="opt">
                                                            <fieldset>
                                                                <legend>TRANSPORTE</legend>

                                                                <div>
                                                                    <label for="txtOrigen">ORIGEN</label>
                                                                    <input type="text" id="txtOrigen" name="txtOrigen">
                                                                    <label for="txtDestino">DESTINO</label>
                                                                    <input type="text" id="txtDestino"
                                                                           name="txtDestino">
                                                                </div>

                                                            </fieldset>
                                                        </div>

                                                        <div class="form-group hospedaje" id="hospedaje">
                                                            <fieldset>
                                                                <legend>HOSPEDAJE</legend>
                                                                <div>
                                                                    <label for="txtTiempo">TIEMPO: HORAS</label>
                                                                    <input type="text" id="txtTiempo" name="txtTiempo">
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        {{--alerta de error--}}
                                                        <div class="alert alert-dismissable alert-danger error_no">

                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">
                                                                ×
                                                            </button>
                                                            <h4>
                                                                Error!
                                                            </h4> <strong>Ruc existente!</strong> El número de ruc que
                                                            ingresaste está registrado en la base de datos de Perú Data.
                                                        </div>

                                                        {{--alerta de exito--}}
                                                        <div class="alert alert-dismissable alert-success exito">

                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-hidden="true">
                                                                ×
                                                            </button>
                                                            <h4>
                                                                Correcto!
                                                            </h4> <strong>Datos correctos!</strong> La empresa fue
                                                            registrada.
                                                        </div>

                                                        {{--formulario para nueva empresa de servicios--}}
                                                        <div class="form-group newEmpresa" id="newEmpresa">
                                                            <form>
                                                                <input type="hidden" name="_token"
                                                                       value="{{ csrf_token() }}">
                                                                <fieldset>
                                                                    <legend>NUEVA EMPRESA</legend>
                                                                    <div class="form-group">

                                                                        <label for="exampleInputEmail1">
                                                                            RAZON SOCIAL
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                               id="txtRazonSocial"
                                                                               name="txtRazonSocial"/>
                                                                    </div>
                                                                    <div class="form-group">

                                                                        <label for="exampleInputPassword1">
                                                                            RUC
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                               id="txtRuc"
                                                                               name="txtRuc"/>
                                                                    </div>
                                                                    <div class="form-group">

                                                                        <label for="exampleInputPassword1">
                                                                            DIRECCION
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                               id="txtDireccionEmpresa"
                                                                               name="txtDireccionEmpresa"/>
                                                                    </div>

                                                                    <button type="button" class="btn btn-primary"
                                                                            id="btnNewEmpresa" name="btnNewEmpresa">
                                                                        REGISTRAR
                                                                    </button>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="col-md-12">
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                data-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-success btn_addGasto"
                                                                data-dismiss="modal"
                                                                id="btn_addGasto">
                                                            Registrar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover ">
                                    <thead>
                                    <tr class="info">
                                        <th width="25%">TIPO DE GASTO</th>
                                        <th width="25%">COLABORADOR</th>
                                        <th width="30%">DESCRIPCION</th>
                                        <th width="10%">FECHA</th>
                                        <th width="10%" style="text-align: center;">MONTO S/</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($detalleGastos))
                                        @foreach($detalleGastos as $detalle)
                                            @if($detalle->codiCola == $gastoCola->codiCola)
                                                <tr class="primary">
                                                    <td>{{ $detalle->nombreCateGasto }}</td>
                                                    <td>{{ $detalle->nombreCola }} {{ $detalle->apePaterCola }} {{ $detalle->apeMaterCola }}</td>
                                                    <td>{{ $detalle->descripDetaGasto }}</td>
                                                    <td>{{ $detalle->fechaRegisGasto }}</td>
                                                    <td><input type="text" class="form-control sumMonto"
                                                               style="text-align: center;"
                                                               readonly
                                                               value="{{ number_format( $detalle->montoDetaGasto, 2, '.', ',' ) }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr class="danger" id="addRow">
                                            <td colspan="4" style="text-align: center;"><b>TOTAL</b></td>
                                            <td><input id="txtMontoTotal" name="txtMontoTotal" class="form-control"
                                                       type="text"
                                                       style="text-align: center;" readonly></td>
                                        </tr>
                                    @else
                                        <tr class="danger" id="addRow">
                                            <td colspan="4" style="text-align: right;">TOTAL</td>
                                            <td><input id="txtMontoTotal" name="txtMontoTotal" class="form-control"
                                                       type="text"
                                                       style="text-align: center;" readonly></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    <script>
        $(document).ready(function () {
            calculos();
        });

        //crear nuevo gasto
        $('.btn_addGasto').on('click', function () {
            var content = '';
            datos = {
                '_token': $('input[name=_token]').val(),
                txtCategoria: $('#txtCategoria').val(),
                txtComprobante: $('#txtComprobante').val(),
                txtNumComprobante: $('input[name=txtNumComprobante]').val(),
                txtMonto: $('input[name=txtMonto]').val(),
                txtFecha: $('input[name=txtFecha]').val(),
                txtDescripcion: $('#txtDescripcion').val(),
                txtEstado: $('input[name=txtEstado]').val(),
                txtOrigen: $('input[name=txtOrigen]').val(),
                txtDestino: $('input[name=txtDestino]').val(),

                txtTiempo: $('input[name=txtTiempo]').val(),
                txtcodiCotiFinalGasto: $('input[name=txtcodiCotiFinalGasto]').val(),
                txtEmpresa: $('#txtEmpresa').val()
            };

//            alert("click boton");

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ URL::to('addDetalleGasto') }}",
                data: datos,
                success: function (response) {
                    console.log(response);

//                    if (response) {
//                        content += "<tr class='primary'>";
//                        content += "<td>" + response.nombreCateGasto + "</td>";
//                        content += "<td>" + response.nombreCola + " " + response.apePaterCola + " " + response.apeMaterCola + "</td>";
//                        content += "<td>" + response.descripDetaGasto + "</td>";
//                        content += "<td>" + response.fechaRegisGasto + "</td>";
//                        content += "<td><input type='text' class='form-control sumMonto' style='text-align: center;' readonly value='" + response.montoDetaGasto + "'></td>";
//                        content += "</tr>";
//
//                        $('#addRow').before(content);
//                        calculos();
//                    } else {
//                        console.log("error en la petición http");
//                    }
                },
                error: function (error) {
                    console.log(error.message)
                }
            });
        });

        //crear nueva empresa
        $('#btnNewEmpresa').on('click', function () {
            var content = '';
            datos = {
                '_token':$('input[name=_token]').val(),
                txtRazonSocial: $('input[name=txtRazonSocial]').val(),
                txtRuc: $('input[name=txtRuc]').val(),
                txtDireccionEmpresa: $('input[name=txtDireccionEmpresa]').val()
            };

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ URL::to('addEmpresaGasto') }}",
                data: datos,
                success: function (response) {
                    console.log(response);

                    if (response){
                        content += "<option value='"+response.codiProveedor+"' selected>"+response.nombreProveedor+"</option>";
                        $('#txtEmpresa').append(content);
                        $('.newEmpresa').hide();
                        $('#txtEmpresa').selectpicker('refresh');
                    }else if (response == 0){
                        $('.error_no').show();
                    }else{
                        console.log("error en la petición http");
                    }
                },
                error: function (error) {
                    console.log(error.message)
                }
            });
        });

        $('#txtCategoria').change(function(){
            var opcion = $('#txtCategoria option:selected').text();
            if (opcion === 'TRANSPORTE') {
                $('.opt').show();
                $('.hospedaje').hide();
            }else if (opcion === 'HOSPEDAJE'){
                $('.opt').hide();
                $('.hospedaje').show();
            }else{
                $('.opt').hide();
                $('.hospedaje').hide();
            }
        });


        $('#txtEmpresa').change(function(){
            var opcion = $('#txtEmpresa option:selected').val();
            if (opcion == 2) {
                $('.newEmpresa').show();
            }else{
                $('.newEmpresa').hide();
            }
        });

        function calculos(){
            var total = 0.0;
            $('.sumMonto').each(function(){
                var monto = $(this).val();
                total += parseFloat(monto);
            });

            $('#txtMontoTotal').val(parseFloat(total).toFixed(2));
        }
    </script>
@endsection