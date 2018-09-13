<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Horario;
use App\Cliente;
use App\Quadra;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reservas = Reserva::All();
        return view('reservas_list', compact('reservas'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: indica inclusão
        $acao = 1;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('horario')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $quadras = Quadra::orderBy('tipo')->get();
        // $opcionais = Opcional::orderBy('descricao')->get();
        return view('reservas_form', compact('acao', 'horarios', 'clientes', 'quadras'));
    }

    public function store(Request $request) {

        $data = $request->data;
        $quadra = $request->quadra_id;
        $horario = $request->horarios_id;
        //dd($quadra);

        $dados2 = DB::table('reservas')->where('data', '=', $data)
                ->where(function ($query) use ($horario) {
                    $query->where('horario_id', '=', $horario);
                })
                ->where(function ($query) use ($quadra) {
                    $query->where('quadra_id', '=', $quadra);
                })
                ->count();

       // dd($dados2);

        if ($dados2 >= 1){
            return redirect()->back()
                    ->with('error', 'Reserva não disponível!');
        } else {
        
            $reserva = new Reserva;
            $reserva->data = $request->data;
            $reserva->valor = $request->inPreco;
            $reserva->horario_id = $request->selHorario;
            $reserva->cliente_id = $request->clientes_id;
            $reserva->quadra_id = $request->quadra_id;
            $reserva->permanente = $request->permanente;
            $reserva->status = $request->status;
            $reserva->user_id = \Illuminate\Support\Facades\Auth::id();
            $reserva->save();
            if ($reserva) {
                return redirect()->route('reservas.index')
                                ->with('success', $request->data . ' Incluído!');
            }
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }
        
        // posiciona no registo a ser alterado
        $reg = Reserva::find($id);
        // 2: indica Alteração
        $acao = 2;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('horario')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $quadras = Quadra::orderBy('tipo')->get();
        //$opcionais = Opcional::orderBy('descricao')->get();
        return view('reservas_form', compact('reg', 'acao', 'horarios', 'clientes', 'quadras'));
    }

    public function update(Request $request, $id) {
        // posiciona no registo a ser alterado
        $reg = Reserva::find($id);
        // obtém os dados do form
        $dados = $request->all();
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Alterado!');
        }
    }

    public function destroy($id) {
        // posiciona no registo a ser alterado
        $res = Reserva::find($id);
        if ($res->delete()) {
            return redirect()->route('reservas.index')
                            ->with('status', $res->data . ' Excluído!');
        }
    }

}
