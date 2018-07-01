@extends('adminlte::page')

@section('title', 'Pesquisa de Clientes')

@section('content_header')

<div class='col-sm-11'>
    <h2> Pesquisa de clientes </h2>
</div>

<div class='col-sm-1'>
    <br>
    <a href="{{route('clientes.pesq')}}" class="btn btn-primary" 
       role="button">Ver Todos</a>
</div>

<form method="post" action="{{route('clientes.filtros')}}">
    {{ csrf_field() }}

    <div class='col-sm-6'>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome"
                   name="nome">
        </div>
    </div>
    <div class='col-sm-1'>
        <label> &nbsp; </label>
        <button type="submit" class="btn btn-warning">Pesquisar</button>            
    </div>    
</form>

<div class='col-sm-12'>
    @if (count($clientes)==0)
    <div class="alert alert-danger">
        Não há clientes com o nome informado...
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
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>{{$cliente->telefone}}</td>
                        <td>
                            <a href="{{route('clientes.edit', $cliente->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a> &nbsp;&nbsp;
                            <form style="display: inline-block"
                                  method="post"
                                  action="{{route('clientes.destroy', $cliente->id)}}"
                                  onsubmit="return confirm('Confirma Exclusão?')">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <button type="submit"
                                        class="btn btn-danger"> Excluir </button>
                            </form> &nbsp;&nbsp;

                        </td>
                    </tr>

                    @endforeach        
                </tbody>
            </table>    
            <div class="box-footer"></div>
            {{ $clientes->links() }}
        </div>
    </div>
</div>

@stop



