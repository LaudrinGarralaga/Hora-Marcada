@extends('adminlte::page')

@section('title', 'Lista de Reservas de Permanentes')

@section('content_header')

<div class='col-sm-11'>
    <h2> Reservas permanentes </h2>
</div>

@stop

@section('content')
<div class='col-sm-1'>
    <a href="{{route('permanentes.create')}}" class="btn btn-primary" 
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
                        <th>Cliente</th>
                        <th>Horário</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permanentes as $permanente)
                    <tr>
                        <td>{{$permanente->cliente->}}</td>
                        <td>{{$permanente->hora}}</td>
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


