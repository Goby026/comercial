<?php

Route::get('/', function () {
    return view('auth/login');
});

Route::post('addCli','ClienteController@addCli');
Route::get('find_products','ProductoProveedorController@getByProvider');

//hacemos un grupo de rutas de recursos con peticiones index, create, show, edit, store, update, destroy
Route::resource('tiposClientes','TipoClienteController');
Route::resource('tipoClientesJuridicos','TipoClienteJuridicoController');
Route::resource('clientes','ClienteController');
Route::get('getCliente', 'ClienteController@getCliente');

Route::resource('clientesJuridicos','ClienteJuridicoController');
Route::resource('clientesNaturales','ClienteNaturalController');
Route::resource('sedesJuridicos','SedeJuridicoController');
//Route::resource('buscarCotizaciones','BuscarCotizacionController');

Route::post('/addItem','CotizacionController@addCosteoItem');
Route::get('/cotizacion/{id}','CotizacionController@getCotizacion');

Route::get('pruebas','CotizacionController@prueba');//PRUEBAS

Route::get('asistirCoti','CotizacionController@asistirCoti');

Route::get('/cotizaciones/search','CotizacionController@busqueda');
Route::get('/cotizaciones/cotiCola','CotizacionController@verCoti');
Route::get('/cotizaciones/detalleCoti/{id}','CotizacionController@detalleCoti');
Route::post("/cotizaciones/reutilizar/{id}",'CotizacionController@reutilizar');//Reutilizar

Route::get('/cotizaciones/buscarCliente', 'CotizacionController@buscarCliente');

Route::get('/continuar/{id}','CotizacionController@continuar');
Route::get('/find_by_cola/{codiCoti}','CotizacionController@find_by_cola');
Route::get('/find_params','CotizacionController@find_by_params');
Route::get('/pdfCoti/{id}', 'CotizacionController@getPdf');//ruta para abrir el pdf de cotizacion

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
Route::get('costeoExcel','ExcelController@costeoExcel');

//gestion de accesos
Route::auth();

Route::get('/home', 'HomeController@index');
