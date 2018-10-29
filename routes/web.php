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

Route::get('clientes/{id}', 'Clientes@controller@Deletar');

//Rotas Convites
Route::resource('convites', 'ConviteController');

//Rotas Horarios
Route::resource('horarios', 'HorarioController');

//Rotas Reservas_Opcionais
Route::resource('reservas_opcionais', 'Reserva_OpcionalController');

//Rotas Quadras
Route::resource('quadras', 'QuadraController');

Route::get('/getPDFClientes', 'PDFController@getPDFClientes');
Route::get('/getPDFHorarios', 'PDFController@getPDFHorarios');
Route::get('/getPDFQuadras', 'PDFController@getPDFQuadras');
Route::get('/getPDFOpcionais', 'PDFController@getPDFOpcionais');
Route::get('/getPDFReservas', 'PDFController@getPDFReservas');

Route::get('detalhes-reserva/{id}', 'HomeController@detalhesReservas')->name('detalhes.reserva');

Route::get('reservar-horario/{id}', 'HomeController@reservar')->name('reservar.horario');

Route::get('disponibilidade', 'HomeController@pesquisa');

Route::post('horarios-filtro', 'HomeController@filtro')->name('horarios.filtro');

Route::resource('relatorios', 'PDFController');
Route::resource('locais', 'LocalController');

Route::get('graficos-gerenciais', 'GraficoController@Graficos')
    ->name('graficos.graficos');

Route::post('formularios', 'PDFController@formularios')
    ->name('pdf.formularios');

Route::post('graficosfiltro', 'GraficoController@filtro')
    ->name('graficos.filtro');
