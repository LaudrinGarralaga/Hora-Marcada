@extends('adminlte::page')

@section('title', 'Lista de Reservas')

@section('content_header')
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Reservas</p> 
        </div>
    </div>
    <br>
    <a href="{{route('reservas.create')}}" class="btn btn-primary" 
        role="button" style="margin-left: 85%"><i class="fa fa-plus"></i> Nova Reserva</a> 
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('success') }}
    </div>
@elseif (session('alter'))
    <div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('alter') }}
    </div>
@elseif (session('trash'))
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('trash') }}
    </div>
@endif  
   
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Reservas</h3>
        </div>
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Cliente</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Quadra</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Data</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Horário</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Status</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservas as $reserva)
                                        <tr>
                                            <td style="width: 20%">{{$reserva->cliente->nome}}</td>
                                            <td>{{$reserva->quadra->tipo}}</td>
                                            <td>{{ Carbon\Carbon::parse($reserva->data)->format('d/m/Y')}}</td>
                                            <td>{{$reserva->horario->horario}}</td>
                                            <td > 
                                                @if($reserva->reservado == 0 && $reserva->confirmado == 0)
                                                    <span class="label label-danger"> Cancelado</span>
                                                @elseif($reserva->confirmado == 0 && $reserva->cancelado == 0)
                                                    <span class="label label-info"> Reservado</span>
                                                @elseif($reserva->cancelado == 0 && $reserva->reservado == 0)
                                                    <span class="label label-success"> Confirmado</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center; width: 10%">
                                                @if($reserva->confirmado == 0 && $reserva->cancelado == 0)
                                                <span data-tooltip1="Confirmar"><a href="{{route('reservas.confirmar', $reserva->id)}}" 
                                                class="btn btn-success" role="button"><i class="fa fa-check"></i></a></span>
                                                <span data-tooltip2="Cancelar"><a href="{{route('reservas.cancelar', $reserva->id)}}" 
                                                    class="btn btn-danger" role="button"><i class="fa fa-times"></i></a></span>
                                                @else
                                                    
                                                @endif
                                            </td>
                                        </tr>      
                                        @endforeach        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th rowspan="1" colspan="1">Cliente</th>
                                        <th rowspan="1" colspan="1">Quadra</th>
                                        <th rowspan="1" colspan="1">Data</th>
                                        <th rowspan="1" colspan="1">Horário</th>
                                        <th rowspan="1" colspan="1">Status</th>
                                        <th rowspan="1" colspan="1">Ações</th>
                                        </tr> 
                                    </tfoot>
         </table>
 </div>
</div>
<div class="row">
 <div class="col-sm-5">
     <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
         <ul class="pagination"></ul>
     </div>
 </div>
 <div class="col-sm-7">
 </div>
</div>


</div>

@stop

@section('js')

<script src="{{asset('https://code.jquery.com/jquery-3.3.1.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js')}}"></script> 

<script>
$(document).ready(function() {
$('#example1').DataTable( {
"language": { "sEmptyTable": "Nenhum registro encontrado",
"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
"sInfoFiltered": "(Filtrados de _MAX_ registros)",
"sInfoPostFix": "",
"sInfoThousands": ".",
"sLengthMenu": "_MENU_ resultados por página",
"sLoadingRecords": "Carregando...",
"sProcessing": "Processando...",
"sZeroRecords": "Nenhum registro encontrado",
"sSearch": "Pesquisar",
"oPaginate": {
"sNext": "Próximo",
"sPrevious": "Anterior",
"sFirst": "Primeiro",
"sLast": "Último"
},
"oAria": {
"sSortAscending": ": Ordenar colunas de forma ascendente",
"sSortDescending": ": Ordenar colunas de forma descendente"
}
}
} );
} );
</script>
@stop

@section('css')
<link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css'>
<link rel="stylesheet" href='css/botao.css'>
@stop