<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function horarios(){
       /* 

        return view('graficos.graficos_graf', compact('reservas'));*/
    }
}
