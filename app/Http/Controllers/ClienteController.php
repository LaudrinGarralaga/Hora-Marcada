<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller {

    public function index() {

//        $carros = Carro::all();

        $clientes = Cliente::paginate(3);

        return view('clientes_list', compact('clientes'));
    }

    public function create() {

        // 1: indica inclusão

        $acao = 1;

        //$marcas = Marca::orderBy('nome')->get();

        return view('clientes_form', compact('acao'));
    }

    public function store(Request $request) {

        // obtém os dados do form

        $dados = $request->all();

        $inc = Cliente::create($dados);

        if ($inc) {

            return redirect()->route('clientes.index')
                            ->with('status', $request->nome . ' Incluído!');
        }
    }

    public function show($id) {

        //
    }

    public function edit($id) {

        $reg = Cliente::find($id);

        $acao = 2;

        //$marcas = Marca::orderBy('nome')->get();

        return view('clientes_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {

        // obtém os dados do form

        $dados = $request->all();

        // posiciona no registo a ser alterado

        $reg = Cliente::find($id);

        // realiza a alteração

        $alt = $reg->update($dados);



        if ($alt) {

            return redirect()->route('clientes.index')
                            ->with('status', $request->nome . ' Alterado!');
        }
    }

    public function destroy($id) {

        $cli = Cliente::find($id);

        if ($cli->delete()) {

            return redirect()->route('clientes.index')
                            ->with('status', $cli->nome . ' Excluído!');
        }
    }

    public function pesq() {

//        $carros = Carro::all();

        $clientes = Cliente::paginate(3);

        return view('clientes_pesq', compact('clientes'));
    }

    public function filtros(Request $request) {

        $nome = $request->nome;

        // $precomax = $request->precomax;

        $filtro = array();

        if (!empty($nome)) {

            array_push($filtro, array('nome', 'like', '%' . $nome . '%'));
        }

        /* if (!empty($precomax)) {

          array_push($filtro, array('preco', '<=', $precomax));
          }
         */
        $clientes = Cliente::where($filtro)
                ->orderBy('nome')
                ->paginate(3);

        return view('clientes_pesq', compact('clientes'));
    }

    public function filtros2(Request $request) {

        $nome = $request->nome;

        //$precomax = $request->precomax;

        $clientes = Cliente::where('nome', 'like', '%' . $nome . '%')
                //->where('preco', '<=', $precomax)
                ->orderBy('nome')
                ->paginate(3);

        return view('clientes_pesq', compact('clientes'));
    }

}
