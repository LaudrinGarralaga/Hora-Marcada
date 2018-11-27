<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Permanente;
use App\Quadra;
use App\Reserva;
use App\Opcional;
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
        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('d/m/Y h:i');
        $splitName = explode(' ', $data, 2);
        $data = $splitName[0];
        $hora = !empty($splitName[1]) ? $splitName[1] : '';

        $dataIni = $request->dataIni;
        $dataFin = $request->dataFin;

        DB::insert(DB::raw("CREATE TEMPORARY TABLE tempReservas (data varchar(45), semana varchar(45))"));


        $customers = Reserva::select('data', 'semana', DB::raw('count(*) as total'), DB::raw('count(case when confirmado = 1 then 1 end) as confirmados'))
            ->Where('data', '>=', $dataIni)
            ->Where('data', '<=', $dataFin)
            ->groupBy('data', 'semana')
            ->get();

        $locais = DB::table('local')->get();

        $pdf = PDF::loadView('pdf.reservas', ['customers' => $customers], ['locais' => $locais,'data' => $data, 'dataIni' => $dataIni, 'dataFin' => $dataFin, 'hora' => $hora,]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 15, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Lista de reservas.pdf');

    }

    public function relatorioPermanente()
    {

        return view('outros.relatorio_permanente');
    }

    public function getPDFPermanente(Request $request)
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

        DB::insert(DB::raw("CREATE TEMPORARY TABLE permanenteTemp (data varchar(45), semana varchar(45))"));


        $customers = Permanente::select('data', 'semana', DB::raw('count(*) as total'), DB::raw('count(case when ativo = 1 then 1 end) as confirmados'))
            ->Where('data', '>=', $dataIni)
            ->Where('data', '<=', $dataFin)
            ->groupBy('data', 'semana')
            ->get();
        
        $locais = DB::table('local')->get();

        $pdf = PDF::loadView('pdf.permanentes', ['customers' => $customers], ['locais' => $locais,'data' => $data, 'dataIni' => $dataIni, 'dataFin' => $dataFin, 'hora' => $hora,]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 15, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Lista de permanentes.pdf');

    }

    public function relatorioOpcional()
    {

        $opcionais = Opcional::orderBy('nome')->get();

        return view('outros.relatorio_opcionais', compact('opcionais'));
    }

    public function getPDFOpcional(Request $request)
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
        $pcional = $request->opcional_id;

        if ($opcional == 0) {
            DB::insert(DB::raw("CREATE TEMPORARY TABLE opcionaltemp (data varchar(45), semana varchar(45), preco float)"));

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

}
