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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*USUARIOS*/
Route::get('/usuarios', 'UsuariosController@index')->name('user.index');
Route::get('/usuario/editar/{id}', 'UsuariosController@edit')->name('user.editar');
Route::post('/usuario/update', 'UsuariosController@update')->name('user.update');
Route::post('/usuario/create', 'UsuariosController@create')->name('user.create');
Route::get('/usuario/ver/{id}', 'UsuariosController@view')->name('user.view');
Route::post('/usuario/permisos', 'UsuariosController@permiso')->name('user.permiso');


/*OFICINAS*/
Route::get('/oficinas', 'OficinasController@index')->name('oficina.index');
Route::post('/oficinas/create', 'OficinasController@create')->name('oficina.create');
Route::post('/oficina/eliminar', 'OficinasController@destroy')->name('oficina.delete');
Route::post('/oficina/editar', 'OficinasController@update')->name('oficina.update');

/*TRAMITES*/
Route::get('/tramites', 'TramitesController@index')->name('tramite.index');
Route::post('/tramite/create', 'TramitesController@create')->name('tramite.create');
Route::post('/tramite/eliminar', 'TramitesController@destroy')->name('tramite.delete');
Route::post('/tramite/editar', 'TramitesController@update')->name('tramite.update');

/*CONFIG_OFICINAS*/
Route::get('/oficina/{id}', 'ConfigController@index')->name('config.index');
Route::post('/config/create', 'ConfigController@create')->name('config.create');
Route::post('/config/eliminar', 'ConfigController@destroy')->name('config.delete');
Route::post('/config/editar', 'ConfigController@update')->name('config.update');
Route::post('/config/buscar', 'ConfigController@search')->name('config.search');

/*TURNOS*/
Route::get('/', 'TurnosController@principal')->name('page');
Route::get('/turno', 'TurnosController@index')->name('turno.index');
Route::post('/turno/create', 'TurnosController@create')->name('turno.create');
Route::post('/turno/created', 'TurnosController@created')->name('turno.created');
Route::get('/turno/buscar', 'TurnosController@buscar')->name('turno.search');
Route::post('/turno/search', 'TurnosController@search')->name('turno.buscar');
Route::post('/turno/searchTurno', 'TurnosController@searchTurno')->name('turno.searchTurno');
Route::get('/turno/todos/{fecha?}', 'TurnosController@view')->name('turno.view')->middleware('auth');
Route::post('/turno/estado', 'TurnosController@status')->name('turno.status')->middleware('auth');

/*PAGE*/
Route::get('/seguir-legajo', 'TurnosController@seguimiento')->name('seg.index');


/*REPORTES*/
Route::get('/turno/download/{id}/{fecha}', 'PdfController@turno')->name('turno');