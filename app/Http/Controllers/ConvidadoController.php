<?php

namespace App\Http\Controllers;

use App\Convidado;
use Illuminate\Http\Request;

class ConvidadoController extends Controller
{

    public function index()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os convites do banco
        $convidados = Convidado::All();

        return view('listas.convidados_list', compact('convidados'));
    }

    public function create()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: indica inclusão
        $acao = 1;

        return view('formularios.convidados_form', compact('acao'));
    }

    public function store(Request $request)
    {
        // obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Convidado::create($dados);


        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('convidados.index')
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
        $reg = Convidado::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.convidados_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id)
    {
        // obtém os dados do form
        $dados = $request->all();

        // posiciona no registo a ser alterado
        $reg = Convidado::find($id);

        // realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('convidados.index')
                ->with('alter', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // Posiciona no registo a ser excluido
        $conv = Convidado::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($conv->delete()) {
             return redirect()->route('convidados.index')
                ->with('trash', $conv->nome . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }

}
