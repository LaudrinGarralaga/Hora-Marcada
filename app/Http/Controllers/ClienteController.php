<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Http\Requests\ClienteStoreUpdateFormRequest;

class ClienteController extends Controller {

    public function index() {

        $clientes = Cliente::All();
        return view('clientes_list', compact('clientes'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('clientes_form', compact('acao'));
    }

    public function store(ClienteStoreUpdateFormRequest $request) {
        

        // obtém os dados do form
        $dados = $request->all();
        $inc = Cliente::create($dados);
        if ($inc) {
            return redirect()->route('clientes.index')
                            ->with('success', $request->nome . ' Castrado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao cadastrar!');
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

    public function update(ClienteStoreUpdateFormRequest $request, $id) {

        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Cliente::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('clientes.index')
                            ->with('success', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id) {
        $cli = Cliente::find($id);
        if ($cli->delete()) {
            return redirect()->route('clientes.index')
            ->with('success', $cli->nome . ' Excluído(a) com sucesso!');
        } else {
           return redirect()->back->with('error', 'Falha ao alterar!');
        }
            
    }

}
