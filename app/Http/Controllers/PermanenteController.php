<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permanente;
use App\Horario;
use App\Cliente;
use App\Opcional;

class PermanenteController extends Controller {

    public function index() {

//        $carros = Carro::all();

        $permanentes = Permanente::paginate(3);

        return view('permanentes_list', compact('permanentes'));
    }

    public function create() {

        // 1: indica inclusão

        $acao = 1;

        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $opcionais = Opcional::orderBy('descricao')->get();

        return view('permanentes_form', compact('acao', 'horarios', 'clientes', 'opcionais'));
    }

    public function store(Request $request) {

        // obtém os dados do form

        $permanente = new Permanente;
        $permanente->dataInicial = $request->dataInicial;
        $permanente->dataFinal = $request->dataFinal;
        $permanente->valor = $request->valor;
        $permanente->horarios_id = $request->horarios_id;
        $permanente->clientes_id = $request->clientes_id;
        $permanente->users_id = Auth::id();
        $permanente->save();

        if ($permanente) {

            return redirect()->route('permanentes.index')
                            ->with('status', $request->data . ' Incluído!');
        }
    }

    public function show($id) {

        //
    }

    public function edit($id) {

        $reg = Permanente::find($id);

        $acao = 2;

        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $opcionais = Opcional::orderBy('descricao')->get();

        return view('permanentes_form', compact('reg', 'acao', 'horarios', 'clientes', 'opcionais'));
    }

    public function update(Request $request, $id) {

        // obtém os dados do form

        $dados = $request->all();

        // posiciona no registo a ser alterado

        $reg = Permanente::find($id);

        // realiza a alteração

        $alt = $reg->update($dados);



        if ($alt) {

            return redirect()->route('permanentes.index')
                            ->with('status', $request->data . ' Alterado!');
        }
    }

    public function destroy($id) {

        $per = Permanente::find($id);

        if ($per->delete()) {

            return redirect()->route('permanentes.index')
                            ->with('status', $per->data . ' Excluído!');
        }
    }

    public function pesq() {

//        $carros = Carro::all();

        $permanentes = Permanente::paginate(3);

        return view('permanentes_pesq', compact('permanentes'));
    }

    public function filtros(Request $request) {

        $data = $request->data;

        // $precomax = $request->precomax;

        $filtro = array();

        if (!empty($data)) {

            array_push($filtro, array('data', 'like', '%' . $data . '%'));
        }

        /* if (!empty($precomax)) {

          array_push($filtro, array('preco', '<=', $precomax));
          }
         */
        $permanentes = Permanente::where($filtro)
                ->orderBy('data')
                ->paginate(3);

        return view('permanentes_pesq', compact('permanentes'));
    }

    public function filtros2(Request $request) {

        $data = $request->data;

        //$precomax = $request->precomax;

        $permanentes = Permanente::where('data', 'like', '%' . $data . '%')
                //->where('preco', '<=', $precomax)
                ->orderBy('data')
                ->paginate(3);

        return view('permanentes_pesq', compact('permanentes'));
    }

}
