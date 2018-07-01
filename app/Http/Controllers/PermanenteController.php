<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permanente;
use App\Horario;
use App\Cliente;


class PermanenteController extends Controller {

    public function index() {

        $permanentes = Permanente::paginate(5);
        return view('permanentes_list', compact('permanentes'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();
        //$opcionais = Opcional::orderBy('descricao')->get();
        return view('permanentes_form', compact('acao', 'horarios', 'clientes'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'dataInicial' => 'required',
            'dataFinal' => 'required',
            'valor' => 'required'
        ]);

        // obtém os dados do form
        $permanente = new Permanente;
        $permanente->dataInicial = $request->dataInicial;
        $permanente->dataFinal = $request->dataFinal;
        $permanente->valor = $request->valor;
        $permanente->horario_id = $request->horario_id;
        $permanente->cliente_id = $request->cliente_id;
        $permanente->user_id = \Illuminate\Support\Facades\Auth::id();
        $permanente->save();
        if ($permanente) {
            return redirect()->route('permanentes.index')
                            ->with('status', $request->dataInicial . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Permanente::find($id);
        $acao = 2;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();
        //$opcionais = Opcional::orderBy('descricao')->get();
        return view('permanentes_form', compact('reg', 'acao', 'horarios', 'clientes'));
    }

    public function update(Request $request, $id) {
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Permanente::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('permanentes.index')
                            ->with('status', $request->dataInicial . ' Alterado!');
        }
    }

    public function destroy($id) {
        $per = Permanente::find($id);
        if ($per->delete()) {
            return redirect()->route('permanentes.index')
                            ->with('status', $per->dataInicial . ' Excluído!');
        }
    }

    public function pesq() {

        $permanentes = Permanente::paginate(5);
        return view('permanentes_pesq', compact('permanentes'));
    }

    public function filtros(Request $request) {
        $data = $request->data;

        $filtro = array();
        if (!empty($data)) {
            array_push($filtro, array('data', 'like', '%' . $data . '%'));
        }

        $permanentes = Permanente::where($filtro)
                ->orderBy('data')
                ->paginate(5);
        return view('permanentes_pesq', compact('permanentes'));
    }

    public function filtros2(Request $request) {
        $data = $request->data;

        $permanentes = Permanente::where('data', 'like', '%' . $data . '%')
                ->orderBy('data')
                ->paginate(3);
        return view('permanentes_pesq', compact('permanentes'));
    }

}
