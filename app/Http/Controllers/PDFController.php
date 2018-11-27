<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Permanente;
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

        if ($quadra == 0) {
            DB::insert(DB::raw("CREATE TEMPORARY TABLE reservastemp (data varchar(45), semana varchar(45), preco float)"));

            $r = Reserva::where('data', '>=', $dataIni)
                ->where('data', '<=', $dataFin)
                ->get();

            $p = Permanente::where('data', '>=', $dataIni)
                ->where('data', '<=', $dataFin)
                ->get();

            foreach ($r as $row) {
                DB::insert(DB::raw("INSERT INTO reservastemp (data, semana, preco) values (?, ?, ?)"),
                    array($row['data'], $row['semana'], $row['preco']));

            }

            foreach ($p as $row1) {
                DB::insert(DB::raw("INSERT INTO reservastemp (data, semana, preco) values (?, ?, ?)"),
                    array($row['data'], $row['semana'], $row['preco']));
            }

            $customers = DB::table('reservastemp')->count();

            if ($customers == 0) {
                return redirect()->route('relatorios.financeiro')
                    ->with('success', ' Sem reservas para o período informado!');
            } else {

                /*DB::insert(DB::raw("CREATE TEMPORARY TABLE reservasValor (valor float"));

                $r = Reserva::where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->get();

                $p = Permanente::where('data', '>=', $dataIni)
                    ->where('data', '<=', $dataFin)
                    ->get();

                foreach ($r as $row) {
                    DB::insert(DB::raw("INSERT INTO reservastemp (data, semana) values (?, ?)"),
                        array($row['data'], $row['semana']));

                }

                foreach ($p as $row1) {
                    DB::insert(DB::raw("INSERT INTO reservastemp (data, semana) values (?, ?)"),
                        array($row['data'], $row['semana']));
                }*/

                $quadras = DB::table('quadras')
                    ->select('tipo')
                    ->get();

                $total_preco = DB::table('reservastemp')
                    ->sum('preco');

                $media = $total_preco / $customers;
                
            }
        } else {
            DB::insert(DB::raw("CREATE TEMPORARY TABLE reservastemp (data varchar(45), semana varchar(45), preco float)"));

            $r = Reserva::where('data', '>=', $dataIni)
                ->where('data', '<=', $dataFin)
                ->where('quadra_id', '=', $quadra)
                ->get();

            $p = Permanente::where('data', '>=', $dataIni)
                ->where('data', '<=', $dataFin)
                ->where('quadra_id', '=', $quadra)
                ->get();

            foreach ($r as $row) {
                DB::insert(DB::raw("INSERT INTO reservastemp (data, semana, preco) values (?, ?, ?)"),
                    array($row['data'], $row['semana'], $row['preco']));

            }

            foreach ($p as $row1) {
                DB::insert(DB::raw("INSERT INTO reservastemp (data, semana, preco) values (?, ?, ?)"),
                    array($row['data'], $row['semana'], $row['preco']));
            }

            $customers = DB::table('reservastemp')->count();

            if ($customers == 0) {
                return redirect()->route('relatorios.financeiro')
                    ->with('success', ' Sem reservas para o período informado!');
            } else {
                $quadras = DB::table('quadras')
                    ->select('tipo')
                    ->where('id', '=', $quadra)
                    ->get();

                $total_preco = DB::table('reservastemp')
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

    public function relatorioReserva()
    {

        return view('outros.relatorio_reservas');
    }

    public function getPDFReserva(Request $request)
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $dataIni = $request->dataIni;
        $dataFin = $request->dataFin;

        $reservas = Reserva::select('data', 'semana', DB::raw('count(*) as total'), DB::raw('count(case when confirmado = 1 then 1 end) as confirmados'))
            ->Where('data', '>=', $dataIni)
            ->Where('data', '<=', $dataFin)
            ->groupBy('data', 'semana')
            ->get();

        dd($reservas);
    }

}
