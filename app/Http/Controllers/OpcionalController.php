<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opcional;

class OpcionalController extends Controller {

    public function index() {

        $opcionais = Opcional::paginate(5);
        return view('opcionais_list', compact('opcionais'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('opcionais_form', compact('acao'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'descricao' => 'required|unique:opcionals|min:4|max:45',
            'valor' => 'required'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        $inc = Opcional::create($dados);
        if ($inc) {
            return redirect()->route('opcionais.index')
                            ->with('status', $request->descricao . ' Incluído(a)!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Opcional::find($id);
        $acao = 2;

        return view('opcionais_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'descricao' => 'required|min:4|max:45',
            'valor' => 'required'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Opcional::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('opcionais.index')
                            ->with('status', $request->descricao . ' Alterado(a)!');
        }
    }

    public function destroy($id) {
        $reg = Opcional::find($id);
        if ($reg->delete()) {
            return redirect()->route('opcionais.index')
                            ->with('status', $reg->descricao . ' Excluído(a)!');
        }
    }

    public function pesq() {

        $opcionais = Opcional::paginate(5);
        return view('opcionais_pesq', compact('opcionais'));
    }

    public function filtros(Request $request) {
        $descricao = $request->descricao;

        $filtro = array();
        if (!empty($descricao)) {
            array_push($filtro, array('descricao', 'like', '%' . $descricao . '%'));
        }

        $opcionais = Opcional::where($filtro)
                ->orderBy('descricao')
                ->paginate(5);
        return view('opcionais_pesq', compact('opcionais'));
    }

    public function filtros2(Request $request) {
        $descricao = $request->descricao;

        $opcionais = Opcional::where('descricao', 'like', '%' . $descricao . '%')
                ->orderBy('nome')
                ->paginate(5);
        return view('opcionais_pesq', compact('opcionais'));
    }

}
