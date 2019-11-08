<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perú Data Consult</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <!-- Bootstrap 3.3.5 -->
  <?php /*<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">*/ ?>

  <?php /* Bootstrap 3.3.7 */ ?>
<?php /*  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">*/ ?>
    <link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
  <!-- Bootstrap Select CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/build.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('css/AdminLTE.min.css')); ?>">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <?php /* Autocomplete */ ?>
  <?php /*  <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">*/ ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('css/_all-skins.min.css')); ?>">
  <link rel="apple-touch-icon" href="<?php echo e(asset('img/favicon.png')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.png')); ?>">

  <?php /*estilos personalizados    */ ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">

  <?php /*  Animate CSS*/ ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

  <?php /*  Chart JS - css */ ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />

  <!-- jQuery 2.1.4 -->
  <script src="<?php echo e(asset('js/jQuery-2.1.4.min.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('js/app.min.js')); ?>"></script>

<?php /*  <script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>*/ ?>

  <!-- Latest compiled and minified JavaScript Bootstrap select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

  <!-- tinymce WYSIWYG -->
  <script src="<?php echo e(URL::to('js/vendor/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>

<?php /*  <script src="https://cdn.jsdelivr.net/npm/tinymce-vue@1.0.0/dist/tinymce-vue.min.js"></script>*/ ?>

<?php /*  Froala wysiwyg*/ ?>
<?php /*  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/js/froala_editor.pkgd.min.js"></script>*/ ?>
<?php /*  <script src="https://cdn.jsdelivr.net/npm/vue-froala-wysiwyg@3.0.5/dist/vue-froala.min.js"></script>*/ ?>

  <script src="<?php echo e(asset('js/jquery.quicksearch.js')); ?>"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <?php /*Vuejs*/ ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
  <?php /*Vue router*/ ?>
<?php /*  <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>*/ ?>

  <?php /*Axios*/ ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

  <?php /*  Sweet alert*/ ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <?php /* Vue autocomplete */ ?>
<?php /*  <script src="https://unpkg.com/@trevoreyre/autocomplete-vue"></script>*/ ?>

<?php /*  Chart js*/ ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">

     <header class="main-header">

       <!-- Logo -->
       <a href="http://www.perudataconsult.net/" target="_blank" class="logo">
         <!-- logo -->
         <img src="<?php echo e(asset('img/logo.png')); ?>" style="width: 100%; padding: 5px;" class="logo">

       </a>

       <!-- Header Navbar: style can be found in header.less -->
       <nav class="navbar navbar-static-top" role="navigation">
         <!-- Sidebar toggle button-->
         <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
           <span class="sr-only">Navegación</span>
         </a>
         <!-- Navbar Right Menu -->
         <div class="navbar-custom-menu">
           <ul class="nav navbar-nav">
             <!-- Messages: style can be found in dropdown.less-->

             <!-- User Account: style can be found in dropdown.less -->
             <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <small class="bg-red">Online</small>
                 <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                 <input type="hidden" name="txtCola" value="<?php echo e(Auth::user()->codiCola); ?>">
               </a>
               <ul class="dropdown-menu">
                 <!-- User image -->
                 <li class="user-header">
                   <p>
                     www.perudataconsult.net - Desarrollando Software
                     <small>Huancayo - Perú</small>
                   </p>
                 </li>

                 <!-- Menu Footer-->
                 <li class="user-footer">

                   <div class="pull-right">
                     <a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat">Cerrar</a>
                   </div>
                 </li>
               </ul>
             </li>

           </ul>
         </div>

       </nav>
     </header>
     <!-- Left side column. contains the logo and sidebar -->
     <aside class="main-sidebar">
       <!-- sidebar: style can be found in sidebar.less -->
       <section class="sidebar">
         <!-- Sidebar user panel -->

         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">
           <li class="header"></li>

           <?php if(Auth::user()->codiCargo == '1'): ?>
             <?php echo $__env->make('layouts.shared.menu-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php elseif( Auth::user()->codiCargo == '3' ||
           Auth::user()->codiCargo == '6' ||
           Auth::user()->codiCargo == '7' ||
           Auth::user()->codiCargo == '8' ||
           Auth::user()->codiCargo == '9' ||
           Auth::user()->codiCargo == '10' ||
           Auth::user()->codiCargo == '13' ||
           Auth::user()->codiCargo == '15' ||
           Auth::user()->codiCargo == '16' ||
           Auth::user()->codiCargo == '35' ||
           Auth::user()->codiCargo == '30' ||
           Auth::user()->codiCargo == '31' ||
           Auth::user()->codiCargo == '37'): ?>
             <?php echo $__env->make('layouts.shared.menu-ejecutives', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php elseif( Auth::user()->codiCargo == '21' ||
           Auth::user()->codiCargo == '22' ||
           Auth::user()->codiCargo == '23' ||
           Auth::user()->codiCargo == '27' ||
           Auth::user()->codiCargo == '28' ||
           Auth::user()->codiCargo == '29' ||
           Auth::user()->codiCargo == '36'): ?>
             <?php echo $__env->make('layouts.shared.menu-gastos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php endif; ?>

         </ul>
       </section>
       <!-- /.sidebar -->
     </aside>

     <!--Contenido-->
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper" style="background-color: lightgray;">
       <!-- Main content -->
       <section class="content">
         <div class="row">
           <div class="col-md-12">
             <div class="box" style="background-color: mintcream;">
               <div class="box-header with-border">
                 <!-- <h3 class="box-title">Sistema de Ventas</h3> -->
                 <div class="box-tools pull-right">
                   <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                   <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col-md-12">
                     <!--Contenido-->
                   <?php echo $__env->yieldContent('contenido'); ?>
                   <!--Fin Contenido-->
                   </div>
                 </div>
               </div>
             </div><!-- /.row -->
           </div><!-- /.box-body -->
         </div><!-- /.box -->
       </section><!-- /.content -->
     </div><!-- /.content-wrapper -->
   </div><!-- /.row -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.0.1
  </div>
  <strong>Copyright &copy; 2018-2020 <a href="www.perudataconsult.net">Perú Data Consult</a>.</strong> All rights reserved.
</footer>
   <script> window.Laravel = { csrfToken: '<?php echo e(csrf_token()); ?>' } </script>
</body>
</html>
