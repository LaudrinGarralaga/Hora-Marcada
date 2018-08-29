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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
// Rotas Reservas
Route::resource('reservas', 'ReservaController');

//Rotas Opcionais
Route::resource('opcionais', 'OpcionalController');

//Rotas Clientes
Route::resource('clientes', 'ClienteController');

//Rotas Convidados
Route::resource('convidados', 'ConvidadoController');

//Rotas Convites
Route::resource('convites', 'ConviteController');

//Rotas Horarios
Route::resource('horarios', 'HorarioController');

//Rotas Reservas_Opcionais
Route::resource('reservas_opcionais', 'Reserva_OpcionalController');

//Rotas Quadras
Route::resource('quadras', 'QuadraController');

