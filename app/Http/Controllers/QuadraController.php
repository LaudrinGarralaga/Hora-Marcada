<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quadra;
use App\Http\Requests\QuadraStoreUpdateFormRequest;

class QuadraController extends Controller
{
  
    public function index()
    {
        $quadras = Quadra::All();
        return view('quadras_list', compact('quadras'));
    }

   
    public function create()
    {
       // 1: indica inclusão
       $acao = 1;

       return view('quadras_form', compact('acao'));
    }

    public function store(QuadraStoreUpdateFormRequest $request)
    {
        // obtém os dados do form
        $dados = $request->all();
        $inc = Quadra::create($dados);
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
        $reg = Quadra::find($id);
        $acao = 2;

        return view('quadras_form', compact('reg', 'acao')); 
    }

    public function update(QuadraStoreUpdateFormRequest $request, $id)
    {
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Quadra::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('quadras.index')
                            ->with('success', $request->tipo . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id)
    {
        $cli = Quadra::find($id);
        if ($cli->delete()) {
            return redirect()->route('quadras.index')
            ->with('success', $cli->tipo . ' Excluído(a) com sucesso!');
        } else {
           return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }
}
