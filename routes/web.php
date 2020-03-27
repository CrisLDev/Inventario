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

Route::redirect( '/', '/login');

Route::fallback(function(){
    return abort(404);
});

Auth::routes();

/*Fin rutas para Items*/

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::middleware(['auth'])->group(function(){

    /*Rutas para Items*/

    Route::get( '/items', 'ItemController@index' )->name( 'items.index' )->middleware('can:items.index');

    Route::get( '/items/create', 'ItemController@create' )->name( 'items.create' )->middleware('can:items.crear');

    Route::get( '/items/ver', 'ItemController@ver' )->name( 'items.ver' )->middleware('can:items.index');

    Route::post( '/items/store', 'ItemController@store' )->name( 'items.store' )->middleware('can:items.crear');

    Route::get( '/items/{id}/edit', 'ItemController@edit' )->name( 'items.edit' )->middleware('can:items.editar');

    Route::put( '/items/{item}', 'ItemController@update' )->name( 'items.update' )->middleware('can:items.editar');

    Route::delete( '/items/{item}', 'ItemController@destroy' )->name( 'items.destroy' )->middleware('can:items.eliminar');

    Route::get( '/pdf', 'ItemController@export_pdf' )->name( 'items.export_pdf' );

    Route::get( '/export', 'ItemController@export_exl' )->name( 'items.export_exl' );

    //Rutas para Curso
    Route::get( '/cursos', 'CursoController@index' )->name( 'cursos.index' )->middleware('can:cursos.index');

    Route::get( '/cursos/ver', 'CursoController@ver' )->name( 'cursos.ver' )->middleware('can:items.index');

    Route::get( '/cursos/create', 'CursoController@create' )->name( 'cursos.create' )->middleware('can:cursos.crear');

    Route::post( '/cursos/store', 'CursoController@store' )->name( 'cursos.store' )->middleware('can:cursos.crear');

    Route::get( '/cursos/{id}/edit', 'CursoController@edit' )->name( 'cursos.edit' )->middleware('can:cursos.editar');

    Route::put( '/cursos/{curso}', 'CursoController@update' )->name( 'cursos.update' )->middleware('can:cursos.editar');

    Route::delete( '/cursos/{curso}', 'CursoController@destroy' )->name( 'cursos.destroy' )->middleware('can:cursos.eliminar');

    //Rutas para Usuario
    Route::get( '/users', 'UserController@index' )->name( 'users.index' )->middleware('can:user.index');

    Route::get( '/users/ver', 'UserController@ver' )->name( 'users.ver' )->middleware('can:users.index');

    Route::get( '/users/create', 'UserController@create' )->name( 'users.create' )->middleware('can:users.crear');

    Route::post( '/users/store', 'UserController@store' )->name( 'users.store' )->middleware('can:users.crear');

    Route::get( '/users/{user}/edit', 'UserController@edit' )->name( 'users.edit' )->middleware('can:users.editar');

    Route::put( '/users/{user}', 'UserController@update' )->name( 'users.update' )->middleware('can:users.editar');

    Route::delete( '/users/{user}', 'UserController@destroy' )->name( 'users.destroy' )->middleware('can:users.eliminar');



    //Rutas para Rol
    Route::get( '/roles', 'RolController@index' )->name( 'roles.index' )->middleware('can:roles.index');

    Route::get( '/roles/{role}/edit', 'RolController@edit' )->name( 'roles.edit' )->middleware('can:roles.editar');

    Route::put( '/roles/{role}', 'RolController@update' )->name( 'roles.update' )->middleware('can:roles.editar');

    Route::delete( '/roles/{role}', 'RolController@destroy' )->name( 'roles.destroy' )->middleware('can:roles.eliminar');
});
