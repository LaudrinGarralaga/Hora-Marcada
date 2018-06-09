@extends('adminlte::page')

@section('title', 'Lista de Opcionais')

@section('content_header')

<div class='col-sm-11'>
    <h2> Opcionais </h2>
</div>
@stop

@section('content')
<div class='col-sm-1'>
    <a href="{{route('opcionais.create')}}" class="btn btn-primary" 
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
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($opcionais as $opcional)
                    <tr>
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


