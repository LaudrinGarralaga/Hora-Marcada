@extends('adminlte::page')

@section('title', 'Cadastro de Quadras')

@section('content_header')

<div class='col-sm-11'>
        @if ($acao == 1)
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('quadras.index')}}" class="bred">Lista de Quadras ></a>
            <a href="#" class="bred">Cadastro de Quadras </a>
        </div>
        <h2> Cadastro de quadra </h2>
        @else
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('quadras.index')}}" class="bred">Lista de Quadras ></a>
            <a href="#" class="bred">Alteração de Quadras </a>
        </div>
        <h2> Alteração de quadra </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href="{{route('quadras.index')}}" class="btn btn-primary" 
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
    <form method="post" action="{{route('quadras.store')}}">
        @else
        <div class="box box-primary">
            <div class="box-body">
        <form method="post" action="{{route('quadras.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
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

                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>        
                    <button type="reset" class="btn btn-warning"><i class="fa fa-eraser"></i> Limpar</button>     
                </div> 
            </div>
        </form>    
    </form>
</div>

@stop

