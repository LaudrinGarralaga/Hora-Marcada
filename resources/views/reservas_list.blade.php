@extends('adminlte::page')

@section('title', 'Lista de Reservas')

@section('content_header')

<div class="bred">
    <a href="{{route('home')}}" class="bred">Home ></a>
    <a href="#" class="bred">Lista de Reservas</a>
    <a href="{{route('reservas.create')}}" class="btn btn-primary" 
        role="button" style="margin-left: 800px"><i class="fa fa-plus"></i> Nova Reserva</a> 
</div>
@stop

@section('content')

@include('includes.alerts')
   
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Valor</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @foreach($reservas as $reserva)
                    <tr>
                        <td>{{$reserva->cliente->nome}}</td>
                        <td>{{$reserva->quadra->tipo}}</td>
                        <td>{{$reserva->data}}</td>
                        <td>{{$reserva->horario->hora}}</td>
                        <td>{{$reserva->valor}}</td>
                        <td>
                            <a href="{{route('reservas.edit', $reserva->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a>
                               <button class="btn btn-danger" data-catid={{$reserva->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button> 
                        </td>
                    </tr>
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title text-center" id="myModalLabel">Confirmar Exclusão</h4>
                                </div>
                                <form action="{{route('reservas.destroy', $reserva->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                          <p class="text-center">
                                              Tem certeza que deseja excluir o registro?
                                          </p>
                                            <input type="hidden" name="category_id" id="cat_id" value="">
                          
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Não, Cancelar</button>
                                      <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i> Sim, Deletar</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                    </div>
                    @endforeach        
                </tbody>
                <tfoot>
                    <tr>
                      <th rowspan="1" colspan="1">Cliente</th>
                      <th rowspan="1" colspan="1">Quadra</th>
                      <th rowspan="1" colspan="1">Data</th>
                      <th rowspan="1" colspan="1">Horário</th>
                      <th rowspan="1" colspan="1">Valor</th>
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
@stop