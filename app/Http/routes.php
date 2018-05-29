<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::post('addCli','ClienteController@addCli');


//hacemos un grupo de rutas de recursos con peticiones index, create, show, edit, store, update, destroy
Route::resource('tiposClientes','TipoClienteController');
Route::resource('tipoClientesJuridicos','TipoClienteJuridicoController');
Route::resource('clientes','ClienteController');
Route::resource('clientesJuridicos','ClienteJuridicoController');
Route::resource('clientesNaturales','ClienteNaturalController');
Route::resource('sedesJuridicos','SedeJuridicoController');
//Route::resource('buscarCotizaciones','BuscarCotizacionController');
Route::get('/cotizaciones/search','CotizacionController@busqueda');
Route::get('/cotizaciones/cotiCola','CotizacionController@verCoti');
Route::get('/cotizaciones/detalleCoti/{id}','CotizacionController@detalleCoti');

Route::resource('cotizaciones','CotizacionController');
Route::resource('precioProductoProveedor','PrecioProductoProveedorController');
Route::resource('nuevaCotizacion','CosteoItemController');
Route::resource('marcaProducto','MarcaProductoController');
Route::resource('proveedores','ProveedorController');
Route::resource('cargoContactos','CargoContactoController');
Route::resource('proveedorContacto','ProveedorContactoController');
Route::resource('productosProveedor','ProductoProveedorController');
Route::resource('colaboradores','ColaboradorController');
Route::resource('igv','IgvController');
Route::resource('dolarProveedor','DolarProveedorController');
Route::resource('dolar','DolarController');
Route::resource('costeoEstados','CosteoEstadoController');
Route::resource('cotizacionEstados','CotizacionEstadoController');
Route::resource('condicionesComerciales','CondicionesComercialesController');
Route::resource('contactosCliente','ContactoClienteController');
Route::resource('familias','FamiliaController');
Route::resource('subFamilias','SubFamiliaController');

Route::resource('cartaPresentacion','CartaPresentacionController');
Route::get('pdf', 'CartaPresentacionController@getPdf');//ruta para abrir el pdf de modelo de carta

Route::resource('tipoCartaPresen','TipoCartaPresenController');

Route::resource('excel','ExcelController');

//gestion de accesos
Route::auth();

Route::get('/home', 'HomeController@index');
