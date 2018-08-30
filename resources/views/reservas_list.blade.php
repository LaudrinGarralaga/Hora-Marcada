@extends('adminlte::page')

@section('title', 'Lista de Reservas')

@section('content_header')

<div class="col-sm-11">
    <h2> Lista de reservas </h2>
</div>
@stop

@section('content')
<div class='col-sm-1'>
    <a href="{{route('reservas.create')}}" class="btn btn-primary" 
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
                        <th>Quadra</th>
                        <th>Horário</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($reservas as $reserva)
                    <tr>
                        <td>{{$reserva->cliente->nome}}</td>
                        <td>{{$reserva->horario->hora}}</td>
                        <td>{{$reserva->data}}</td>
                        <td>
                            <a href="{{route('reservas.edit', $reserva->id)}}" 
                               class="btn btn-warning" 
                               role="button">Alterar</a> &nbsp;&nbsp;
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
            </table>    
            <div class="box-footer"></div>
           
        </div>
    </div>
</div>
@stop
