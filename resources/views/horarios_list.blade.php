@extends('adminlte::page')

@section('title', 'Lista de Opcionais')

@section('content_header')

<div class='col-sm-11'>
    <h2> Lista de Horários </h2>
</div>
@endsection

@section('content')
<div class='col-sm-1'>
    <a href="{{route('horarios.create')}}" class="btn btn-primary" 
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
                        <th>Hora</th>
                        <th>Valor R$</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($horarios as $horario)
                    <tr>
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
                            </form> 
                        </td>
                    </tr>
                    @endforeach        
                </tbody>
            </table>    
            <div class="box-footer"></div>
            {{ $horarios->links() }}
        </div>
    </div>
</div>
@endsection




