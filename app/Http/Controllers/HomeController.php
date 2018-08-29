<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Reserva;
use App\Horario;
use App\Opcional;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalReservas = Reserva::count();
        $totalHorarios = Horario::count();
        $totalOpcionais = Opcional::count();
        return view('home', compact('totalClientes', 'totalReservas', 'totalHorarios', 'totalOpcionais', 'reservas'));
    }
}
