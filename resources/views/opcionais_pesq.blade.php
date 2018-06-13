@extends('adminlte::page')

@section('title', 'Pesquisa de Opcionais')

@section('content_header')

<div class='col-sm-11'>
    <h2> Pesquisa de Opcionais </h2>
</div>

<div class='col-sm-1'>
    <br>
    <a href="{{route('opcionais.pesq')}}" class="btn btn-primary" 
       role="button">Ver Todos</a>
</div>

<form method="post" action="{{route('opcionais.filtros')}}">
    {{ csrf_field() }}

    <div class='col-sm-6'>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao"
                   name="descricao">
        </div>
    </div>
    <div class='col-sm-1'>
        <label> &nbsp; </label>
        <button type="submit" class="btn btn-warning">Pesquisar</button>            
    </div>    
</form>

<div class='col-sm-12'>
    @if (count($opcionais)==0)
    <div class="alert alert-danger">
        Não há opcionais com a descrição informada...
    </div>

    @endif    
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($opcionais as $opcional)
                    <tr>
                        <td style="text-align: center">{{$opcional->id}}</td>
                        <td>{{$opcional->descricao}}</td>
                        <td>{{$opcional->valor}}</td>
                        <td>
                            <a href="{{route('opcionais.edit', $opcional->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a> &nbsp;&nbsp;
                            <form style="display: inline-block"
                                  method="post"
                                  action="{{route('opcionais.destroy', $opcional->id)}}"
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
            {{ $opcionais->links() }}
            <div class="box-footer"></div>
        </div>
    </div>
</div>

@stop
