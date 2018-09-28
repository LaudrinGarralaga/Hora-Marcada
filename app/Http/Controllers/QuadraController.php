<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuadraStoreUpdateFormRequest;
use App\Quadra;
use Illuminate\Support\Facades\Auth;

class QuadraController extends Controller
{

    public function index()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos as quadras do banco
        $quadras = Quadra::All();
        return view('listas.quadras_list', compact('quadras'));
    }

    public function create()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        return view('formularios.quadras_form', compact('acao'));
    }

    public function store(QuadraStoreUpdateFormRequest $request)
    {
        // Obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Quadra::create($dados);

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('quadras.index')
                ->with('success', $request->tipo . ' Castrado(a) com sucesso!');
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
        $reg = Quadra::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.quadras_form', compact('reg', 'acao'));
    }

    public function update(QuadraStoreUpdateFormRequest $request, $id)
    {
        // Obtém os dados do formulario
        $dados = $request->all();

        // Posiciona no registo a ser alterado
        $reg = Quadra::find($id);

        // Realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('quadras.index')
                ->with('alter', $request->tipo . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // Posiciona no registo a ser alterado
        $cli = Quadra::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($cli->delete()) {
            return redirect()->route('quadras.index')
                ->with('trash', $cli->tipo . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }
}
