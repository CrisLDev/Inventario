<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@welcome');

Auth::routes();

Route::resource('/items', 'ItemController');

Route::resource('/posts', 'PostController');

Route::resource('/categorias', 'IcategoriaController');

Route::resource('/comentarios', 'PcomentarioController');

Route::post('/posts/{id}/comentarios', 'PcomentarioController@crear')->name('comentarios.crear');

/*Route::get('/getgi', function(){
    $hola = Request::all();
    return dd(Response::json($request));
});*/

Route::get('/ver', 'ItemController@index');

Route::get('/items', 'ItemController@vista');

Route::post('/hola', 'ItemController@editar')->name('items.editar');

Route::post('/hola2', 'ItemController@crearr')->name('items.crearr');

Route::post('/eliminar', 'ItemController@eliminar')->name('items.eliminar');

Route::get('/home', 'HomeController@index')->name('home');
