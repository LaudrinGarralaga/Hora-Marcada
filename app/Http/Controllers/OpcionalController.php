<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opcional;
use App\Http\Requests\OpcionalStoreUpdateFormRequest;

class OpcionalController extends Controller {

    public function index() {

        $opcionais = Opcional::All();
        return view('opcionais_list', compact('opcionais'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('opcionais_form', compact('acao'));
    }

    public function store(OpcionalStoreUpdateFormRequest $request) {

        // obtém os dados do form
        $dados = $request->all();
        $inc = Opcional::create($dados);
        if ($inc) {
            return redirect()->route('opcionais.index')
                            ->with('success', $request->descricao . ' Castrado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao cadastrar!');
        }
        
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Opcional::find($id);
        $acao = 2;

        return view('opcionais_form', compact('reg', 'acao'));
    }

    public function update(OpcionalStoreUpdateFormRequest $request, $id) {

        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Opcional::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('opcionais.index')
                            ->with('success', $request->descricao . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id) {
        $reg = Opcional::find($id);
        if ($reg->delete()) {
            return redirect()->route('opcionais.index')
            ->with('success', $reg->descricao . ' Excluído(a) com sucesso!');
        } else {
           return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

}
