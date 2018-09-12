@extends('adminlte::page')

@section('title', 'Lista de Opcionais')

@section('content_header')

<div class="bred">
    <a href="{{route('home')}}" class="bred">Home ></a>
    <a href="#" class="bred">Lista de Opcionais</a>
    <a href="{{route('opcionais.create')}}" class="btn btn-primary" 
        role="button" style="margin-left: 672px"><i class="fa fa-plus"></i> Novo Opcional</a>
    <a href="{{URL::TO('getPDFOpcionais')}}" class="btn btn-success" id="imprimirPDF"
        role="button"><i class="fa fa-print"></i> Imprimir PDF</a>  
</div>

@stop

@section('content')

@include('includes.alerts')
   
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Lista de Opcionais</h3>
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 30%">Opcional</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 30%">Valor</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 30%">Ações</th>
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
                               role="button"><i class="fa fa-pencil"></i> Alterar</a>
                               <button class="btn btn-danger" data-catid={{$opcional->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Deletar</button> 
                        </td>
                    </tr>
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title text-center" id="myModalLabel">Confirmar Exclusão</h4>
                                </div>
                                <form action="{{route('opcionais.destroy', $opcional->id)}}" method="post">
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
                      <th rowspan="1" colspan="1">Opcional</th>
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






