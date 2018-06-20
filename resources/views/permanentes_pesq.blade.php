@extends('adminlte::page')

@section('title', 'Pesquisa de reservas permanentes')

@section('content_header')

<div class='col-sm-11'>
    <h2>Pesquisar reservas permanentes</h2>
</div>

<div class='col-sm-1'>
    <br>
    <a href="{{route('permanentes.pesq')}}" class="btn btn-primary" 
       role="button">Ver Todos</a>
</div>

<form method="post" action="{{route('permanentes.filtros')}}">
    {{ csrf_field() }}

    <div class='col-sm-6'>
        <div class="form-group">
            <label for="nome">Nome do Cliente:</label>
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
    @if (count($permanentes)==0)
    <div class="alert alert-danger">
        Nome informado não possui reserva...
    </div>

    @endif    
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Horário</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($permanentes as $permanente)
                    <tr>
                        <td style="text-align: center">{{$permanente->id}}</td>
                        <td>{{$permanente->nome}}</td>
                        <td>{{$permanente->telefone}}</td>
                        <td>{{$permanente->email}}</td>
                        <td>{{$permanente->horario}}</td>
                        <td>{{$permanente->dataInicial}}</td>
                        <td>{{$permanente->dataFinal}}</td>
                        <td>
                            <a href="{{route('permanentes.edit', $permanente->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a> &nbsp;&nbsp;
                            <form style="display: inline-block"
                                  method="post"
                                  action="{{route('permanentes.destroy', $permanente->id)}}"
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
            {{ $permanentes->links() }}
            <div class="box-footer"></div>
        </div>
    </div>
</div>
@stop