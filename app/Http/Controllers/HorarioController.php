<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Http\Requests\HorarioStoreUpdateFormRequest;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{

    public function index()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Recupera todos os horarios do banco
        $horarios = Horario::All();

        return view('listas.horarios_list', compact('horarios'));
    }

    public function create()
    {
        // Verifica se  está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        return view('formularios.horarios_form', compact('acao'));
    }

    public function store(HorarioStoreUpdateFormRequest $request)
    {

        // Obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Horario::create($dados);

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('horarios.index')
                ->with('success', $request->horario . ' Castrado(a) com sucesso!');
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
        $reg = Horario::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.horarios_form', compact('reg', 'acao'));
    }

    public function update(HorarioStoreUpdateFormRequest $request, $id)
    {
        // Obtém os dados do formulario
        $dados = $request->all();

        // Posiciona no registo a ser alterado
        $reg = Horario::find($id);

        // Realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('horarios.index')
                ->with('alter', $request->horario . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        // Posiciona no registo a ser alterado
        $hor = Horario::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($hor->delete()) {
            return redirect()->route('horarios.index')
                ->with('trash', $hor->horario . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }

}
