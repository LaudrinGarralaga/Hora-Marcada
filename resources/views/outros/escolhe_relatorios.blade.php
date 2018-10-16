@extends('adminlte::page')

@section('title', 'Selecionar Relatório')

@section('content_header')
<div class="row" style="background-color: white; margin-inline-start: -15px; margin-inline-end: -20px; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Selecionar Relatório</p> 
        </div>
</div>

@stop

@section('content')


<div class="container" style="background: white">
    <form method="post" action="{{route('graficos.filtro')}}">
        {{ csrf_field() }}          
        <div class="col-sm-10">
            <div class="form-group">
                <label for="tipo"> Selecione o tipo de relatório: </label>
                <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text"></i>
                        </div>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="financeiro"> Financeiro</option>
                        <option value="cliente"> Cliente</option>
                        <option value="data"> Data</option>
                        <option value="quadra"> Quadra</option>
                        <option value="horario"> Horário</option>
                    </select>
                </div>
            </div>
        </div>
            
        <div class="col-sm-1">
            <div class="form-group">
                <label> &nbsp; </label>
                <button type="submit" class="btn btn-primary"><i class="fa fa-mouse-pointer"></i> Selecionar</button>
            </div>            
        </div>
    </form>        
</div>

@stop