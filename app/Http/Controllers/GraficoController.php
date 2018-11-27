<?php

namespace App\Http\Controllers;

use App\Permanente;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function Graficos()
    {

        DB::insert(DB::raw("CREATE TEMPORARY TABLE quadrastemp (tipo varchar(45))"));

        $r = Reserva::join('quadras', 'reservas.quadra_id', '=', 'quadras.id')
            ->select('quadras.tipo')
            ->get();

        $p = Permanente::join('quadras', 'permanentes.quadra_id', '=', 'quadras.id')
            ->select('quadras.tipo')
            ->get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO quadrastemp (tipo) values (?)"),
                array($row['tipo']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO quadrastemp (tipo) values (?)"),
                array($row1['tipo']));
        }

        $quadras = DB::table('quadrastemp')->select('tipo as quadra', DB::raw('count(*) as num'))
            ->groupBy('tipo')
            ->get();

        DB::insert(DB::raw("CREATE TEMPORARY TABLE horariostemp (horario varchar(45))"));

        $r = Reserva::join('horarios', 'reservas.horario_id', '=', 'horarios.id')
            ->select('horarios.horario')
            ->get();

        $p = Permanente::join('horarios', 'permanentes.horario_id', '=', 'horarios.id')
            ->select('horarios.horario')
            ->get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO horariostemp (horario) values (?)"),
                array($row['horario']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO horariostemp (horario) values (?)"),
                array($row1['horario']));
        }

        $horarios = DB::table('horariostemp')->select('horario as horario', DB::raw('count(*) as num'))
            ->groupBy('horario')
            ->get();

        DB::insert(DB::raw("CREATE TEMPORARY TABLE semanastemp (semana varchar(45))"));

        $r = Reserva::get();

        $p = Permanente::get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO semanastemp (semana) values (?)"),
                array($row['semana']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO semanastemp (semana) values (?)"),
                array($row1['semana']));
        }

        $semanas = DB::table('semanastemp')->select('semana', DB::raw('count(*) as num'))
            ->groupBy('semana')
            ->get();

        return view('graficos.graficos_graf', compact('quadras', 'horarios', 'semanas'));
    }

    public function filtro(Request $request)
    {
        // obtém dados do form de pesquisa
        $dataIni = $request->dataIni;
        $dataFin = $request->dataFin;

        DB::insert(DB::raw("CREATE TEMPORARY TABLE quadrastemp (tipo varchar(45))"));

        $r = Reserva::join('quadras', 'reservas.quadra_id', '=', 'quadras.id')
            ->select('quadras.tipo')
            ->where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        $p = Permanente::join('quadras', 'permanentes.quadra_id', '=', 'quadras.id')
            ->select('quadras.tipo')
            ->where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO quadrastemp (tipo) values (?)"),
                array($row['tipo']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO quadrastemp (tipo) values (?)"),
                array($row1['tipo']));
        }

        $quadras = DB::table('quadrastemp')->select('tipo as quadra', DB::raw('count(*) as num'))
            ->groupBy('tipo')
            ->get();

        DB::insert(DB::raw("CREATE TEMPORARY TABLE horariostemp (horario varchar(45))"));

        $r = Reserva::join('horarios', 'reservas.horario_id', '=', 'horarios.id')
            ->select('horarios.horario')
            ->where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        $p = Permanente::join('horarios', 'permanentes.horario_id', '=', 'horarios.id')
            ->select('horarios.horario')
            ->where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO horariostemp (horario) values (?)"),
                array($row['horario']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO horariostemp (horario) values (?)"),
                array($row1['horario']));
        }

        $horarios = DB::table('horariostemp')->select('horario as horario', DB::raw('count(*) as num'))
            ->groupBy('horario')
            ->get();

        DB::insert(DB::raw("CREATE TEMPORARY TABLE semanastemp (semana varchar(45))"));

        $r = Reserva::where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        $p = Permanente::where('data', '>=', $dataIni)
            ->where('data', '<=', $dataFin)
            ->get();

        foreach ($r as $row) {
            $b = DB::insert(DB::raw("INSERT INTO semanastemp (semana) values (?)"),
                array($row['semana']));

        }

        foreach ($p as $row1) {
            $x = DB::insert(DB::raw("INSERT INTO semanastemp (semana) values (?)"),
                array($row1['semana']));
        }

        $semanas = DB::table('semanastemp')->select('semana', DB::raw('count(*) as num'))
            ->groupBy('semana')
            ->get();

        $dataIni = Carbon::parse($dataIni)->format('d/m/Y');
        $dataFin = Carbon::parse($dataFin)->format('d/m/Y');
        return view('graficos.graficos_graf', compact('quadras', 'horarios', 'semanas', 'dataIni', 'dataFin'));
    }

}
