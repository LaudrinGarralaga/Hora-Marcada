<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Horario;
use App\Permanente;
use App\Quadra;
use App\Reserva_Opcional;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermanenteController extends Controller
{

    public function index()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos as quadras do banco
        $permanentes = Permanente::All();

        return view('listas.permanentes_list', compact('permanentes'));
    }

    public function create()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        // Obtém os horários, clientes e quadras para exibir no form de cadastro
        $horarios = Horario::orderBy('horario')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $quadras = Quadra::orderBy('tipo')->get();

        return view('formularios.permanentes_form', compact('acao', 'horarios', 'clientes', 'quadras'));
    }

    public function store(Request $request)
    {
        $data = $request->data;
        $quadra = $request->quadra_id;
        $horario = $request->horario_id;
        $splitName = explode(' ', $data, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $opcionais = $request->opcionais;

        $query1 = DB::table('reservas')->where('data', '=', $last_name)
            ->where('horario_id', '=', $horario)
            ->where('quadra_id', '=', $quadra)
            ->where('confirmado', '<>', 1)
            ->count();

        $query2 = Permanente::where('quadra_id', '=', $quadra)
            ->where('semana', '=', $first_name)
            ->where('horario_id', '=', $horario)
            ->where('ativo', '=', 1)
            ->count();

        if ($query1 >= 1 || $query2 >= 1) {
            return redirect()->back()
                ->with('error', 'Reserva não disponível!');
        } else {
            $permanente = new Permanente;
            $permanente->data = $last_name;
            $permanente->semana = $first_name;
            $permanente->preco = $request->Preco;
            $permanente->horario_id = $request->horario_id;
            $permanente->cliente_id = $request->cliente_id;
            $permanente->quadra_id = $request->quadra_id;
            $permanente->user_id = \Illuminate\Support\Facades\Auth::id();
            $permanente->save();

            $id = DB::getPdo()->lastInsertId();

            //dd($id);

            for ($i = 0; $i < count($request->opcionais); $i++) {
                Reserva_Opcional::create([
                    'permanente_id' => $id,
                    'opcional_id' => $request->opcionais[$i],
                ]);
            }

            if ($permanente) {
                return redirect()->route('permanentes.index')
                    ->with('success', Carbon::parse($permanente->data)->format('d/m/Y') . ' Incluído(a) com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Falha ao cadastrar!');
            }
        }

    }

    public function show(Permanente $permanente)
    {
        //
    }

    public function edit(Permanente $permanente)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Permanente $permanente)
    {
        //
    }

    public function cancelar(Request $request, $id)
    {
        $query = Permanente::where('id', '=', $id)
            ->update(['ativo' => 0]);

        if ($query) {
            return redirect()->route('permanentes.index')
                ->with('alter', $request->data . ' Cancelado(a) com sucesso!');
        }
        
        return redirect()->route('permanentes.index');
    }
}
