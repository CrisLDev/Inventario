<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get( '/', 'WelcomeController@welcome' );

Auth::routes();

Route::resource( '/categorias', 'IcategoriaController' );

Route::resource( '/comentarios', 'PcomentarioController' );

Route::post( '/posts/{id}/comentarios', 'PcomentarioController@crear' )->name( 'comentarios.crear' );

/*Rutas para Items*/

Route::get( '/items', 'ItemController@index' )->name( 'items.index' );

Route::post( '/items', 'ItemController@crear' )->name( 'items.crear' );

Route::get( '/items/ver', 'ItemController@ver' )->name( 'items.ver' );

Route::post( '/items/editar', 'ItemController@editar' )->name( 'items.editar' );

Route::post( '/items/eliminar', 'ItemController@eliminar' )->name( 'items.eliminar' );

Route::get( '/pdf', 'ItemController@export_pdf' )->name( 'items.export_pdf' );

Route::get( '/export', 'ItemController@export_exl' )->name( 'items.export_exl' );

/*Fin rutas para Items*/

Route::get( '/home', 'HomeController@index' )->name( 'home' );
