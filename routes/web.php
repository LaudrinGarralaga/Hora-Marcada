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
// Rotas Reservas
Route::resource('reservas', 'ReservaController');
Route::get('reservaspesq', 'ReservaController@pesq')
        ->name('reservas.pesq');
Route::post('reservasfiltros', 'ReservaController@filtros')
        ->name('reservas.filtros');
Route::get('/', 'HomeController@index');
//Rotas Permanentes
Route::resource('permanentes', 'PermanenteController');
Route::get('permanentespesq', 'PermanenteController@pesq')
        ->name('permanentes.pesq');
Route::post('permanentesfiltros', 'PermanenteController@filtros')
        ->name('permanentes.filtros');
Route::get('/', 'HomeController@index');
//Rotas Opcionais
Route::resource('opcionais', 'OpcionalController');
Route::get('opcionaispesq', 'OpcionalController@pesq')
        ->name('opcionais.pesq');
Route::post('opcioanisfiltros', 'OpcionalController@filtros')
        ->name('opcionais.filtros');
Route::get('/', 'HomeController@index');
//Rotas Clientes
Route::resource('clientes', 'ClienteController');
Route::get('clientespesq', 'ClienteController@pesq')
        ->name('clientes.pesq');
Route::post('clientesfiltros', 'ClienteController@filtros')
        ->name('clientes.filtros');
Route::get('/', 'HomeController@index');
//Rotas Convidados
Route::resource('convidados', 'ConvidadoController');
Route::get('convidadospesq', 'ConvidadoController@pesq')
        ->name('convidados.pesq');
Route::post('convidadosfiltros', 'ConvidadoController@filtros')
        ->name('convidados.filtros');
//Rotas Convites
Route::resource('convites', 'ConviteController');
Route::get('convitespesq', 'ConviteController@pesq')
        ->name('convites.pesq');
Route::post('convitesfiltros', 'ConviteController@filtros')
        ->name('convites.filtros');
//Rotas Horarios
Route::resource('horarios', 'HorarioController');
Route::get('horariospesq', 'HorarioController@pesq')
        ->name('horarios.pesq');
Route::post('horariosfiltros', 'HorarioController@filtros')
        ->name('horarios.filtros');
//Rotas Reservas_Opcionais
Route::resource('reservas_opcionais', 'Reserva_OpcionalController');
Route::get('reservas_opcionaispesq', 'Reserva_OpcionalController@pesq')
        ->name('reservas_opcionais.pesq');
Route::post('reservas_opcionaisfiltros', 'Reserva_OpcionalController@filtros')
        ->name('reservas_opcionais.filtros');
