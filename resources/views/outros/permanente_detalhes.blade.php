@extends('adminlte::page')

@section('title', 'Detalhes Permanente')

@section('content_header')

<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Detalhes da Permamente</p> 
        </div>
    </div>
    
@stop

@section('content')
    <section class="col-sm-4">

        <ul class="list-group">
            <li class="list-group-item">
                Cliente: <strong>{{$permanente->cliente->nome}}</strong>
             </li>

            <li class="list-group-item">
                Data: <strong>{{Carbon\Carbon::parse($permanente->data)->format('d/m/Y')}}</strong>
            </li>

            <li class="list-group-item">
                Horário: <strong>{{$permanente->horario->horario}}</strong>
            </li>

            <li class="list-group-item">
                Quadra: <strong>{{$permanente->quadra->tipo}}</strong>
            </li>

            <li class="list-group-item">
                Valor: <strong>{{$permanente->preco}}</strong>
            </li>

            <li class="list-group-item">
                Opcionais:
                @foreach($opcionais as $opcional)
                 <strong>{{$opcional->nome}},</strong>
                @endforeach
            </li>

        </ul>
    
                <a href="{{route('permanentes.cancelar', $permanente->id)}}" 
                        class="btn btn-danger" 
                        role="button"><i class="fa fa-times"></i> Cancelar</a>
    </section>

@stop