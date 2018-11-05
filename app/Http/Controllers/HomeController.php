<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Horario;
use App\Opcional;
use App\Quadra;
use App\Reserva;
use App\Reserva_Opcional;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pega a data atual e o dia da semana
        $data = Carbon::now('America/Sao_Paulo');
        $data = Carbon::parse($data)->format('Y/m/d');
        $data2 = Carbon::parse($data)->format('d/m/Y');
        $today = Carbon::now()->dayOfWeek;
        
        // verifica qual dia da semana é e adiciona o dia a variavel $today
        switch ($today) {
            case 0:
                $today = 'domingo';
                break;
            case 1:
                $today = 'segunda';
                break;
            case 2:
                $today = 'terça';
                break;
            case 3:
                $today = 'quarta';
                break;
            case 4:
                $today = 'quinta';
                break;
            case 5:
                $today = 'sexta';
                break;
            case 6:
                $today = 'sabado';
                break;
        }
        
        // exibe as reservas do dia atual
        $dias = DB::table('reservas')
            ->join('quadras', 'quadra_id', '=', 'quadras.id')
            ->join('horarios', 'horario_id', '=', 'horarios.id')
            ->join('clientes', 'cliente_id', '=', 'clientes.id')
            ->select('reservas.id', 'data', 'tipo', 'horario', 'permanente', 'reservas.preco', 'clientes.nome')
            ->where('data', '=', $data)
            ->where('reservado', '=', 1)
            ->orWhere(function ($query) use ($data, $today) {
                $query->where('data', '<=', $data)
                    ->where('semana', '=', $today)
                    ->where('permanente', '=', 'Sim')
                    ->where('cancelado', '=', 0)
                    ->where('confirmado', '=', 0);                   
            })
            ->orderBy('horario')
            ->get();
            //dd($dias);
       
        // recupera o total de clientes, reservas, horários e opcionais
        $totalClientes = Cliente::count();
        $totalReservas = Reserva::count();
        $totalHorarios = Horario::count();
        $totalOpcionais = Opcional::count();

        return view('outros.home', compact('totalClientes', 'totalReservas', 'totalHorarios', 'totalOpcionais', 'reservas', 'dias', 'data2'));
    }

    public function detalhesReservas($id)
    {
        // posiciona no registro a ser visualizado
        $reserva = Reserva::find($id);

        $opcionais = Reserva_Opcional::join('opcionals', 'opcional_id', '=', 'opcionals.id')
            ->select('opcionals.nome')
            ->where('reserva_id', '=', $id)->get();
       
        return view('outros.reserva_detalhes', compact('reserva', 'opcionais'));
    }

    public function reservar($id)
    {
        // posiciona no registro a ser incluido
        $reg = Horario::find($id);

        // 2: Indica Inclusão
        $acao = 1;

        // Obtém clientes e quadras para exibir no form de cadastro
        $clientes = Cliente::orderBy('nome')->get();
        $quadras = Quadra::orderBy('tipo')->get();

        return view('formularios.reservas_form', compact('reg', 'acao', 'clientes', 'quadras'));
    }

    public function Pesquisa()
    {
        // Obtém clientes para exibir no formulário de pesquisa
        $quadras = Quadra::orderBy('tipo')->get();

        // obtém todos os horários do banco
        $horarios = Horario::All();

        return view('outros.pesq_horarios', compact('quadras', 'horarios'));
    }

    public function filtro(Request $request)
    {
        // obtém dados do form de pesquisa
        $data = $request->data;
        $quadra = $request->quadra_id;
        $splitName = explode(' ', $data, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        
        // exibe os horários que não possuem registro em outra tabela de acordo com os dados informados na pesquisa
        $horarios = Horario::doesntHave('reservas', 'or', function ($q) use ($data, $quadra, $first_name) {
            $q->where('data', '=', $data)
                ->where('quadra_id', '=', $quadra)
                ->orWhere(function ($query) use ($quadra, $first_name) {
                    $query->where('quadra_id', '=', $quadra)
                        ->where('semana', '=', $first_name)
                        ->where('cancelado', '=', 0)
                        ->where('confirmado', '=', 0); 
                });
        })

            ->orderBy('horario')
            ->get();
        
        // Obtém clientes e quadras para exibir no formulário de pesquisa
        $quadras = Quadra::orderBy('tipo')->get();

        return view('outros.pesq_horarios', compact('horarios', 'quadras', 'data'));
    }

}
