@extends('adminlte::page')

@section('title', 'Cadastro de Reservas')

@section('content_header')

<div class='col-sm-11'>
        @if ($acao == 1)
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('reservas.index')}}" class="bred">Lista de Reservas ></a>
            <a href="#" class="bred">Cadastro de Reservas </a>
        </div>
        <h2> Cadastro de reserva </h2>
        @else
        <div class="bred">
            <a href="{{route('home')}}" class="bred">Home ></a>
            <a href="{{route('reservas.index')}}" class="bred">Lista de Reservas ></a>
            <a href="#" class="bred">Alteração de Reservas </a>
        </div>
        <h2> Alteração de reserva </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href="{{route('reservas.index')}}" class="btn btn-primary" 
           role="button"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>

@stop

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
    <div class="box box-primary">
            <div class="box-body">
    <form method="post" action="{{route('reservas.store')}}">
        @else
        <div class="box box-primary">
                <div class="box-body">
        <form method="post" action="{{route('reservas.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="clientes_id">Cliente:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user-circle-o"></i>
                        </div>
                        <select class="custom-select form-control form-control-sm" id="clientes_id" name="clientes_id">
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
                        <label for="quadra_id">Quadra:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
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
                <div class="form-group">
                    <label for="data">Data:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="data"
                               name="data" placeholder="Selecione a data da reserva"
                               value="{{$reg->data or old('data')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="horarios_id">Horário:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <select class="form-control" id="horarios_id" name="horarios_id">
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
                               name="valor" placeholder="Valor da reserva"
                               value="{{$reg->valor or old('valor')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>        
                <button type="reset" class="btn btn-warning"><i class="fa fa-eraser"></i> Limpar</button>  
            </div>
        </form>    
    </form>
</div>
@stop

@section('js')
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
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
</script>

@stop

@section('css')
<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
@stop


