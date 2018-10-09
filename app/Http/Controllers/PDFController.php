<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Horario;
use App\Opcional;
use App\Quadra;
use App\Reserva;
use App\Local;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $usuario = Auth::id();
        
        // Recupera todos os clientes do banco
        $locais = DB::table('local')->where('user_id', '=', $usuario)->get();
        $pdf = PDF::loadView('pdf.clientes', ['customers' => $customers], ['data' => $data, 'hora' => $hora, 'locais' => $locais]);
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
        $usuario = Auth::id();
        
        // Recupera todos os locais do do usuário logado
        $locais = DB::table('local')->where('user_id', '=', $usuario)->get();
       
        $pdf = PDF::loadView('pdf.horarios', ['customers' => $customers], ['data' => $data, 'hora' => $hora, 'locais' => $locais]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(500, 15, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
      
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
