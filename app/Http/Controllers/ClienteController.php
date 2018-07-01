<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller {

    public function index() {

        $clientes = Cliente::paginate(5);
        return view('clientes_list', compact('clientes'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('clientes_form', compact('acao'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required|unique:clientes|min:3|max:45',
            'telefone' => 'required|unique:clientes',
            'email' => 'unique:clientes'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        $inc = Cliente::create($dados);
        if ($inc) {
            return redirect()->route('clientes.index')
                            ->with('status', $request->nome . ' Castrado(a)!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Cliente::find($id);
        $acao = 2;

        return view('clientes_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nome' => 'required|min:3|max:45',
            'telefone' => 'required'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Cliente::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('clientes.index')
                            ->with('status', $request->nome . ' Alterado(a)!');
        }
    }

    public function destroy($id) {
        $cli = Cliente::find($id);
        if ($cli->delete()) {
            return redirect()->route('clientes.index')
                            ->with('status', $cli->nome . ' Excluído(a)!');
        }
    }

    public function pesq() {

        $clientes = Cliente::paginate(5);
        return view('clientes_pesq', compact('clientes'));
    }

    public function filtros(Request $request) {
        $nome = $request->nome;

        $filtro = array();
        if (!empty($nome)) {
            array_push($filtro, array('nome', 'like', '%' . $nome . '%'));
        }

        $clientes = Cliente::where($filtro)
                ->orderBy('nome')
                ->paginate(5);
        return view('clientes_pesq', compact('clientes'));
    }

    public function filtros2(Request $request) {
        $nome = $request->nome;

        $clientes = Cliente::where('nome', 'like', '%' . $nome . '%')
                ->orderBy('nome')
                ->paginate(5);
        return view('clientes_pesq', compact('clientes'));
    }

}
