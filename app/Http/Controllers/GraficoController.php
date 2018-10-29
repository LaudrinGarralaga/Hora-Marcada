<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use App\User;
use App\Reserva;

class GraficoController extends Controller
{
    public function Graficos() {
        $quadras = DB::table('reservas')
                ->join('quadras', 'reservas.quadra_id', '=', 'quadras.id')
                ->select('quadras.tipo as quadra', DB::raw('count(*) as num'))
                ->groupBy('quadras.tipo')
                ->get();

        $horarios = DB::table('reservas')
                ->join('horarios', 'reservas.horario_id', '=', 'horarios.id')
                ->select('horarios.horario as horario', DB::raw('count(*) as num'))
                ->groupBy('horarios.horario')
                ->get();

        $semanas = DB::table('reservas')
                ->select('semana', DB::raw('count(*) as num'))
                ->groupBy('reservas.semana')
                ->get();

        return view('graficos.graficos_graf', compact('quadras', 'horarios', 'semanas'));
    }

    public function filtro(Request $request) {
        // obtém dados do form de pesquisa
        $dataIni = $request->dataIni;
        $dataFin = $request->dataFin;

        $quadras = DB::table('reservas')
        ->join('quadras', 'reservas.quadra_id', '=', 'quadras.id')
        ->select('quadras.tipo as quadra', DB::raw('count(*) as num'))
        ->where('data', '>=', $dataIni)
        ->where('data', '<=', $dataFin)
        ->groupBy('quadras.tipo')
        ->get();

        $horarios = DB::table('reservas')
        ->join('horarios', 'reservas.horario_id', '=', 'horarios.id')
        ->select('horarios.horario as horario', DB::raw('count(*) as num'))
        ->where('data', '>=', $dataIni)
        ->where('data', '<=', $dataFin)
        ->groupBy('horarios.horario')
        ->get();

        $semanas = DB::table('reservas')
        ->select('semana', DB::raw('count(*) as num'))
        ->where('data', '>=', $dataIni)
        ->where('data', '<=', $dataFin)
        ->groupBy('reservas.semana')
        ->get();

        $dataIni = Carbon::parse($dataIni)->format('d/m/Y');
        $dataFin = Carbon::parse($dataFin)->format('d/m/Y');
        return view('graficos.graficos_graf', compact('quadras', 'horarios', 'semanas','dataIni', 'dataFin'));
    }

}
