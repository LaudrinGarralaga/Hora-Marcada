<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Horario;
use App\Cliente;

class ReservaController extends Controller {

    public function index() {

        $reservas = Reserva::paginate(10);

        return view('reservas_list', compact('reservas'));
    }

    public function create() {

        // 1: indica inclusão
        $acao = 1;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();

        return view('reservas_form', compact('acao', 'horarios', 'clientes'));
    }

    public function store(Request $request) {
       /* $this->validate($request, [
            'data' => 'required|unique:carros|min:2|max:60',
            'cor' => 'required|min:4|max:40',
            'ano' => 'required|numeric|min:1970|max:2020',
            'preco' => 'required'
        ]);*/
        
        $reserva = new Reserva;
        $reserva->data = $request->data;
        $reserva->valor = $request->valor;
        $reserva->horarios_id = $request->horarios_id;
        $reserva->clientes_id = $request->clientes_id;
        $reserva->users_id = Auth::id();
        $reserva->save();

        if ($reserva) {
            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Incluído!');
        }
    }

    public function show($id) {

        //
    }

    public function edit($id) {

        // posiciona no registo a ser alterado
        $reg = Reserva::find($id);
        // 2: indica Alteração
        $acao = 2;
        // obtém os horários e clientes para exibir no form de cadastro
        $horarios = Horario::orderBy('hora')->get();
        $clientes = Cliente::orderBy('nome')->get();

        return view('reservas_form', compact('reg', 'acao', 'horarios', 'clientes'));
    }

    public function update(Request $request, $id) {

        // posiciona no registo a ser alterado
        $reg = Reserva::find($id);
       
        // obtém os dados do form
        $dados = $request->all();

        // realiza a alteração
        $alt = $reg->update($dados);

        if ($alt) {

            return redirect()->route('reservas.index')
                            ->with('status', $request->data . ' Alterado!');
        }
    }

    public function destroy($id) {
        // posiciona no registo a ser alterado
        $res = Reserva::find($id);

        if ($res->delete()) {

            return redirect()->route('reservas.index')
                            ->with('status', $res->data . ' Excluído!');
        }
    }

    public function pesq() {

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
                ->paginate(10);

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
