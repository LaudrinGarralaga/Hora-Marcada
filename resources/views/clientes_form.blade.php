@extends('adminlte::page')

@section('title', 'Cadastrp de Clientes')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Cadastrar Cliente </h2>
    @else
    <h2> Alterar dados do cliente </h2>
    @endif
</div>
<div class='col-sm-1'>
    <a href="{{route('clientes.index')}}" class="btn btn-primary" 
       role="button">Voltar</a>
</div>

@endsection

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
    <div class="box box-primary"></div>
    <form method="post" action="{{route('clientes.store')}}">
        @else
        <form method="post" action="{{route('clientes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome do cliente:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user-circle-o"></i>
                    </div>
                    <input type="text" class="form-control" id="nome"
                           name="nome" placeholder="Digite o nome do cliente"
                           value="{{$reg->nome or old('nome')}}"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input  type="text" class="form-control" id="telefone"  
                            name="telefone" placeholder="Digite o telefone do cliente"
                            value="{{$reg->telefone or old('telefone')}}"
                            required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" id="email"
                           name="email" placeholder="Digite o email do cliente"
                           value="{{$reg->email or old('email')}}"
                           required>
                </div>
            
            <button type="submit" class="btn btn-primary">Enviar</button>        
            <button type="reset" class="btn btn-warning">Limpar</button>  
        </form>    
    </form>
</div>
@endsection

