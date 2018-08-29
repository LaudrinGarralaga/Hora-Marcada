<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convite;
use App\Convidado;
use App\Reserva;
use App\Cliente;

class ConviteController extends Controller {

    public function index() {

        $convites = Convite::All();
        return view('convites_list', compact('convites'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('convites_form', compact('acao'));
    }

    public function store(Request $request) {
        // obtém os dados do form
        $dados = $request->all();
        $inc = Convite::create($dados);
        if ($inc) {
            return redirect()->route('convites.index')
                            ->with('status', $request->nome . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Convite::find($id);
        $acao = 2;

        return view('convites_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Convite::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('convites.index')
                            ->with('status', $request->nome . ' Alterado!');
        }
    }

    public function destroy($id) {
        $con = Convite::find($id);
        if ($con->delete()) {
            return redirect()->route('convites.index')
                            ->with('status', $con->nome . ' Excluído!');
        }
    }

}
