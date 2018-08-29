<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva_Opcional;
use App\Reserva;
use App\Opcional;

class Reserva_OpcionalController extends Controller {

    public function index() {

        $reservaOpc = Reserva_Opcional::All();;
        return view('reservaOpc_list', compact('reservaOpc'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;
        //$marcas = Marca::orderBy('nome')->get();
        return view('reservaOpc_form', compact('acao'));
    }

    public function store(Request $request) {
        // obtém os dados do form
        $dados = $request->all();
        $inc = Reserva_Opcional::create($dados);
        if ($inc) {
            return redirect()->route('reservaOpc.index')
                            ->with('status', $request->data . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Reserva_Opcional::find($id);
        $acao = 2;
        //$marcas = Marca::orderBy('nome')->get();
        return view('reservaOpc_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Reserva_Opcional::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('reservaOpc.index')
                            ->with('status', $request->data . ' Alterado!');
        }
    }

    public function destroy($id) {
        $per = Reserva_Opcional::find($id);
        if ($per->delete()) {
            return redirect()->route('reservaOpc.index')
                            ->with('status', $per->data . ' Excluído!');
        }
    }

}
