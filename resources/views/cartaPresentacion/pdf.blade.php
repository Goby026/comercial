<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Document</title>
</head>
<body>
  <style>
  *{
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 11px;
  }
  .banner{
    margin-top: -30px;
  }
  body{
    margin: 0 auto;
    width: 82%;
  }
  .fecha{
    text-align: right;
    margin-top: -10px;
  }
  p{
    text-align: justify;
  }
  .catalogo{
    margin: 0 auto;
    width: 100%;
  }
  .container{
    margin-top: -10px;
  }
  .firmas{
    /*border:1px solid;*/
    height: 66px;
    margin-top: -20px;
    overflow: hidden;
  }

  .firma{
    float: left;
    margin: 5px 20px 5px 30px;
    width: 50%;
  }
  .row{
    width: 100%;
  }

  /*contenedor de productos y servicios*/
  .prodServ{
    background-color: #E0E0E0;
    height: 230px;
    overflow: hidden;
    width: 99%;
  }

  .pro_serv{
    /*border: 1px solid;*/
    width: 50%;
    float: left;
  }

  .pro_serv li{
    /*border: 1px solid;*/
    margin: 10px 5px 10px 10px;
    height: 25px;
    list-style: none;
  }

  footer{
    margin-top: 160px !important;
  }
    
</style>
<div class="container">
  <div class="row">
    <div class="row">
      <center><img src="../public/img/SinFondo1.png" style="width: 120%; height: 90px;" class="banner"></center>
    </div>
    <div class="row">
      <!-- fecha -->
      <div class="col-md-12">
        <div class="fecha">
          <b>
            @if($contrato->codiEmpre == 2)
              Lima
            @else
              Huancayo
            @endif
            , {{ date('d') }} de </b>
          @if (date('m') == 1)
            <b>Enero</b>
          @elseif (date('m') == 2)
            <b>Febrero</b>
          @elseif (date('m') == 3)
            <b>Marzo</b>
          @elseif (date('m') == 4)
            <b>Abril</b>
          @elseif (date('m') == 5)
            <b>Mayo</b>
          @elseif (date('m') == 6)
            <b>Junio</b>
          @elseif (date('m') == 7)
            <b>Julio</b>
          @elseif (date('m') == 8)
            <b>Agosto</b>
          @elseif (date('m') == 9)
            <b>Setiembre</b>
          @elseif (date('m') == 10)
            <b>Octubre</b>
          @elseif (date('m') == 11)
            <b>Noviembre</b>
          @elseif (date('m') == 12)
            <b>Diciembre</b>
          @endif

          <b> del {{ date('Y') }}</b>
        </div>
      </div>
    </div>
    <div class="row">
      <table>
        @if($cotizacion->nomContac != '')
          <tr>
            <td><strong>Señores : </strong></td>
            <td>{{ $cotizacion->nomContac }}</td>
          </tr>
        @endif
        <tr>
          <td></td>
          <td><strong>{{ $cotizacion->nomCli }} </strong></td>
        </tr>
      </table>
    </div>
    <div class="row">
      <div class="cont_header">
        <p>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El motivo de la presente, es para hacerle llegar un cordial saludo y, a la vez, presentarle nuestra empresa <b>PERU DATA CONSULT E.I.R.L</b> con mas de 10 años de experiencia, dedicados a la distribución e implementación de equipos y servicios informáticos, ofreciendo las mejores marcas del mercado. <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuestro objetivo es brindar las mejores soluciones en Tecnologías de la Información. Estamos convencidos de la competitividad de nuestros precios, ademas contamos con el mejor equipo de profesionales capacitados que le brindarán el soporte, orientación y asesoría técnica sobre los productos de nuestro portafolio.<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asimismo, trabajamos desde el año 2012 con los catálogos electrónicos de <b>CONVENIO MARCO</b>, ahora <b>PERÚ COMPRAS</b>, como adjudicatarios en los siguientes catálogos:
          <ul>
            <li>Impresoras y suministros</li>
            <li>Computadoras, portátiles, proyectores y scanner</li>
            <li>Útiles de escritorio y Oficina</li>
          </ul>
        </p>
        <p>Además, ofrecemos los siguientes productos y servicios:</p>
      </div>
    </div>
    <div class="row">
      <div class="prodServ">
        <div class="pro_serv">
          <center><b>Productos</b></center>          
          @foreach ($prodCartas as $prodCarta)
          <li>{{ $prodCarta->descripcion }}</li>
          @endforeach
        </div>

        <div class="pro_serv">
          <center><b>Servicios</b></center>          
          @foreach ($servCartas as $servCartas)
          <li>{{ $servCartas->descripcion }}</li>
          @endforeach
        </div>
      </div>
    </div>    
    <div class="row">
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuestra filosofía de mejora contínua y responsabilidad social, nos han permitido ampliar nuestra cobertura, razón por la cual sería un privilegio para nosotros poder formar parte de su lista de proveedores. Para cotizaciones o información adicional que requieran, ponemos a su disposición a nuestros representantes.
      </p>
    </div>    
    <div class="row">
      <div class="firmas">
        <div class="firma">
          <p>
            <b>Lucia Vila Lagos</b><br>
            Movil: 998890321 <br>
            lucia.vila@perudatasontult.net
          </p>          
        </div>
        <div class="firma">
          <p>
            <b>{{ $colaborador->nombreCola }} {{ $colaborador->apePaterCola }} {{ $colaborador->apeMaterCola }}</b><br>
            Movil: {{ $colaborador->celuCorpoCola }} <br>
            {{ $colaborador->correoCorpoCola }}
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <p>
        Sin otro en particular y agradecimiento su gentil atención. Quedamos a la espera de sus gratas órdenes.
      </p>
      <p>Atte.</p>
    </div>
    <footer>
      <center><img src="../public/img/SinFondo3.png" style="width: 120%; height: 90px;"></center>
    </footer>
  </div>
</div>
</body>
</html>