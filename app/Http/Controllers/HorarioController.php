<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;

class HorarioController extends Controller {

    public function index() {

//        $carros = Carro::all();

        $horarios = Horario::paginate(3);

        return view('horarios_list', compact('horarios'));
    }

    public function create() {

        // 1: indica inclusão

        $acao = 1;

        //$marcas = Marca::orderBy('nome')->get();

        return view('horarios_form', compact('acao'));
    }

    public function store(Request $request) {

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

        //$marcas = Marca::orderBy('nome')->get();

        return view('horarios_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {

        // obtém os dados do form

        $dados = $request->all();

        // posiciona no registo a ser alterado

        $reg = Horario::find($id);

        // realiza a alteração

        $alt = $reg->update($dados);



        if ($alt) {

            return redirect()->route('horarios.index')
                            ->with('status', $request->hora . ' Alterada!');
        }
    }

    public function destroy($id) {

        $hor = Horario::find($id);

        if ($hor->delete()) {

            return redirect()->route('horarios.index')
                            ->with('status', $hor->hora . ' Excluída!');
        }
    }

    public function pesq() {

//        $carros = Carro::all();

        $horarios = Horario::paginate(3);

        return view('horarios_pesq', compact('horarios'));
    }

    public function filtros(Request $request) {

        $hora = $request->hora;

        // $precomax = $request->precomax;

        $filtro = array();

        if (!empty($hora)) {

            array_push($filtro, array('hora', 'like', '%' . $hora . '%'));
        }

        /* if (!empty($precomax)) {

          array_push($filtro, array('preco', '<=', $precomax));
          }
         */
        $horarios = Horario::where($filtro)
                ->orderBy('hora')
                ->paginate(3);

        return view('horarios_pesq', compact('horarios'));
    }

    public function filtros2(Request $request) {

        $hora = $request->nome;

        //$precomax = $request->precomax;

        $horarios = Horario::where('hora', 'like', '%' . $hora . '%')
                //->where('preco', '<=', $precomax)
                ->orderBy('hora')
                ->paginate(3);

        return view('horarios_pesq', compact('horarios'));
    }

}
