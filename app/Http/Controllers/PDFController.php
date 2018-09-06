<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Cliente;
use App\Horario;
use App\Quadra;
use App\Opcional;
use App\Reserva;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function getPDFClientes(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $customers=Cliente::all();
        $pdf=PDF::loadView('pdf.clientes', ['customers'=>$customers]);
        return $pdf->download('Lista de clientes.pdf');
    }

    public function getPDFHorarios(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $customers=Horario::all();
        $pdf=PDF::loadView('pdf.horarios', ['customers'=>$customers]);
        return $pdf->download('Lista de horarios.pdf');
    }

    public function getPDFOpcionais(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $customers=Opcional::all();
        $pdf=PDF::loadView('pdf.opcionais', ['customers'=>$customers]);
        return $pdf->download('Lista de opcionais.pdf');
    }

    public function getPDFQuadras(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $customers=Quadra::all();
        $pdf=PDF::loadView('pdf.quadras', ['customers'=>$customers]);
        return $pdf->download('Lista de quadras.pdf');
    }

    public function getPDFReservas(){

        if (!Auth::check()) {
            return redirect('/');
        }

        $customers=Reserva::all();
        $pdf=PDF::loadView('pdf.reservas', ['customers'=>$customers]);
        return $pdf->download('Lista de reservas.pdf');
    }


}
