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

    <div class='col-sm-4'>
        <div class="form-group">
            <label for="data">Data da Reserva:</label>
            <input type="text" class="form-control" id="data"
                   name="data">
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
        Data informada não possui reserva...
    </div>

    @endif    
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                    <tr>
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
                        <td>{{$permanente->cliente->nome}}</td>
                        <td>{{$permanente->cliente->telefone}}</td>
                        <td>{{$permanente->cliente->email}}</td>
                        <td>{{$permanente->horario->hora}}</td>
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
            <div class="box-footer"></div>
            {{ $permanentes->links() }}
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
<link href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css')}}" rel="stylesheet" >
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>

<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>  
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>

<script>
$('#data').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    startDate: '+0d',
    orientation: "bottom",
    autoclose: true
});

$(document).ready(function () {
    $('.selectpicker').selectpicker();

});
</script>
@endsection