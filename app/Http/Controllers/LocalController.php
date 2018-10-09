<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Local;

class LocalController extends Controller
{
   
    public function index()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        $usuario = Auth::id();
        
        // Recupera todos os clientes do banco
        //$locais = Local::Where('user_id', '=', $usuario);
        $locais = DB::table('local')->where('user_id', '=', $usuario)->get();
        //dd($locais);

        return view('listas.locais_list', compact('locais'));
    }

    
    public function create()
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: Indica inclusão
        $acao = 1;

        return view('formularios.locais_form', compact('acao'));
    }

    public function store(Request $request)
    {
        $local = new Local;
        $local->endereco = $request->endereco;
        $local->numero = $request->numero;
        $local->complemento = $request->complemento;
        $local->cidade = $request->cidade;
        $local->bairro = $request->bairro;
        $local->cep = $request->cep;
        $local->telefone = $request->telefone;
        $local->user_id = Auth::id();
        $local->save();

        // Exibe uma mensagem de sucesso se gravou os dados no bando senão exibe uma de erro
        if ($local) {
            return redirect()->route('locais.index')
                ->with('success', $request->endereco . ' Castrado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao cadastrar!');
        }
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        // Verifica se está logado
        if (!Auth::check()) {
            return redirect('/');
        }

        // Posiciona no registo a ser alterado
        $reg = Local::find($id);

        // 2: Indica alteração
        $acao = 2;

        return view('formularios.locais_form', compact('reg', 'acao'));
    }

   
    public function update(Request $request, $id)
    {
        // obtém os dados do formuláro
        $dados = $request->all();

        // Posiciona no registo a ser alterado
        $reg = Local::find($id);

        // realiza a alteração
        $alt = $reg->update($dados);

        // Exibe uma mensagem de sucesso se alterou os dados no bando senão exibe uma de erro
        if ($alt) {
            return redirect()->route('locais.index')
                ->with('alter', $request->endereco . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }


    public function destroy($id)
    {
        // Posiciona no registo a ser excluido
        $local = Local::find($id);

        // Exibe uma mensagem se excluiu com sucesso dados, senão exibe uma de erro
        if ($local->delete()) {
            return redirect()->route('locais.index')
                ->with('trash', $local->endereco . ' Excluído(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao excluir!');
        }
    }
}
