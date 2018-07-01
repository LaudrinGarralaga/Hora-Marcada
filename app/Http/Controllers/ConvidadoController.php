<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convidado;

class ConvidadoController extends Controller {

    public function index() {

        $convidados = Convidado::paginate(3);
        return view('convidados_list', compact('convidados'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('convidados_form', compact('acao'));
    }

    public function store(Request $request) {
        // obtém os dados do form
        $dados = $request->all();
        $inc = Convidado::create($dados);
        if ($inc) {
            return redirect()->route('convidados.index')
                            ->with('status', $request->nome . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Convidado::find($id);
        $acao = 2;

        return view('convidados_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Convidado::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('convidados.index')
                            ->with('status', $request->nome . ' Alterado!');
        }
    }

    public function destroy($id) {
        $conv = Convidado::find($id);
        if ($conv->delete()) {
            return redirect()->route('convidados.index')
                            ->with('status', $conv->nome . ' Excluído!');
        }
    }

    public function pesq() {

        $convidados = Convidado::paginate(3);
        return view('convidados_pesq', compact('convidados'));
    }

    public function filtros(Request $request) {
        $nome = $request->nome;

        $filtro = array();
        if (!empty($nome)) {
            array_push($filtro, array('nome', 'like', '%' . $nome . '%'));
        }

        $convidados = Convidado::where($filtro)
                ->orderBy('nome')
                ->paginate(3);
        return view('convidados_pesq', compact('convidados'));
    }

    public function filtros2(Request $request) {
        $nome = $request->nome;

        $convidados = Convidado::where('nome', 'like', '%' . $nome . '%')
                ->orderBy('nome')
                ->paginate(3);
        return view('convidados_pesq', compact('convidados'));
    }

}
