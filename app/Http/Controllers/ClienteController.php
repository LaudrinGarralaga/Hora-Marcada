<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteStoreUpdateFormRequest;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{

    public function index()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos os clientes do banco
        $clientes = Cliente::All();

        return view('listas.clientes_list', compact('clientes'));
    }

    public function create()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        return view('formularios.clientes_form', compact('acao'));
    }

    public function store(ClienteStoreUpdateFormRequest $request)
    {
        // Obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Cliente::create($dados);

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('clientes.index')
                ->with('success', $request->nome . ' Castrado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao cadastrar!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Posiciona no registo a ser alterado
        $reg = Cliente::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.clientes_form', compact('reg', 'acao'));
    }

    public function update(ClienteStoreUpdateFormRequest $request, $id)
    {
        // obtém os dados do formuláro
        $dados = $request->all();

        // Posiciona no registo a ser alterado
        $reg = Cliente::find($id);

        // realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('clientes.index')
                ->with('alter', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // Posiciona no registo a ser excluido
        $cli = Cliente::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($cli->delete()) {
            return redirect()->route('clientes.index')
                ->with('trash', $cli->nome . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }

    }

}
