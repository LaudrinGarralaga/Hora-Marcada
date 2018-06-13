<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\Horario;
use App\Cliente;
use App\User;

class ReservaController extends Controller {

    public function index() {

//        $carros = Carro::all();

        $reservas = Reserva::paginate(3);

        return view('reservas_list', compact('reservas'));
    }

    public function create() {

        // 1: indica inclusão

        $acao = 1;

        $horarios = Horario::orderBy('hora')->get();
        
        return view('reservas_form', compact('acao', 'horarios'));
    }

    public function store(Request $request) {

        // obtém os dados do form

        $dados = $request->all();

        $inc = Reserva::create($dados);

        if ($inc) {

            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Incluído!');
        }
    }

    public function show($id) {

        //
    }

    public function edit($id) {

        $reg = Reserva::find($id);

        $acao = 2;

        $horarios = Horario::orderBy('hora')->get();
        
              return view('resevas_form', compact('reg', 'acao', 'horarios'));
    }

    public function update(Request $request, $id) {

        // obtém os dados do form

        $dados = $request->all();

        // posiciona no registo a ser alterado

        $reg = Reserva::find($id);

        // realiza a alteração

        $alt = $reg->update($dados);



        if ($alt) {

            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Alterado!');
        }
    }

    public function destroy($id) {

        $res = Reserva::find($id);

        if ($res->delete()) {

            return redirect()->route('Reserva.index')
                            ->with('status', $res->data . ' Excluído!');
        }
    }

    public function pesq() {

//        $carros = Carro::all();

        $reservas = Reserva::paginate(3);

        return view('reservas_pesq', compact('reservas'));
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
        $reservas = Reserva::where($filtro)
                ->orderBy('data')
                ->paginate(3);

        return view('reserva_pesq', compact('reservas'));
    }

    public function filtros2(Request $request) {

        $data = $request->data;

        //$precomax = $request->precomax;

        $reservas = Reserva::where('data', 'like', '%' . $data . '%')
                //->where('preco', '<=', $precomax)
                ->orderBy('data')
                ->paginate(3);

        return view('reservas_pesq', compact('reservas'));
    }

}
