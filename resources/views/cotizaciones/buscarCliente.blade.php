@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <a href="{{ url()->previous() }}">volver</a>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4">
                <div class="tabbable" id="tabs-789296">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#panel-48214" data-toggle="tab">Natural</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#panel-674892" data-toggle="tab">Jurídico</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-48214">
                            {!!Form::open(array('url'=>'clientesNaturales','method'=>'POST','autocomplete'=>'off'))!!}
                            {{Form::token()}}

                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" name="txt_nombreClienNatu" class="form-control" placeholder="nombre..." value="{{old('txt_nombreClienNatu')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Apellido Paterno</label>
                                <input type="text" name="txt_apePaterClienN" class="form-control" placeholder="apellido paterno..." value="{{old('txt_apePaterClienN')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Apellido Materno</label>
                                <input type="text" name="txt_apeMaterClienN" class="form-control" placeholder="apellido materno..." value="{{old('txt_apeMaterClienN')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Dni</label>
                                <input type="text" name="txt_dniClienNatu" class="form-control" placeholder="dni..." value="{{old('txt_dniClienNatu')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" name="txt_direcClienNatu" class="form-control" placeholder="dirección..." value="{{old('txt_direcClienNatu')}}">
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
                                <label for="">Fecha de Nacimiento</label>
                                <input type="date" name="txt_fechaNaciClienN" class="form-control" placeholder="fecha de nacimiento..." value="{{old('txt_fechaNaciClienN')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="txt_correoClienNatu" class="form-control" placeholder="email..." value="{{old('txt_correoClienNatu')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono 01</label>
                                <input type="text" name="txt_tele01ClienNatu" class="form-control" placeholder="telefono 01..." value="{{old('txt_tele01ClienNatu')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono 02</label>
                                <input type="text" name="txt_tele02ClienNatu" class="form-control" placeholder="telefono 02..." value="{{old('txt_tele02ClienNatu')}}">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="reset">Cancelar</button>
                            </div>

                            {!!Form::close()!!}
                        </div>
                        <div class="tab-pane" id="panel-674892">
                            {!!Form::open(array('url'=>'clientesJuridicos','method'=>'POST','autocomplete'=>'off'))!!}
                            {{Form::token()}}

                            <div class="form-group">
                                <label for="">Razon Social</label>
                                <input type="text" name="txt_razonSocial" class="form-control" placeholder="Razon social..." value="{{old('txt_razonSocial')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Ruc</label>
                                <input type="text" name="txt_ruc" class="form-control" placeholder="Ruc..." value="{{old('txt_ruc')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" name="txt_direccion" class="form-control" placeholder="Dirección..." value="{{old('txt_direccion')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Distrito</label>
                                <input type="text" name="txt_codiDistri" class="form-control" placeholder="Distrito..." value="{{old('txt_codiDistri')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Provincia</label>
                                <input type="text" name="txt_codiProvin" class="form-control" placeholder="Provincia..." value="{{old('txt_codiProvin')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Departamento</label>
                                <input type="text" name="txt_codiDepar" class="form-control" placeholder="Departamento..." value="{{old('txt_codiDepar')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tipo Cliente</label>
                                <select name="idTipocli" class="form-control">
                                    @foreach($tipoClientesJuridicos as $tipos)
                                        <option value="{{$tipos->codiTipoCliJur}}">{{$tipos->descTipoCliJur}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Web</label>
                                <input type="text" name="txt_web" class="form-control" placeholder="Web..." value="{{old('txt_web')}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="reset">Cancelar</button>
                            </div>

                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Listado de clientes</h3>
                        <div class="col-md-4">
                            <!-- buscador -->
                            <form class="form-horizontal">
                                <fieldset>
                                    <!-- Search input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="txtBuscar">Colaborador</label>
                                        <div class="col-md-6">
                                            <input id="txtBuscar" name="txtBuscar" type="search" placeholder="nombre"
                                                   class="form-control input-md">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <!-- FIN buscador -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                        <th>Cliente</th>
                        <th>Tipo de cliente</th>
                        <th>DNI / RUC</th>
                        <th>ESTADO</th>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cli)
                            <tr>
                                @if( $cli->codiClienNatu != '001' )
                                    @if($cli->apePaterClienN != 'NULL' || $cli->apeMaterClienN != 'NULL')
                                        <td>{{ $cli->apePaterClienN }} {{ $cli->apeMaterClienN }} {{ $cli->nombreClienNatu }}</td>
                                    @else
                                        <td>{{ $cli->nombreClienNatu }}</td>
                                    @endif

                                @else
                                    <td>{{ $cli->razonSocialClienJ }}</td>
                                @endif
                                <td>{{ $cli->nombreTipoCliente }}</td>
                                @if( $cli->codiClienNatu != '001' )
                                    <td>{{ $cli->dniClienNatu }}</td>
                                @else
                                    <td>{{ $cli->rucClienJuri }}</td>
                                @endif
                                @if($cli->estado == 1)
                                    <td>ACTIVADO</td>
                                @else
                                    <td>DESACTIVADO</td>
                                @endif
                                <td>
                                    <a href="{{URL::action('ClienteController@edit',$cli->codiClien)}}"><button class="btn btn-info btn-sm">Seleccionar</button></a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- paginacion -->
                        {{ $clientes->render() }}
                        <!-- fin paginacion -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('input#txtBuscar').quicksearch('table tbody tr');
    </script>
@endsection