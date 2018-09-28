@extends('adminlte::page')

@section('title', 'Cadastro do Opcionais')

@section('content_header')
@if ($acao == 1)
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Cadastro de Opcional</p> 
            </div>
        </div>
    @else
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Alteração de Opcional</p> 
            </div>
        </div>
    @endif
@stop

@section('content')

<div class='col-sm-12'>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif        

    @if ($acao == 1)
    <div class="box box-primary">
        <div class="box-body">    
    <form method="post" action="{{route('opcionais.store')}}">
        @else
        <div class="box box-primary">
            <div class="box-body">
        <form method="post" action="{{route('opcionais.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <input type="text" class="form-control" id="nome"
                               name="nome" placeholder="Digite o nome do opcional"
                               value="{{$reg->nome or old('nome')}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="number" class="form-control" id="preco"
                               name="preco" placeholder="Digite a valor do opcional"
                               value="{{$reg->preco or old('preco')}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>        
                <button type="reset" class="btn btn-warning"><i class="fa fa-eraser"></i> Limpar</button>
            </div>
        </form>    
    </form>
</div>

@stop
