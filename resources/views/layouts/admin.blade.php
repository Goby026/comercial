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
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
     <link rel="apple-touch-icon" href="{{asset('img/favicon.png')}}">
     <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">  

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

  <style type="text/css">
    .current{
      background-color:#c97c0e;
    }

    /*.activa{
      background-color:lightblue;
    }*/
  </style>

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
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
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Artículos</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Categorías</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Cotizaciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('cotizaciones')}}"><i class="fa fa-circle-o"></i> Nueva Cotización</a></li>                
                <li><a href="{{url('cotizaciones/cotiCola')}}"><i class="fa fa-circle-o"></i> Cotizaciones por colaborador</a></li>                
                <li><a href="{{url('precioProductoProveedor')}}"><i class="fa fa-circle-o"></i> Precios</a></li>                
                <li><a href="{{url('proveedorContacto')}}"><i class="fa fa-circle-o"></i> Contacto Proveedor</a></li>
                <li><a href="{{url('cargoContactos')}}"><i class="fa fa-circle-o"></i> Cargo-Contactos</a></li>
                <li><a href="{{url('dolarProveedor')}}"><i class="fa fa-circle-o"></i> Dolar-proveedor</a></li>
                <li><a href="{{url('dolar')}}"><i class="fa fa-circle-o"></i> Tipo de cambio</a></li>
                <li><a href="{{url('cartaPresentacion')}}"><i class="fa fa-circle-o"></i> Carta de presentación</a></li>
                <li><a href="{{url('tipoCartaPresen')}}"><i class="fa fa-circle-o"></i> Tipo de carta de presentación</a></li>
                <li><a href="{{url('costeoEstados')}}"><i class="fa fa-circle-o"></i> Estados de costeo</a></li>
                <li><a href="{{url('cotizacionEstados')}}"><i class="fa fa-circle-o"></i> Estados de cotización</a></li>
                <li><a href="{{url('condicionesComerciales')}}"><i class="fa fa-circle-o"></i> Condiciones comerciales</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="{{url('clientes')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="{{url('clientesJuridicos')}}"><i class="fa fa-circle-o"></i> Clientes Jurídicos</a></li>
                <li><a href="{{url('clientesNaturales')}}"><i class="fa fa-circle-o"></i> Clientes Naturales</a></li>
                <li><a href="{{url('contactosCliente')}}"><i class="fa fa-circle-o"></i> Contactos</a></li>
                <li><a href="{{url('tipoClientesJuridicos')}}"><i class="fa fa-circle-o"></i> Tipos de Clientes Jurídicos</a></li>
                <li><a href="{{url('tiposClientes')}}"><i class="fa fa-circle-o"></i> Tipos de Clientes</a></li>
                <li><a href="{{url('proveedores')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="{{url('productosProveedor')}}"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="{{url('familias')}}"><i class="fa fa-circle-o"></i> Familias</a></li>
                <li><a href="{{url('subFamilias')}}"><i class="fa fa-circle-o"></i> Sub - Familias</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('colaboradores')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="{{url('marcaProducto')}}"><i class="fa fa-circle-o"></i> Marcas</a></li>
                <li><a href="{{url('igv')}}"><i class="fa fa-circle-o"></i> Igv</a></li>
              </ul>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">Manual</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
            
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
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
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