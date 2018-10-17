@extends('adminlte::page')

@section('title', 'Detalhes Local')

@section('content_header')

<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Detalhes da Local</p> 
        </div>
    </div>
    
@stop

@section('content')
    <section class="col-sm-4">
        @forelse ($locais as $local) 
        <ul class="list-group">
            
            <li class="list-group-item">
                Nome do local: <strong>{{$local->nome}}</strong>
            </li>
            
            <li class="list-group-item">
                Endereço: <strong>{{$local->endereco}}</strong>
             </li>

            <li class="list-group-item">
                Número: <strong>{{$local->numero}}</strong>
            </li>

            <li class="list-group-item">
                Complemento: <strong>{{$local->complemento}}</strong>
            </li>

            <li class="list-group-item">
                Cidade: <strong>{{$local->cidade}}</strong>
            </li>

            <li class="list-group-item">
                Bairro: <strong>{{$local->bairro}}</strong>
            </li>

            <li class="list-group-item">
                Cep: <strong>{{$local->cep}}</strong>
            </li>

            <li class="list-group-item">
                Telefone: <strong>{{$local->telefone}}</strong>
            </li>
           
        </ul>
        <a href="{{route('locais.create')}}" 
            class="btn btn-success" 
            role="button"><i class="fa fa-plus"></i> Novo</a>
        <a href="{{route('locais.edit', $local->id)}}" 
            class="btn btn-warning" 
            role="button"><i class="fa fa-pencil"></i> Alterar</a>
        @empty
    
                <h1>Não há local cadastrado, cadastre um novo local.</h1>
                <a href="{{route('locais.create')}}" 
                class="btn btn-success" 
                role="button"><i class="fa fa-plus"></i> Novo</a>
                 
        @endforelse
        
    </section>
@stop