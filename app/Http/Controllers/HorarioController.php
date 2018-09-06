<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;
use App\Http\Requests\HorarioStoreUpdateFormRequest;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $horarios = Horario::All();
        return view('horarios_list', compact('horarios'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // 1: indica inclusão
        $acao = 1;

        return view('horarios_form', compact('acao'));
    }

    public function store(HorarioStoreUpdateFormRequest $request) {

        // obtém os dados do form
        $dados = $request->all();
        $inc = Horario::create($dados);
        
        if ($inc) {
            return redirect()->route('horarios.index')
                            ->with('success', $request->hora . ' Castrado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao cadastrar!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Horario::find($id);
        $acao = 2;

        return view('horarios_form', compact('reg', 'acao'));
    }

    public function update(HorarioStoreUpdateFormRequest $request, $id) {
        
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Horario::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
       
        if ($alt) {
            return redirect()->route('horarios.index')
                            ->with('success', $request->hora . ' Alterado(a) com sucesso!');
        } else {
            return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

    public function destroy($id) {
        $hor = Horario::find($id);
        if ($hor->delete()) {
            return redirect()->route('horarios.index')
            ->with('success', $hor->hora . ' Excluído(a) com sucesso!');
        } else {
           return redirect()->back->with('error', 'Falha ao alterar!');
        }
    }

}
