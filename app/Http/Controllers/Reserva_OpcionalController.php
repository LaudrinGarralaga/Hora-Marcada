<?php

namespace App\Http\Controllers;

use App\Reserva_Opcional;
use Illuminate\Http\Request;

class Reserva_OpcionalController extends Controller
{

    public function index()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todas as reservas e seus opcionais
        $reservaOpc = Reserva_Opcional::All();

        return view('listas.reservaOpc_list', compact('reservaOpc'));
    }

    public function create()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: indica inclusão
        $acao = 1;

        return view('formularios.reservaOpc_form', compact('acao'));
    }

    public function store(Request $request)
    {
        // obtém os dados do formulário
        $dados = $request->all();

        // Realiza a inclusão
        $inc = Reserva_Opcional::create($dados);
        
        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($inc) {
            return redirect()->route('reservaOpc.index')
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
        $reg = Reserva_Opcional::find($id);

        // 2: indica alteração
        $acao = 2;

        return view('formularios.reservaOpc_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id)
    {
        // obtém os dados do formulário
        $dados = $request->all();

        // posiciona no registo a ser alterado
        $reg = Reserva_Opcional::find($id);
        
        // realiza a alteração
        $alt = $reg->update($dados);
        
        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('reservaOpc.index')
                ->with('alter', $request->nome . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        //Posiciona no registo a ser excluido
        $per = Reserva_Opcional::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($per->delete()) {
            return redirect()->route('reservaOpc.index')
                ->with('trash', $per->nome . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }

}
