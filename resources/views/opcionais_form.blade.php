@extends('adminlte::page')

@section('title', 'Cadastro do Opcionais')

@section('content_header')

<div class='col-sm-11'>
        @if ($acao == 1)
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('opcionais.index')}}" class="bred">Lista de Opcionais ></a>
            <a href="#" class="bred">Cadastro de Opcional </a>
        </div>
        <h2> Cadastro de opcional </h2>
        @else
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('opcionais.index')}}" class="bred">Lista de Opcionais ></a>
            <a href="#" class="bred">Alteração de Opcional </a>
        </div>
        <h2> Alteração de opcional </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href="{{route('opcionais.index')}}" class="btn btn-primary" 
           role="button"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
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
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <input type="text" class="form-control" id="descricao"
                               name="descricao" placeholder="Digite o nome do opcional"
                               value="{{$reg->descricao or old('descricao')}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" class="form-control" id="valor"
                               name="valor" placeholder="Digite a valor do opcional"
                               value="{{$reg->valor or old('valor')}}">
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
