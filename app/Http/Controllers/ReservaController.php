<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\Horario;
use App\Cliente;
use App\Quadra;

class ReservaController extends Controller {

    public function index() {
        $reservas = Reserva::All();
        return view('reservas_list', compact('reservas'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $quadras = Quadra::orderBy('tipo')->get();
        // $opcionais = Opcional::orderBy('descricao')->get();
        return view('reservas_form', compact('acao', 'horarios', 'clientes', 'quadras'));
    }

    public function store(Request $request) {
        
        $reserva = new Reserva;
        $reserva->data = $request->data;
        $reserva->valor = $request->valor;
        $reserva->horario_id = $request->horarios_id;
        $reserva->cliente_id = $request->clientes_id;
        $reserva->quadra_id = $request->quadra_id;
        $reserva->user_id = \Illuminate\Support\Facades\Auth::id();
        $reserva->save();
        if ($reserva) {
            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        // posiciona no registo a ser alterado
        $reg = Reserva::find($id);
        // 2: indica Alteração
        $acao = 2;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
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
