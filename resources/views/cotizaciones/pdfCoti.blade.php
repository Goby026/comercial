<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <style>
  *{
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 10;
  }

  .banner{
    margin-top: -40px;
  }

  .cabecera{
    background-color: #910909;
    color: #FFFFFF;
    text-align: center;
  }

  .desc_prod p{
    margin: 0;
    padding: 0;
  }

  .fecha{
    text-align: right;
  }

  .row{
    width:100%;
  }

.tbl_productos{
  border: solid 1px;
}

</style>
<div class="container">
  <div class="row">
    <div class="banner">
      <center><img src="../public/img/SinFondo1.png" style="width: 100%; height: 90px;"></center>
    </div>
    <!-- fecha -->
    <div class="row">
      <div class="fecha"><b> Huancayo, {{ date('d') }} de {{ date('m') }} del {{ date('Y') }}</b></div>
    </div>
    <div class="row">
      <table>
        <tr>
          <td><strong>Señores</strong></td>
          <td width=30>&nbsp;</td>
          <td>: 
            @if(isset($_cliente->codiClienNatu))
              {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
            @else
              {{ $_cliente->razonSocialClienJ }}
            @endif
          </td>
        </tr>
        <tr>
          <td><strong>Atención</strong></td>
          <td width=30>&nbsp;</td>
          <td>: 
            @if(isset($contactoCliente->codiContacClien))
              {{ $contactoCliente->nombreContacClien }} {{ $contactoCliente->apePaterContacC }} {{ $contactoCliente->apeMaterContacC }}
            @else
              {{ $_cliente->nombreClienNatu }} {{ $_cliente->apePaterClienN }} {{ $_cliente->apeMaterClienN }}
            @endif
          </td>
        </tr>
        <tr>
          <td><strong>Asunto</strong></td>
          <td width=30>&nbsp;</td>
          <td>: 
            {{ $cotizacion->asuntoCoti }}
          </td>
        </tr>
      </table>
    </div>
    <div class="row">
      <p>Por la presente le hacemos llegar nuestra propuesta TÉCNICO - ECONÓMICA del {{ 'servicio | producto'  }} solicitado:</p>
    </div>
    <div class="row">
      <table class="tbl_productos">
        <thead>
          <tr class="cabecera">
            <th>CANT</th>
            <th width=385>PRODUCTO</th>
            <th width=60>UNIDAD</th>
            <th width=60>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto)
            <tr>
              <td style="text-align: center;">{{ $producto->cantiCoti }}</td>
              <td class="desc_prod">
                {{ $producto->itemCosteo }}
              </td>
              <td style="text-align: center;">{{ $producto->costoUniSolesIgv }}</td>
              <td style="text-align: center;">{{ $producto->costoTotalSolesIgv }}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>{!! $producto->descCosteoItem !!}</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div><br>
    <div class="row">
      <b><u>CONDICIONES COMERCIALES</u></b>
      <ul>
        @foreach($condicionesCom as $cond)
        <li>{{ $cond->descripCondiComer }}</li>
        @endforeach
      </ul>
    </div>
    <div class="row">
      firma
    </div>
    <footer>
      <img src="{{ public_path('img/SinFondo3.png') }}" style="width: 100%; height: 90px;" alt="">
    </footer>
  </div>
</div>
</body>
</html>