<?php $__env->startSection('contenido'); ?>
    <style>
        .btn_menu {
            height: 120px;
            width: 200px;
            align-items: center;
        }

        .btn_menu a {

        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>
                        MÓDULO COMERCIAL <small>COTIZACIONES POR COLABORADOR</small>
                    </h1>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4 cotis">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row" id="colaboradores">
            <div v-for="colaborador in colaboradores">
                <label for="">{{ colaborador.nombreCola }}</label><span class="pull-right">{{ colaborador.cantiCoti }}</span>

                <div class="progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                         v-bind:style="{width: colaborador.cantiCoti + '%'}">
                        <span class="sr-only">20% Complete</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <canvas id="myChart" width="300" height="300"></canvas>
    </div>

    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>