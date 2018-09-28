<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpcionalStoreUpdateFormRequest;
use App\Opcional;
use Illuminate\Support\Facades\Auth;

class OpcionalController extends Controller
{

    public function index()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos os opcionais do banco
        $opcionais = Opcional::All();

        return view('listas.opcionais_list', compact('opcionais'));
    }

    public function create()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        return view('formularios.opcionais_form', compact('acao'));
    }

    public function store(OpcionalStoreUpdateFormRequest $request)
    {
        // Obtém os dados do formulario
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Opcional::create($dados);

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('opcionais.index')
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
        $reg = Opcional::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.opcionais_form', compact('reg', 'acao'));
    }

    public function update(OpcionalStoreUpdateFormRequest $request, $id)
    {
        // Obtém os dados do formulario
        $dados = $request->all();

        // Posiciona no registo a ser alterado
        $reg = Opcional::find($id);

        // Realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('opcionais.index')
                ->with('alter', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // Posiciona no registo a ser alterado
        $reg = Opcional::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($reg->delete()) {
            return redirect()->route('opcionais.index')
                ->with('trash', $reg->nome . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }

}
