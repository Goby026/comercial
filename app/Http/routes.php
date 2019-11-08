<?php

//Route::get('/pruebas', [
//    'uses' => 'MercaderiaController@prueba',
//    'middleware' => 'cors'
//    ]);

Route::group(['middleware' => 'cors'], function () {
    Route::get('/pruebas', 'MercaderiaController@prueba');//PRUEBAS
    Route::get('/', function () {
        return view('auth/login');
    });

    Route::get('/cerrarCoti/{id}', 'CierreController@cerrarCoti');
    Route::get('/getCargos', 'CargoController@getCargos');
    Route::get('/getClienteCotizacion', 'ClienteController@getClienteCotizacion');
    Route::get('/getAsunto', 'CotizacionController@getAsunto');

    Route::post('/addCli', 'ClienteController@addCli');
    Route::post('/addEmpresaGasto', 'ProveedorController@addEmpresaGasto');
    Route::get('/getProveedor', 'ProveedorController@getProveedor');

    Route::post('/storeGastoCierre', 'CotiFinalGastoController@store');
    Route::post('/saveMercaderia', 'MercaderiaController@saveMercaderia');

    Route::post('/updateCosteo', 'CosteoController@updateCosteo');
    Route::get('/find_products', 'ProductoProveedorController@getByProvider');

    Route::get('/utilidades', 'UtilidadController@index');
    Route::post('/getUtilidades', 'UtilidadController@getUtilidades');

//hacemos un grupo de rutas de recursos con peticiones index, create, show, edit, store, update, destroy
    Route::resource('/tiposClientes', 'TipoClienteController');
    Route::resource('/tipoClientesJuridicos', 'TipoClienteJuridicoController');
    Route::resource('/clientes', 'ClienteController');
    Route::get('/getCliente', 'ClienteController@getCliente');

    Route::resource('/clientesJuridicos', 'ClienteJuridicoController');
    Route::resource('/clientesNaturales', 'ClienteNaturalController');
    Route::resource('/sedesJuridicos', 'SedeJuridicoController');
//Route::resource('buscarCotizaciones','BuscarCotizacionController');

    //DETALLES DE GASTOS
    Route::get('/getDetalleGasto/{id}', 'DetalleGastoController@getDetalleGasto');
    Route::post('/addDetalleGasto', 'DetalleGastoController@store');
    Route::get('/setGastos/{id}', 'DetalleGastoController@setGastos');

    Route::post('/addItemCosteo', 'CierreController@addItemCosteo');
    Route::post('/delItemCosteo', 'CierreController@delItemCosteo');
    Route::post('/getUtilidades', 'UtilidadController@getUtilidades');

//Route::get('getMercaderia/{id}','CierreController@getMercaderia');
    Route::resource('/cotizacionFinal', 'CotizacionFinalController');
    Route::get('/getMerca/{id}', 'CotizacionFinalController@edit');
    Route::get('/getCotisCerradas', 'CotizacionFinalController@getCotisCerradas');
    Route::resource('/gastos', 'CotiFinalGastoController');
    Route::get('/getGastos', 'CotiFinalGastoController@getGastos');

    //COTIZACION
    Route::get('/cotizacion/{id}', 'CotizacionController@getCotizacion');
    Route::get('/getCoti/{id}', 'CotizacionController@getCotizacionById');
    Route::post('/updateCotizacion/{id}', 'CotizacionController@updateCotizacion');
    Route::put('/cotidolarigv', 'CotizacionController@update');
    Route::get('/cotizaciones/search', 'CotizacionController@busqueda');
    Route::post("/cotizaciones/reutilizar", 'CotizacionController@reutilizar');//Reutilizar
    Route::get('/cotizaciones/buscarCliente/{codiCoti}', 'CotizacionController@buscarCliente');
    Route::get('/continuar/{id}', 'CotizacionController@continuar');
    Route::get('/find_by_cola/{codiCoti}', 'CotizacionController@find_by_cola');
    Route::get('/find_params', 'CotizacionController@find_by_params');

    Route::get('/pdfCoti/{id}/{opc}', 'CotizacionController@getPdf');//ruta para abrir el pdf de cotizacion
    Route::get('/pdfCoti2/{id}', 'CotizacionController@getPdf2');//nuevo diseño de pdf

    Route::get('/getDataCoti/{id}','CotizacionController@getDataCoti');

    Route::get('/getContacto', 'ContactoClienteController@getContacto');
    Route::get('/cotizaciones/getContactos', 'ContactoClienteController@getContactos');

    Route::resource('/cotizaciones', 'CotizacionController');
    Route::resource('/precioProductoProveedor', 'PrecioProductoProveedorController');

    //COSTEO ITEM
    Route::resource('/costeoItem', 'CosteoItemController');
    Route::post('/addItem', 'CosteoItemController@addCosteoItem');//agregar costeoitem en la cotizacion
    Route::post('/updateDescCosteoItem', 'CosteoItemController@update');//agregar costeoitem en la cotizacion

    Route::post('/delCosteoItem/{id}', 'CosteoItemController@delCosteoItem');
    Route::get('/getProductoCoti', 'CosteoItemController@getProductoCoti');
    Route::get('/getItems/{id}', 'CosteoItemController@getItems');

    Route::resource('marcaProducto', 'MarcaProductoController');

    Route::get('/getMarca', 'MarcaProductoController@getMarca');
    Route::get('/getMarcas', 'MarcaProductoController@getMarcas');

    Route::resource('/proveedores', 'ProveedorController');
    Route::resource('/cargoContactos', 'CargoContactoController');
    Route::resource('/proveedorContacto', 'ProveedorContactoController');
    Route::resource('/productosProveedor', 'ProductoProveedorController');
    Route::resource('/colaboradores', 'ColaboradorController');
    Route::resource('/igv', 'IgvController');
    Route::resource('/dolarProveedor', 'DolarProveedorController');
    Route::resource('/dolar', 'DolarController');
    Route::resource('/costeoEstados', 'CosteoEstadoController');
    Route::resource('/cotizacionEstados', 'CotizacionEstadoController');
    Route::resource('/condicionesComerciales', 'CondicionesComercialesController');
    Route::get('/getCondiciones/{id}', 'CotiCondicionesController@getCondiciones');
    Route::post('/updateCondicion/{id}', 'CotiCondicionesController@updateCondicion');
    Route::post('/delCondicion/{id}', 'CotiCondicionesController@delCondicion');
    Route::post('/createCondicion', 'CotiCondicionesController@createCondicion');
    Route::post('/saveContacto', 'ContactoClienteController@saveContacto');

//    COTICOSTEO
    Route::post('/addCotiCosteo', 'CotiCosteoController@addCotiCosteo');

//    PARTES DE PC
    Route::resource('/partesPC', 'PartePcController');
    Route::get('/getPartes', 'PartePcController@getPartes');
    Route::post('/saveParte', 'PartePcController@saveParte');
    Route::post('/updateParte/{id}', 'PartePcController@updateParte');

//    ITEMPARTECONTROLLER
    Route::get('/getItemPartes/{id}','ItemParteController@getItemPartes');
    Route::post('/saveItemsPartes','ItemParteController@add');
    Route::post('/saveItemParte','ItemParteController@store');
    Route::get('/delItemParte/{id}','ItemParteController@delete');
    Route::post('/updateItemParte/{id}','ItemParteController@update');

    //COSTEO
    Route::post('/costeoUpdate','CosteoController@update');
//    Route::post('/updateProveedorId','CosteoController@updateProveedorId');
    Route::post('/storeCosteo','CosteoController@store');
    Route::post('/destroyCosteo/{id}','CosteoController@destroy');
    Route::get('/getCosteo/{id}','CosteoController@getCosteo');
    Route::get('/getData/{id}', 'CosteoController@getData');
    Route::get('/getCosteos/{id}', 'CosteoController@getCosteos');

    //REGISTRAR IMAGEN PC DE LA COTIZACION DE PC
    Route::post('/uploadFile','CosteoController@uploadFile');

    Route::resource('/contactosCliente', 'ContactoClienteController');
    Route::resource('/familias', 'FamiliaController');
    Route::resource('/subFamilias', 'SubFamiliaController');

    Route::resource('/cartaPresentacion', 'CartaPresentacionController');
    Route::get('/pdf', 'CartaPresentacionController@getPdf');//ruta para abrir el pdf de modelo de carta
    Route::get('/pdfCarta/{id}', 'CartaPresentacionController@getPresentacionPdf');

    Route::resource('/tipoCartaPresen', 'TipoCartaPresenController');
    Route::resource('/usersComercial', 'UserController');

    Route::resource('/excel', 'ExcelController');
    Route::get('/costeoExcel', 'ExcelController@costeoExcel');
    Route::post('/utilidadesExcel', 'ExcelController@utilidadesExcel');

    //GESTION DE ACCESOS
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/estadisticas', 'CotizacionController@estadisticas');
});
