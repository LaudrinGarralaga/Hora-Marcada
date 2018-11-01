<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Horario;
use App\Opcional;
use App\Quadra;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{

    public function relatorioFinanceiro()
    {

        $quadras = Quadra::orderBy('tipo')->get();

        return view('outros.escolhe_relatorios', compact('quadras'));
    }

    public function getPDFFinanceiro(Request $request)
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

        $dataIni = $request->dataIni;
        $dataFin = $request->dataFin;
        $quadra = $request->quadra_id;

        $customers = DB::table('reservas') 
            ->join('quadras', 'quadra_id', '=', 'quadras.id')
            ->select('reservas.id', 'data', 'tipo', 'status', 'permanente', 'reservas.preco', 'quadra_id')
            ->where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->where('quadra_id', '=', $quadra)
            ->count();
        if($customers  == 0) {
            return redirect()->route('relatorios.financeiro')
            ->with('success', ' Sem reservas para o período informado!');
        } else {

            if($quadra == 0){

                $customers = DB::table('reservas')
                    ->join('quadras', 'quadra_id', '=', 'quadras.id')
                    ->select('reservas.id', 'data', 'tipo', 'status', 'permanente', 'reservas.preco', 'quadra_id')
                    ->where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->count();

                $quadras = DB::table('quadras')
                    ->select('tipo')
                    ->get();

                $total_preco = DB::table('reservas')
                    ->where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->sum('preco');

                $media = $total_preco / $customers;
            }else {

                $customers = DB::table('reservas')
                    ->join('quadras', 'quadra_id', '=', 'quadras.id')
                    ->select('reservas.id', 'data', 'tipo', 'status', 'permanente', 'reservas.preco', 'quadra_id')
                    ->where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->where('quadra_id', '=', $quadra)
                    ->count();

                $quadras = DB::table('quadras')
                    ->select('tipo')
                    ->where('id', '=', $quadra)
                    ->get();

                $total_preco = DB::table('reservas')
                    ->where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->where('quadra_id', '=', $quadra)
                    ->sum('preco');

                $media = $total_preco / $customers;
            }
        }   

        // Recupera todos os horarios do banco
        $usuario = Auth::id();

        // Recupera todos os locais do do usuário logado
        $locais = DB::table('local')->where('user_id', '=', $usuario)->get();

        $pdf = PDF::loadView('pdf.financeiro', ['customers' => $customers], ['media' => $media, 'quadras' => $quadras, 'total_preco' => $total_preco, 'data' => $data, 'dataIni' => $dataIni, 'dataFin' => $dataFin, 'hora' => $hora, 'locais' => $locais]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 15, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Relatório Financeiro.pdf');
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
