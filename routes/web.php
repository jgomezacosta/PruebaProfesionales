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


// Ruta Página Principal
Route::get('/', function () {
    return view('welcome');
});
 
// Ruta Dashboard
Route::get('profesionales/index', 'ProfesionalesController@index')->name('profesionales.index');
 
// Rutas CRUD
/* Crear */
Route::get('profesionales/crear', 'ProfesionalesController@crear')->name('profesionales.crear');
Route::put('profesionales/store', 'ProfesionalesController@store')->name('profesionales.store');
 
/* Leer */
Route::get('profesionales', 'ProfesionalesController@index')->name('profesionales');
 
/* Actualizar */
Route::get('profesionales/actualizar/{id}', 'ProfesionalesController@actualizar')->name('profesionales.actualizar');
Route::put('profesionales/update/{id}', 'ProfesionalesController@update')->name('profesionales.update');
 
/* Eliminar */
Route::put('profesionales/eliminar/{id}', 'ProfesionalesController@eliminar')->name('profesionales.eliminar');