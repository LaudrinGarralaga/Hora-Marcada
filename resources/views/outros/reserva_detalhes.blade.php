@extends('adminlte::page')

@section('title', 'Detalhes Reserva')

@section('content_header')

<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Detalhes da Reserva</p> 
        </div>
    </div>
    
@stop

@section('content')
    <section class="col-sm-4">

        <ul class="list-group">
            <li class="list-group-item">
                Cliente: <strong>{{$reserva->cliente->nome}}</strong>
             </li>

            <li class="list-group-item">
                Data: <strong>{{Carbon\Carbon::parse($reserva->data)->format('d/m/Y')}}</strong>
            </li>

            <li class="list-group-item">
                Dia da semana: <strong>{{$reserva->semana}}</strong>
            </li>

            <li class="list-group-item">
                Horário: <strong>{{$reserva->horario->horario}}</strong>
            </li>

            <li class="list-group-item">
                Quadra: <strong>{{$reserva->quadra->tipo}}</strong>
            </li>

            <li class="list-group-item">
                Valor: <strong>{{$reserva->preco}}</strong>
            </li>

            <li class="list-group-item">
                Permanente: <strong>{{$reserva->permanente}}</strong>
            </li>

            <li class="list-group-item">
                Opcionais:
                @foreach($opcionais as $opcional)
                 <strong>{{$opcional->nome}},</strong>
                @endforeach
            </li>

        </ul>
        <a href="{{route('reservas.confirmar', $reserva->id)}}" 
                class="btn btn-success" 
                role="button"><i class="fa fa-check"></i> Confirmar</a>
                <a href="{{route('reservas.cancelar', $reserva->id)}}" 
                        class="btn btn-danger" 
                        role="button"><i class="fa fa-times"></i> Cancelar</a>
    </section>
@stop