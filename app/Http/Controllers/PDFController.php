<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Horario;
use App\Opcional;
use App\Quadra;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class PDFController extends Controller
{

    public function index()
    {
        return view('outros.escolhe_relatorios');
    }

    public function getPDFClientes()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('d/m/Y h:i');
        $splitName = explode(' ', $data, 2);
        $data = $splitName[0];
        $hora = !empty($splitName[1]) ? $splitName[1] : '';
        
        // Recupera todos os clientes do banco
        $customers = Cliente::all();
        $pdf = PDF::loadView('pdf.clientes', ['customers' => $customers], ['data' => $data, 'hora' => $hora]);
        //dd($customers);
        return $pdf->download('Lista de clientes.pdf');
    }

    public function getPDFHorarios()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('d/m/Y h:i');
        $splitName = explode(' ', $data, 2);
        $data = $splitName[0];
        $hora = !empty($splitName[1]) ? $splitName[1] : '';

        // Recupera todos os horarios do banco
        $customers = Horario::all();
        $pdf = PDF::loadView('pdf.horarios', ['customers' => $customers], ['data' => $data, 'hora' => $hora]);
        return $pdf->download('Lista de horarios.pdf');
    }

    public function getPDFOpcionais()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('d/m/Y h:i');
        $splitName = explode(' ', $data, 2);
        $data = $splitName[0];
        $hora = !empty($splitName[1]) ? $splitName[1] : '';

        // Recupera todos os opcionais do banco
        $customers = Opcional::all();
        $pdf = PDF::loadView('pdf.opcionais', ['customers' => $customers], ['data' => $data, 'hora' => $hora]);
        return $pdf->download('Lista de opcionais.pdf');
    }

    public function getPDFQuadras()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('d/m/Y h:i');
        $splitName = explode(' ', $data, 2);
        $data = $splitName[0];
        $hora = !empty($splitName[1]) ? $splitName[1] : '';

        // Recupera todos as quadras do banco
        $customers = Quadra::all();
        $pdf = PDF::loadView('pdf.quadras', ['customers' => $customers], ['data' => $data, 'hora' => $hora]);
        return $pdf->download('Lista de quadras.pdf');
    }

    public function getPDFReservas()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos as reservas do banco
        $customers = Reserva::all();
        $pdf = PDF::loadView('pdf.reservas', ['customers' => $customers]);
        return $pdf->download('Lista de reservas.pdf');
    }

}
