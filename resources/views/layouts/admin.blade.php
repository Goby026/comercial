<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perú Data Consult</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Bootstrap Select CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('css/build.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
     <link rel="apple-touch-icon" href="{{asset('img/favicon.png')}}">
     <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

{{--estilos personalizados    --}}
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
  @stack('scripts')
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/app.min.js')}}"></script>

  <script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>

  <!-- Latest compiled and minified JavaScript Bootstrap select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

  <!-- tinymce WYSIWYG -->
  <script src="{{ URL::to('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>

  <script src="{{ asset('js/jquery.quicksearch.js') }}"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  {{--Vuejs--}}
  {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>--}}
  {{--Axios--}}
  {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>--}}

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">

     <header class="main-header">

       <!-- Logo -->
       <a href="http://www.perudataconsult.net/" target="_blank" class="logo">
         <!-- logo -->
         <img src="{{asset('img/logo.png')}}" style="width: 100%; padding: 5px;" class="logo">

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
                 <span class="hidden-xs">{{ Auth::user()->name }}</span>
                 <input type="hidden" name="txtCola" value="{{ Auth::user()->codiCola }}">
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
                     <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar</a>
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

           @if(Auth::user()->codiCargo == '1')
             @include('layouts.shared.menu-admin')
           @elseif( Auth::user()->codiCargo == '3' ||
           Auth::user()->codiCargo == '6' ||
           Auth::user()->codiCargo == '7' ||
           Auth::user()->codiCargo == '8' ||
           Auth::user()->codiCargo == '9' ||
           Auth::user()->codiCargo == '35' ||
           Auth::user()->codiCargo == '30' ||
           Auth::user()->codiCargo == '31')
             @include('layouts.shared.menu-ejecutives')
           @elseif( Auth::user()->codiCargo == '21' ||
           Auth::user()->codiCargo == '22' ||
           Auth::user()->codiCargo == '23' ||
           Auth::user()->codiCargo == '27' ||
           Auth::user()->codiCargo == '28' ||
           Auth::user()->codiCargo == '29' ||
           Auth::user()->codiCargo == '36')
             @include('layouts.shared.menu-gastos')
           @endif

         </ul>
       </section>
       <!-- /.sidebar -->
     </aside>


     <!--Contenido-->
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">

       <!-- Main content -->
       <section class="content">

         <div class="row">
           <div class="col-md-12">
             <div class="box">
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
                   @yield('contenido')
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
    <b>Version</b> 0.0.1
  </div>
  <strong>Copyright &copy; 2018-2020 <a href="www.perudataconsult.net">Perú Data Consult</a>.</strong> All rights reserved.
</footer>

<script>
  // $( document ).ready(function() {
  //   $(".treeview-menu li").on("click", function(){
  //     $(".treeview-menu").find(".activa").removeClass("activa");
  //     $(this).addClass("activa");
  //     // alert("hiciste clic");
  //   });
  // });

  $(document).ready(function(){
    var cambio = false;
    $('.treeview-menu li a').each(function(index) {
      if(this.href.trim() == window.location){
        $(this).parent().addClass("active");
        cambio = true;
      }
    });
    if(!cambio){
      $('.treeview-menu li:first').addClass("active");
    }
  });

</script>

</body>
</html>