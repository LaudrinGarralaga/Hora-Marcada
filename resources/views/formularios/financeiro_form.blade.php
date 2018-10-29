@extends('adminlte::page')

@section('title', 'Pesquisa de Horários')

@section('content_header')
<div class="row" style="background-color: white; margin-top: -35px; height: 55px">
    <div class="bred">
        <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Disponibilidade de Horários</p> 
    </div>
</div>

@stop

@section('content')

<div class='box'>
    <div class="box box-primary">
            <div class="box-body">
        <form method="post" action="{{route('horarios.filtro')}}">
            {{ csrf_field() }}

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="data" style="font-family: Arial, Helvetica, sans-serif"> Selecione a data para verificar a disponibilidade </label>
                    <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        <input type="text" id="data" name="data" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="quadra_id"style="font-family: Arial, Helvetica, sans-serif">Selecione a quadra:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-square"></i>
                        </div>
                        <select class="form-control" id="quadra_id" name="quadra_id">
                            @foreach ($quadras as $quadra)
                            <option value="{{$quadra->id}}"
                                    @if ((isset($reg) && $reg->quadra_id==$quadra->id) 
                                    or old('quadra_id') == $quadra->id) selected @endif>
                                    {{$quadra->tipo}}</option>
                            @endforeach       
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="box">
    <div class="box-header">
         <h3 class="box-title">Lista de horários disponíveis</h3>
    </div>
    <div class="box-body">    
        @forelse($horarios as $horario)
        <article class="result col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="well well-lg" style="background-color: white">
                <img src="{{url('imagens/relogio.png')}}" style="width: 100%">

                <div class="legend">
                    <p>Horário: {{$horario->horario}}</p>
                    <p>Valor: {{$horario->preco}}</p>                   
                </div>
                <a href='{{route('reservar.horario', $horario->id)}}' class="btn btn-primary" style="width: 100%">
                        Reservar
                </a>
            </div>
        </article>
        @empty
           <h1 style="text-align: center; color: red"><b><u>Sem horários diponíveis para o dia e a quarda selecionados!</u></b></h1> 
        @endforelse
    </div>
</div>
   
@stop

@section('js')

<script src="{{asset('https://code.jquery.com/jquery-3.3.1.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js')}}"></script> 
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>  
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>

<script>
$('#data').datepicker({     
    format: "DD dd/mm/yyyy",
    language: "pt-BR",
    startDate: '+0d',
    orientation: "bottom",
    autoclose: true,
});
</script>

@stop

@section('css')
    <link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css'>'
@stop




