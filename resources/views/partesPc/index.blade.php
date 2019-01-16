@extends ('layouts.admin')
@section ('contenido')
    <div id="pc">
        <h1>@{{ title }}</h1>
        <hr>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#modalPartes">
            Agregar partes
        </button>

        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Parte</th>
                <th>Descripción</th>
                <th>Icono</th>
                <th>Estado</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(parte, index) in partes" :key="index">
                <td># @{{index}}</td>
                <td>@{{ parte.nombre }}</td>
                <td>@{{ parte.descripcion }}</td>
                <td v-html="parte.icono"></td>
                <td>@{{ parte.estado }}</td>
                <td>
                    <button class="btn btn-danger btn-xs">Eliminar</button>
                </td>
                <td>
                    {{--<button class="btn btn-warning btn-xs" v-on:click="editParte(parte)">Editar</button>--}}
                    <button type="button" class="btn btn-warning btn-xs" v-on:click.prevent="editParte(parte)"
                            data-toggle="modal" data-target="#modalEditar">
                        Editar
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        {{--<table>--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>cantidad</th>--}}
                {{--<th>costo unitario</th>--}}
                {{--<th>total</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--<tr v-for="costeo in costeos">--}}
                {{--<td><input type="text" v-model="costeo.cantidad" v-on:keyup="operar(costeo)"></td>--}}
                {{--<td><input type="text" v-model="costeo.cus" v-on:keyup="operar(costeo)"></td>--}}
                {{--<td><input type="text" v-model="costeo.ts"></td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}

        <!-- Modal nuevo -->
        <div class="modal fade" id="modalPartes" tabindex="-1" role="dialog" aria-labelledby="modalPartes">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalPartes">Nueva parte de pc</h4>
                    </div>
                    <form class="form-horizontal" method="POST" v-on:submit.prevent="saveParte()">
                        <div class="modal-body">
                            <fieldset>
                                <div class="form-group">
                                    <label for="nombreParte" class="col-lg-2 control-label">Parte de pc</label>
                                    <div class="col-lg-10">
                                        <input type="text"
                                               class="form-control"
                                               id="nombreParte"
                                               name="nombreParte"
                                               v-model="partePc.nombre"
                                               placeholder="parte">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionParte" class="col-lg-2 control-label">Descripción</label>
                                    <div class="col-lg-10">
                                        <input type="text"
                                               class="form-control"
                                               id="descripcionParte"
                                               name="descripcionParte"
                                               v-model="partePc.descripcion"
                                               placeholder="descripcion">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iconoParte" class="col-lg-2 control-label">Icono</label>
                                    <div class="col-lg-10">
                                        <input type="text"
                                               class="form-control"
                                               id="iconoParte"
                                               name="iconoParte"
                                               v-model="partePc.icono"
                                               placeholder="icono">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="reset"
                                    class="btn btn-danger"
                                    data-dismiss="modal"
                                    v-on:click="clean()">Cerrar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editar -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalEditar">Modificar parte de pc</h4>
                    </div>
                    <form class="form-horizontal" method="POST"
                          v-on:submit.prevent="updateParte(partePc.codiParte)">
                        <div class="modal-body">
                            <fieldset>
                                <div class="form-group">
                                    <label for="nombreParte" class="col-lg-2 control-label">Parte de pc</label>
                                    <div class="col-lg-10">
                                        <input type="hidden" v-model="partePc.codiParte">
                                        <input type="text"
                                               class="form-control"
                                               id="nombreParte"
                                               name="nombreParte"
                                               v-model="partePc.nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionParte" class="col-lg-2 control-label">Descripción</label>
                                    <div class="col-lg-10">
                                        <input type="text"
                                               class="form-control"
                                               id="descripcionParte"
                                               name="descripcionParte"
                                               v-model="partePc.descripcion"
                                               placeholder="descripcion">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iconoParte" class="col-lg-2 control-label">Icono <span
                                                v-html="partePc.icono"></span></label>
                                    <div class="col-lg-10">
                                        <input type="text"
                                               class="form-control"
                                               id="iconoParte"
                                               name="iconoParte"
                                               v-model="partePc.icono"
                                               placeholder="icono">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-lg-2 control-label">Estado </label>
                                    <div class="col-lg-10">
                                        <select name="" id="" class="form-control">
                                            <option value="1">Activado</option>
                                            <option value="0">Desactivado</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="modal-footer">
                            <button type="reset"
                                    class="btn btn-danger"
                                    data-dismiss="modal"
                                    v-on:click="clean()">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/vue-partespc/crud.js') }}"></script>
@endsection