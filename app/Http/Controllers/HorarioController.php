<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;

class HorarioController extends Controller {

    public function index() {

        $horarios = Horario::paginate(5);
        return view('horarios_list', compact('horarios'));
    }

    public function create() {
        // 1: indica inclusão
        $acao = 1;

        return view('horarios_form', compact('acao'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'hora' => 'required|unique:horarios|min:13|max:13',
            'valor' => 'required'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        $inc = Horario::create($dados);
        if ($inc) {
            return redirect()->route('horarios.index')
                            ->with('status', $request->hora . ' Incluído!');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $reg = Horario::find($id);
        $acao = 2;

        return view('horarios_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'hora' => 'required|min:13|max:13',
            'valor' => 'required'
        ]);

        // obtém os dados do form
        $dados = $request->all();
        // posiciona no registo a ser alterado
        $reg = Horario::find($id);
        // realiza a alteração
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('horarios.index')
                            ->with('status', $request->hora . ' Alterado!');
        }
    }

    public function destroy($id) {
        $hor = Horario::find($id);
        if ($hor->delete()) {
            return redirect()->route('horarios.index')
                            ->with('status', $hor->hora . ' Excluído!');
        }
    }

    public function pesq() {

        $horarios = Horario::paginate(5);
        return view('horarios_pesq', compact('horarios'));
    }

    public function filtros(Request $request) {
        $hora = $request->hora;

        $filtro = array();
        if (!empty($hora)) {
            array_push($filtro, array('hora', 'like', '%' . $hora . '%'));
        }

        $horarios = Horario::where($filtro)
                ->orderBy('hora')
                ->paginate(5);
        return view('horarios_pesq', compact('horarios'));
    }

    public function filtros2(Request $request) {
        $hora = $request->nome;

        $horarios = Horario::where('hora', 'like', '%' . $hora . '%')
                ->orderBy('hora')
                ->paginate(5);
        return view('horarios_pesq', compact('horarios'));
    }

}
