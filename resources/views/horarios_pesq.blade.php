@extends('adminlte::page')

@section('title', 'Pesquisa de Opcionais')

@section('content_header')

<div class='col-sm-11'>
    <h2> Pesquisa de Horários </h2>
</div>

<div class='col-sm-1'>
    <br>
    <a href="{{route('horarios.pesq')}}" class="btn btn-primary" 
       role="button">Ver Todos</a>
</div>

<form method="post" action="{{route('horarios.filtros')}}">
    {{ csrf_field() }}

    <div class='col-sm-6'>
        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="text" class="form-control" id="hora"
                   name="hora">
        </div>
    </div>
    <div class='col-sm-1'>
        <label> &nbsp; </label>
        <button type="submit" class="btn btn-warning">Pesquisar</button>            
    </div>    
</form>

<div class='col-sm-12'>
    @if (count($horarios)==0)
    <div class="alert alert-danger">
        Não há horários com a hora informada...
    </div>

    @endif    
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($horarios as $horario)
                    <tr>
                        <td style="text-align: center">{{$horario->id}}</td>
                        <td>{{$horario->hora}}</td>
                        <td>{{$horario->valor}}</td>
                        <td>
                            <a href="{{route('horarios.edit', $horario->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a> &nbsp;&nbsp;
                            <form style="display: inline-block"
                                  method="post"
                                  action="{{route('horarios.destroy', $horario->id)}}"
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
            {{ $horarios->links() }}
            <div class="box-footer"></div>
        </div>
    </div>
</div>

@stop


