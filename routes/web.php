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


/*
|--------------------------------------------------------------------------
| Controller Compra
|--------------------------------------------------------------------------
|
| Metodos para controller de compras
|
*/
Route::get('/checkout', 'CompraController@index');