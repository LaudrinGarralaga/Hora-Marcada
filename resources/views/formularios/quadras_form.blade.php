@extends('adminlte::page')

@section('title', 'Cadastro de Quadras')

@section('content_header')

@if ($acao == 1)
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Cadastro de Quadra</p> 
            </div>
        </div>
    @else
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Alteração de Quadra</p> 
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
    <div class="box box-success">
        <div class="box-body">
    <form method="post" action="{{route('quadras.store')}}">
        @else
        <div class="box box-success">
            <div class="box-body">
        <form method="post" action="{{route('quadras.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
                <div class="col-sm-6">
                        <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-square"></i>
                            </div>
                            <input class="form-control" type="text" id="tipo" 
                                   name="tipo" placeholder="Digite o tipo da quadra"
                                   value="{{$reg->tipo or old('tipo')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="tipo">Valor:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-usd"></i>
                            </div>
                            <input class="form-control" type="text" id="preco" 
                                   name="preco" placeholder="Digite o preço da quadra"
                                   value="{{$reg->preco or old('preco')}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>        
                    <button type="reset" class="btn btn-warning"><i class="fa fa-eraser"></i> Limpar</button> 
                </div>    
                </div> 
            </div>
        </form>    
    </form>
</div>

@stop

