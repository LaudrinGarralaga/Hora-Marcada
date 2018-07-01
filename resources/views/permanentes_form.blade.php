@extends('adminlte::page')

@section('title', 'Cadastro de Permanentes')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Reservar horário permanente </h2>
    @else
    <h2> Alteração de reserva permanente </h2>
    @endif
</div>

<div class='col-sm-1'>
    <a href="{{route('permanentes.index')}}" class="btn btn-primary" 
       role="button">Voltar</a>
</div>

@endsection

@section('content')
<div class='col-sm-12'>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif        

    @if ($acao == 1)
    <div class="box box-primary"></div>
    <form method="post" action="{{route('permanentes.store')}}">
        @else
        <form method="post" action="{{route('permanentes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="cliente_id">Cliente:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user-circle-o"></i>
                        </div>
                        <select class="form-control" id="cliente_id" name="cliente_id">
                            @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}"
                                    @if ((isset($reg) && $reg->cliente_id==$cliente->id) 
                                    or old('cliente_id') == $cliente->id) selected @endif>
                                    {{$cliente->nome}}</option>
                            @endforeach       
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="dataInicial">Data Inicial:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="dataInicial"
                               name="dataInicial" placeholder="Selecione a data inicial da reserva"
                               value="{{$reg->dataInicial or old('dataInicial')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="dataFinal">Data Final:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="dataFinal"
                               name="dataFinal" placeholder="Selecione a data final da reserva"
                               value="{{$reg->dataFinal or old('dataFinal')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="horario_id">Horário:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <select class="form-control" id="horario_id" name="horario_id">
                            @foreach ($horarios as $horario)
                            <option value="{{$horario->id}}"
                                    @if ((isset($reg) && $reg->horario_id==$horario->id) 
                                    or old('horario_id') == $horario->id) selected @endif>
                                    {{$horario->hora}}</option>
                            @endforeach       
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" class="form-control" id="valor"
                               name="valor" placeholder="Digite o valor da reserva"
                               value="{{$reg->valor or old('valor')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Enviar</button>        
                <button type="reset" class="btn btn-warning">Limpar</button>  
            </div>
        </form>    
    </form>
</div>
@endsection

@section('js')
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
<link href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css')}}" rel="stylesheet" >
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
<link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css')}}" rel="stylesheet">
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js')}}"></script>


<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>
<script src="{{asset('../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>
$('#dataInicial').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    startDate: '+0d',
    orientation: "bottom",
    autoclose: true
});
$('#dataFinal').datepicker({
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