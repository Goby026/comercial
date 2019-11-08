<li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-building-o"></i> Inicio</a></li>
<li><a href="<?php echo e(url('cotizaciones')); ?>"><i class="fa fa-money"></i> Cotizaciones</a></li>
<?php /*<li><a href="<?php echo e(url('cotizaciones/cotiCola')); ?>"><i class="fa fa-th"></i> Cotizaciones por*/ ?>
        <?php /*colaborador</a></li>*/ ?>
<li><a href="<?php echo e(url('cotizacionFinal')); ?>"><i class="fa fa-circle-o"></i>Cierre de Cotizaciones</a></li>
<?php /*<li><a href="#"><i class="fa fa-file-text-o"></i> Pipeline</a></li>*/ ?>
<?php /*<li><a href="#"><i class="fa fa-file-text"></i> Forecast</a></li>*/ ?>
<?php if(Auth::user()->codiCargo == '6' || Auth::user()->codiCargo == '3'): ?>
        <li><a href="<?php echo e(url('utilidades')); ?>"><i class="fa fa-circle-o"></i>Reportes de Utilidad</a></li>
<?php endif; ?>
<li><a href="<?php echo e(url('cartaPresentacion')); ?>"><i class="fa fa-file-powerpoint-o"></i> Carta de presentación</a>
</li>
<li><a href="<?php echo e(url('tipoCartaPresen')); ?>"><i class="fa fa-cog"></i> Tipo de carta de
        presentación</a></li>
<li><a href="<?php echo e(url('condicionesComerciales')); ?>"><i class="fa fa-list"></i> Condiciones
        comerciales</a></li>