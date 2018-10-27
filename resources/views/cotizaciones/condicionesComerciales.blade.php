<div class="col-md-6" id="condicionesComerciales">
    <input type="hidden" name="codiCoti" value="{{ $cotizacion }}">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <a href="#" class="pull-right" data-toggle="modal" data-target="#modalNuevo">
                <i class="fa fa-plus-square" style="font-size: 20px; color: #00a65a;"></i>
            </a>
            <h3 class="panel-title">TÉRMINOS COMERCIALES </h3>
        </div>
        <div class="panel-body">
            {{--@foreach($condicionesCom as $condicion)--}}
            {{--<input type="text" name="txt_{{ $condicion->idTCotiCondiciones }}" class="form-control"--}}
            {{--value="{{ $condicion->descripcion }}">--}}
            {{--@endforeach--}}

            <table class="table table-bordered table-responsive table-striped">
                <tbody>
                <tr v-for="condicion in condiciones">
                    {{--<td>@{{ condicion.codiCondiComer }}</td>--}}
                    <td>@{{ condicion.descripcion }}</td>
                    <td style="text-align: center;">
                        {{--boton eliminar--}}
                        {{--<button type="button" class="btn btn-danger btn-xs" data-toggle="modal"--}}
                                {{--data-target="#modalDelete">--}}
                            {{--<i class="fa fa-trash"></i>--}}
                        {{--</button>--}}
                        <a class="btn btn-danger btn-xs"
                           v-on:click.prevent="deleteCondicion(condicion)"><i class="fa fa-trash"></i></a>
                    </td>

                    <td style="text-align: center;">
                        {{--boton editar--}}
                        <button type="button"
                                class="btn btn-warning btn-xs"
                                data-toggle="modal"
                                v-on:click.prevent="editCondicion(condicion)">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Delete -->
    {{--<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
                                {{--aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title" id="modalDeleteLabel">Eliminar</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--...--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>--}}
                    {{--<button type="button" class="btn btn-danger">Eliminar</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" v-on:submit.prevent="updateCondicion(condicion.idTCotiCondiciones)">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalEditLabel">Editar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text"
                                   name="descripcion"
                                   class="form-control"
                                   id="descripcion"
                                   aria-describedby="descripcionlHelp"
                                   v-model="condicion.descripcion">
                            {{--<span v-for="error in errors" class="text-danger">@{{ error }}</span>--}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" v-on:submit.prevent="createCondicion()">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalNuevoLabel">Nuevo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="hidden" v-model="codiCondiComer">
                            <input type="text"
                                   name="descripcion"
                                   class="form-control"
                                   id="descripcion"
                                   aria-describedby="descripcionlHelp"
                                   placeholder="descripcion"
                                   v-model="descripcion">
                            {{--<span v-for="error in errors" class="text-danger">@{{ error }}</span>--}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/vue-condicionesComerciales/condicionesComerciales.js') }}"></script>