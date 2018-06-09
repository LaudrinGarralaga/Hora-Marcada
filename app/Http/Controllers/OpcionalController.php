<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opcional;

class OpcionalController extends Controller {

    public function index() {

//        $carros = Carro::all();

        $opcionais = Opcional::paginate(3);

        return view('opcionais_list', compact('opcionais'));
    }

    public function create() {

        // 1: indica inclusão

        $acao = 1;

        //$marcas = Marca::orderBy('nome')->get();

        return view('opcionais_form', compact('acao'));
    }

    public function store(Request $request) {

        // obtém os dados do form

        $dados = $request->all();

        $inc = Opcional::create($dados);

        if ($inc) {

            return redirect()->route('opcionais.index')
                            ->with('status', $request->descricao . ' Incluído!');
        }
    }

    public function show($id) {

        //
    }

    public function edit($id) {

        $reg = Opcional::find($id);

        $acao = 2;

        //$marcas = Marca::orderBy('nome')->get();

        return view('opcionais_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {

        // obtém os dados do form

        $dados = $request->all();

        // posiciona no registo a ser alterado

        $reg = Opcional::find($id);

        // realiza a alteração

        $alt = $reg->update($dados);



        if ($alt) {

            return redirect()->route('opcionais.index')
                            ->with('status', $request->descricao . ' Alterado!');
        }
    }

    public function destroy($id) {

        $reg = Opcional::find($id);

        if ($reg->delete()) {

            return redirect()->route('opcionais.index')
                            ->with('status', $reg->descricao . ' Excluído!');
        }
    }

    public function pesq() {

//        $carros = Carro::all();

        $opcionais = Opcional::paginate(3);

        return view('opcionais_pesq', compact('opcionais'));
    }

    public function filtros(Request $request) {

        $descricao = $request->descricao;

        // $precomax = $request->precomax;

        $filtro = array();

        if (!empty($descricao)) {

            array_push($filtro, array('descricao', 'like', '%' . $descricao . '%'));
        }

        /* if (!empty($precomax)) {

          array_push($filtro, array('preco', '<=', $precomax));
          }
         */
        $opcionais = Opcional::where($filtro)
                ->orderBy('descricao')
                ->paginate(3);

        return view('opcionais_pesq', compact('opcionais'));
    }

    public function filtros2(Request $request) {

        $descricao = $request->descricao;

        //$precomax = $request->precomax;

        $opcionais = Opcional::where('descricao', 'like', '%' . $descricao . '%')
                //->where('preco', '<=', $precomax)
                ->orderBy('nome')
                ->paginate(3);

        return view('opcionais_pesq', compact('opcionais'));
    }

}
