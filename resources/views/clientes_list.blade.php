@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')

<div class='col-sm-11'>
    <h2> Clientes </h2>
</div>
@stop

@section('content')
<div class='col-sm-1'>
    <a href="{{route('clientes.create')}}" class="btn btn-primary" 
       role="button">Novo</a>
</div>

<div class='col-sm-12'>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif  
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente) 
                    <tr>
                        <td> {{$cliente->nome}} </td>
                        <td> {{$cliente->email}} </td>
                        <td> {{$cliente->telefone}} </td>
                        <td> <a href='{{route('clientes.edit', $cliente->id)}}'
                                class='btn btn-warning' 
                                role='button'> Alterar </a>
                            <form style="display: inline-block"
                                  method="post"
                                  action="{{route('clientes.destroy', $cliente->id)}}"
                                  onsubmit="return confirm('Confirma Exclusão?')">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="btn btn-danger"> Excluir </button>
                            </form>              

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
            {{ $clientes->links() }}      
            <div class="box-footer"></div>
        </div>
    </div>
</div>
@stop
