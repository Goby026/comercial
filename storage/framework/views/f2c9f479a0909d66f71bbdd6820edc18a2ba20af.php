<?php $__env->startSection('contenido'); ?>
	<div class="row">
		<div class="col-md-12">
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?php echo e(url('cotizaciones')); ?>">Cotizaciones</a>
					</li>
					<li class="breadcrumb-item active">
						Cotización
					</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php if(count($errors)>0): ?>
				<div class="alert alert-danger">
					<ul>
					<?php foreach($errors->all() as $error): ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="page-header">
					<h1>
						COTIZACIONES <small>Nuevo</small>
					</h1>
				</div>
			</div>
			<div class="col-md-2">
<?php /*				<center># Cotización</center>*/ ?>
				<?php if(isset($coti_continue)): ?>
<?php /*				<input type="text" disabled name="txtNumCoti" class="form-control" value="<?php echo e($coti_continue->numCoti); ?>" style="text-align: center;">*/ ?>
					<button class="btn btn-warning" type="button">
						# Cotización <span class="badge"><?php echo e($coti_continue->numCoti); ?></span>
					</button>
				<?php else: ?>
<?php /*				<input type="text" disabled name="txtNumCoti" class="form-control" value="<?php echo e($dataCotizacion->numCoti); ?>" style="text-align: center;">*/ ?>
					<button class="btn btn-warning" type="button">
						# Cotización <span class="badge"><?php echo e($coti_continue->numCoti); ?></span>
					</button>
				<?php endif; ?>
			</div>
		</div>

		<?php echo $__env->make('cotizaciones.costeo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div>

	<?php echo $__env->make('cotizaciones.modalRegistros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    //cargar con ajax el nombre completo de cliente
    $('#btn_buscar_dniRuc').on('click', function () {
        //registrar contacto
        datos = {
            txt_dniRuc: $('input[name=txt_cliente_ruc_dni]').val(),
        };

        $.ajax({
            type: 'GET',
			dataType: 'JSON',
            url: "<?php echo e(URL::to('getCliente')); ?>",
            data: datos,
            success: function (response) {
                if (response.codiClienJuri == 1){
                    $('input[name=txt_cliente]').val(response.nombreClienNatu);
                    $('input[name=txt_codiClien]').val(response.codiClien);
//                    console.log("natural");
				}else if (response.codiClienNatu == 1){
                    $('input[name=txt_cliente]').val(response.razonSocialClienJ);
                    $('input[name=txt_codiClien]').val(response.codiClien);
//                    console.log("juridico");
				}else{
                    $('input[name=txt_cliente]').val("");
				}
            },
            error: function(){
                $('input[name=txt_cliente]').val("");
			}
        });
    });

    //cargar con ajax el nombre completo de contacto
    $('#btn_getContacto').on('click', function () {
        //registrar contacto
        datos = {
            txt_atencion_ruc_dni: $('input[name=txt_atencion_ruc_dni]').val(),
        };

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: "<?php echo e(URL::to('getContacto')); ?>",
            data: datos,
            success: function (response) {
                console.log();
                $('input[name=txt_atencion]').val(response.nombreContacClien + " " + response.apePaterContacC + " " + response.apeMaterContacC);
                $('input[name=txt_codiContacClien]').val(response.codiContacClien);
            },
            error: function (error) {
                console.log(error.message)
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>