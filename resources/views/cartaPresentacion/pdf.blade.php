<html>
<head>
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #EF6F6F;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    .logo{
      width: 20%;
    }
  </style>
<body>
  <header>
    <h1>Cabecera de mi documento</h1>
    <h2>DesarrolloWeb.com</h2>
    <img src="img/logo.png" class="logo">
  </header>
  <section>
    <p>{{ $datos }}</p>
  </section>
  <section>
    <h3>
      {{ $datos2 }}
    </h3>
  </section>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Desarrolloweb.com
            </p>
        </td>
        <td>
          <p class="page">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut maxime iste, vero hic quae. Est omnis quod similique. Repellat molestiae nemo ex, porro sint at praesentium! Enim sapiente iure, hic.
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
    <p>
      Lorem ipsum dolor sit...
    </p><p>
    Vestibulum pharetra fermentum fringilla...
    </p>
    <p style="page-break-before: always;">
    Podemos romper la página en cualquier momento...</p>
    </p><p>
    Praesent pharetra enim sit amet...
    </p>
  </div>
</body>
</html>