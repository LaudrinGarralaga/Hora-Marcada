@extends('adminlte::page')

@section('title', 'Pesquisa de reservas')

@section('content_header')

<div class='col-sm-11'>
    <h2> Pesquisar reservas </h2>
</div>

<div class='col-sm-1'>
    <br>
    <a href="{{route('reservas.pesq')}}" class="btn btn-primary" 
       role="button">Ver Todos</a>
</div>

<form method="post" action="{{route('reservas.filtros')}}">
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
    @if (count($reservas)==0)
    <div class="alert alert-danger">
        Nome informado não possui reserva...
    </div>

    @endif    

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Horário</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td style="text-align: center">{{$reserva->id}}</td>
                <td>{{$reserva->nome}}</td>
                <td>{{$reserva->telefone}}</td>
                <td>{{$reserva->email}}</td>
                <td>{{$reserva->horario}}</td>
                <td>{{$reserva->data}}</td>
                <td>
                    <a href="{{route('reservas.edit', $reserva->id)}}" 
                       class="btn btn-warning" 
                       role="button">Alterar</a> &nbsp;&nbsp;
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('reservas.destroy', $reserva->id)}}"
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
    {{ $reservas->links() }}
    <div class="box-footer"></div>
</div>
@stop
