<div class="col-md-6" id="condicionesComerciales">
    <input type="hidden" name="codiCoti" value="<?php echo e($cotizacion); ?>">
    <div class="panel panel-danger panel-condiciones">
        <div class="panel-heading">
            <a href="#" class="pull-right" data-toggle="modal" data-target="#modalNuevo">
                <i class="fa fa-plus-square" style="font-size: 20px; color: lightcyan;"></i>
            </a>
            <h3 class="panel-title">TÉRMINOS COMERCIALES </h3>
        </div>
        <div class="panel-body">
            <?php /*<?php foreach($condicionesCom as $condicion): ?>*/ ?>
            <?php /*<input type="text" name="txt_<?php echo e($condicion->idTCotiCondiciones); ?>" class="form-control"*/ ?>
            <?php /*value="<?php echo e($condicion->descripcion); ?>">*/ ?>
            <?php /*<?php endforeach; ?>*/ ?>

            <table class="table table-bordered table-responsive table-striped">
                <tbody>
                <tr v-for="condicion in condiciones">
                    <?php /*<td>{{ condicion.codiCondiComer }}</td>*/ ?>
                    <td>{{ condicion.descripcion }}</td>
                    <td style="text-align: center;">
                        <?php /*boton eliminar*/ ?>
                        <?php /*<button type="button" class="btn btn-danger btn-xs" data-toggle="modal"*/ ?>
                                <?php /*data-target="#modalDelete">*/ ?>
                            <?php /*<i class="fa fa-trash"></i>*/ ?>
                        <?php /*</button>*/ ?>
                        <a class="btn btn-danger btn-xs"
                           v-on:click.prevent="deleteCondicion(condicion)"><i class="fa fa-trash"></i></a>
                    </td>

                    <td style="text-align: center;">
                        <?php /*boton editar*/ ?>
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
    <?php /*<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel">*/ ?>
        <?php /*<div class="modal-dialog" role="document">*/ ?>
            <?php /*<div class="modal-content">*/ ?>
                <?php /*<div class="modal-header">*/ ?>
                    <?php /*<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span*/ ?>
                                <?php /*aria-hidden="true">&times;</span></button>*/ ?>
                    <?php /*<h4 class="modal-title" id="modalDeleteLabel">Eliminar</h4>*/ ?>
                <?php /*</div>*/ ?>
                <?php /*<div class="modal-body">*/ ?>
                    <?php /*...*/ ?>
                <?php /*</div>*/ ?>
                <?php /*<div class="modal-footer">*/ ?>
                    <?php /*<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>*/ ?>
                    <?php /*<button type="button" class="btn btn-danger">Eliminar</button>*/ ?>
                <?php /*</div>*/ ?>
            <?php /*</div>*/ ?>
        <?php /*</div>*/ ?>
    <?php /*</div>*/ ?>

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
                            <?php /*<span v-for="error in errors" class="text-danger">{{ error }}</span>*/ ?>
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
                            <?php /*<span v-for="error in errors" class="text-danger">{{ error }}</span>*/ ?>
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

<script src="<?php echo e(asset('js/vue-condicionesComerciales/condicionesComerciales.js')); ?>"></script>
