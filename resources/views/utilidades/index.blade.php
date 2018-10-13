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

    <div class="row" id="utilidades">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Reportes de utilidad
                    {{--<small>buscador por fechas</small>--}}
                    <small>buscador</small>
                </h1>
            </div>
        </div>
        <div class="col-md-4">
            <form method="POST" v-on:submit.prevent="getUtilidades">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="table">
                    <tr>
                        <td>
                            <label for="txtFechaInicio">
                                Fecha inicial
                            </label>
                        </td>
                        <td>
                            <input type="date"
                                   class="form-control"
                                   id="txtFechaInicio"
                                   name="txtFechaInicio"
                                   v-model="txtFechaInicio"
                                   required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txtFechaFinal">
                                Fecha final
                            </label>
                        </td>
                        <td>
                            <input type="date"
                                   class="form-control"
                                   id="txtFechaFinal"
                                   name="txtFechaFinal"
                                   v-model="txtFechaFinal"
                                   required/>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <button type="submit" class="btn btn-success pull-right btn-block"
                                    style="margin-left: 2px;">
                                Mostrar
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th>
                        Ejecutivo
                    </th>
                    <th>
                        Total cotizaciones
                    </th>
                    <th>
                        Total Facturados
                    </th>
                    <th>
                        Monto Facturado
                    </th>
                    <th>
                        Costo sin IGV
                    </th>
                    <th>
                        Margen
                    </th>
                    <th>
                        Utilidad
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-success" v-for="utilidad in utilidades">
                    <td>
                        @{{ utilidad.nombreCola}}
                    </td>
                    <td>
                        @{{ utilidad.cotizaciones }}
                    </td>
                    <td>
                        @{{ utilidad.facturado }}
                    </td>
                    <td>
                        @{{ utilidad.montoFacturado }}
                    </td>
                    <td>
                        @{{ utilidad.costoSIGV }}
                    </td>
                    <td>
                        @{{ utilidad.margen }}
                    </td>
                    <td>
                        @{{ utilidad.utilidad }}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="col-md-12">
                <form method="POST" action="{{ url('utilidadesExcel') }}" style="margin-right: 3%;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="FechaInicio" v-model="txtFechaInicio" required>
                    <input type="hidden" name="FechaFinal" v-model="txtFechaFinal" required>
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Excel</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/vue-utilidades/utilidades.js') }}"></script>
@endsection
