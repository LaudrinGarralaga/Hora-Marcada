<?php

namespace App\Http\Controllers;

use App\Convite;
use Illuminate\Http\Request;

class ConviteController extends Controller
{

    public function index()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos os convites do banco
        $convites = Convite::All();

        return view('listas.convites_list', compact('convites'));
    }

    public function create()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: indica inclusão
        $acao = 1;

        return view('formularios.convites_form', compact('acao'));
    }

    public function store(Request $request)
    {
        // obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Convite::create($dados);

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('convites.index')
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
        $reg = Convite::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.convites_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id)
    {
        // obtém os dados do formulário
        $dados = $request->all();

        // posiciona no registo a ser alterado
        $reg = Convite::find($id);

        // realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('convites.index')
                ->with('alter', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // posiciona no registro a ser excluido
        $con = Convite::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($con->delete()) {
            return redirect()->route('convites.index')
                ->with('trash', $con->nome . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }
}
