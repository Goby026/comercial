{{--zona de clientes, atencion y referencia--}}
<div class="container">
    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" name="txt_codiCoti" value="{{ $cotizacion }}">
                <input type="hidden" name="txt_codiCosteo" value="{{ $costeo->codiCosteo }}">
                <input type="hidden" name="txt_codiCola" value="{{ Auth::user()->codiCola }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Cliente:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                            @if(isset($coti_continue))

                                <input type="text" class="form-control" name="txt_cliente" id="txt_cliente"
                                       value="{{ $coti_continue->nomCli }}">

                            @else
                                <input type="text" class="form-control" name="txt_cliente" id="txt_cliente">
                            @endif
                            {{--<span class="input-group-btn">--}}
                            {{--<a href="{{ url('/cotizaciones/buscarCliente')  }}" class="btn btn-success"><i--}}
                            {{--class="fa fa-cog"></i></a></span>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Atención:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            @if(isset($coti_continue))
                                @if($contactoCliente->codiContacClien == 1)
                                    <input type="text" class="form-control" name="txt_atencion" id="txt_atencion"
                                           value="{{$coti_continue->nomContac}}">
                                @else
                                    <input type="text" class="form-control" name="txt_atencion" id="txt_atencion"
                                           value="{{$contactoCliente->nombreContacClien}} {{$contactoCliente->apePaterContacC}} {{$contactoCliente->apeMaterContacC}}">
                                @endif

                            @else
                                <input type="text" class="form-control" name="txt_atencion" id="txt_atencion"
                                       value="{{old('txt_atencion')}}">
                            @endif
                            {{--<span class="input-group-btn">--}}
                            {{--<a href="{{ url('/cotizaciones/getContactos')  }}" class="btn btn-success"><i--}}
                            {{--class="fa fa-cog"></i></a></span>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Asunto:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                        @if(isset($coti_continue))
                            <input type="text" id="txt_asuntoCoti" name="txt_asuntoCoti" class="form-control"
                                   value="{{ $coti_continue->asuntoCoti }}">
                        @else
                            <input type="text" id="txt_asuntoCoti" name="txt_asuntoCoti" class="form-control"
                                   value="{{ old('txt_asuntoCoti') }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Referencia:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        @if(isset($coti_continue))
                            <input type="text" id="txtReferencia" name="txtReferencia" class="form-control"
                                   value="{{ $coti_continue->referencia }}">
                        @else
                            <input type="text" id="txtReferencia" name="txtReferencia" class="form-control"
                                   value="{{ old('txt_asuntoCoti') }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        //    buscar el cliente con campo autocompletable
        $( "#txt_cliente" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "{{ URL::to('getClienteCotizacion') }}",
                    dataType: "json",
                    data: {
                        name: request.term
                    },
                    success: function( data ) {
                        response($.map(data, function(item){
                            return{
//								id: item.codiCoti,
                                value: item.nomCli,
                            }
                        }));
                    }
                });
            },
            minLength: 3,
//            select: function( event, ui ) {
//                $(this).val(ui.item.value);
//                $('#txt_cliente').val(ui.item.id);
//            }
        });

        //    buscar el asunto con campo autocompletable
        $( "#txt_asuntoCoti" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "{{ URL::to('getAsunto') }}",
                    dataType: "json",
                    data: {
                        name: request.term
                    },
                    success: function( data ) {
                        response($.map(data, function(item){
                            return{
//								id: item.codiCoti,
                                value: item.asuntoCoti,
                            }
                        }));
                    }
                });
            },
            minLength: 3,
//            select: function( event, ui ) {
//                $(this).val(ui.item.value);
//                $('#txt_cliente').val(ui.item.id);
//            }
        });

    });
</script>
