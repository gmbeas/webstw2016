<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', 'HomeController@index');
Route::get('/arriendo', 'HomeController@indexArriendo');

Route::get('/textil', function () {
    return view('pages.ventas.textil');
});

Route::get('/lavanderia', function () {
    return view('pages.ventas.lavanderia');
});

Route::get('/contacto', function () {
    return view('pages.ventas.contacto');
});


/*
|--------------------------------------------------------------------------
| Controller Productos
|--------------------------------------------------------------------------
|
| Metodos para controller de productos
|
*/
Route::get('/ficha/{sku}/{nombre}', 'ProductoController@ficha');
Route::post('/addcarro', array('uses' => 'ProductoController@agregaCarro'));
Route::get('/carrito', 'ProductoController@verCarro');
Route::delete('/carrito/{id}', 'ProductoController@elimina');
Route::post('/disminuirproducto', array('uses' => 'ProductoController@disminuirproducto'));
Route::post('/incrementarproducto', array('uses' => 'ProductoController@incrementarproducto'));

Route::post('/disminuirproductoFicha', array('uses' => 'ProductoController@disminuirproductoFicha'));
Route::post('/incrementarproductoFicha', array('uses' => 'ProductoController@incrementarproductoFicha'));

Route::get('/arriendo/ficha/{sku}/{nombre}', 'ProductoController@fichaArriendo');
Route::post('/arriendo/addcarro', array('uses' => 'ProductoController@agregaCarroArriendo'));
Route::get('/arriendo/carrito', 'ProductoController@verCarroArriendo');
Route::delete('/arriendo/carrito/{id}', 'ProductoController@eliminaArriendo');
Route::post('/arriendo/disminuirproducto', array('uses' => 'ProductoController@disminuirproductoArriendo'));
Route::post('/arriendo/incrementarproducto', array('uses' => 'ProductoController@incrementarproductoArriendo'));

Route::get('/arriendo/combos', 'ProductoController@verCombox');
Route::get('/arriendo/detallecombo/{cbo}/{mod}/{inv}/{nombre}', 'ProductoController@detalleCombo');
Route::post('/arriendo/agregacombo', array('uses' => 'ProductoController@agregaComboArriendo'));
Route::post('/arriendo/carganuevocombo', array('uses' => 'ProductoController@cargaNuevoCombo'));

/*
|--------------------------------------------------------------------------
| Controller Clientes
|--------------------------------------------------------------------------
|
| Metodos para controller de clientes
|
*/
Route::get('/login', 'ClienteController@login');
Route::get('/logout', 'ClienteController@doLogout');

Route::post('/login', array('uses' => 'ClienteController@doLogin'));

Route::post('/getciudades', array('uses' => 'ClienteController@getCiudades'));
Route::post('/getcomunas', array('uses' => 'ClienteController@getComunas'));
Route::post('/nuevadireccion', array('uses' => 'ClienteController@addDireccion'));

Route::post('/validaregistro', array('uses' => 'ClienteController@validaRegistro'));

Route::get('/registro/{rut}', 'ClienteController@registroUsuario');
Route::get('/invitado', 'ClienteController@registroInvitado');
Route::post('/validainvitado', array('uses' => 'ClienteController@validaInvitado'));



/*
|--------------------------------------------------------------------------
| Controller Categorias
|--------------------------------------------------------------------------
|
| Metodos para controller de categorias
|
*/
Route::get('/categoria/{arbol}/{prfid}/{nombre}', 'CategoriaController@view');
Route::get('/categoria/buscador', 'CategoriaController@buscador');
Route::post('/traecategorias', array('uses' => 'CategoriaController@traecategorias'));
Route::post('/traeproductos', array('uses' => 'CategoriaController@traeproductos'));

Route::get('/arriendo/categoria/{arbol}/{prfid}/{nombre}', 'CategoriaController@viewArriendo');
Route::get('/arriendo/categoria/buscador', 'CategoriaController@buscadorArriendo');
Route::post('/arriendo/traecategorias', array('uses' => 'CategoriaController@traecategoriasArriendo'));
Route::post('/arriendo/traeproductos', array('uses' => 'CategoriaController@traeproductosArriendo'));


/*
|--------------------------------------------------------------------------
| Controller Compra
|--------------------------------------------------------------------------
|
| Metodos para controller de compras
|
*/
Route::get('/checkout/{invitado}', 'CompraController@index');
Route::post('/pago', array('uses' => 'CompraController@pago'));
Route::post('/cambiadespacho', array('uses' => 'CompraController@cambiaDespacho'));

Route::get('/arriendo/checkout', 'CompraController@indexArriendo');


Route::post('/respuesta', array('uses' => 'CompraController@respuesta'));
Route::post('/finaliza', array('uses' => 'CompraController@finaliza'));

/*
|--------------------------------------------------------------------------
| Controller Promocion
|--------------------------------------------------------------------------
|
| Metodos para controller de de promociones
|
*/

Route::get('/cybermonday', 'PromocionController@indexCiberMonday2016');