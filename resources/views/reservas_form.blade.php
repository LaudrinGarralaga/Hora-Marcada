@extends('adminlte::page')

@section('title', 'Fomulário de Reservas')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Reservar horário </h2>
    @else
    <h2> Alteração de reserva </h2>
    @endif
</div>
<div class='col-sm-1'>
    <a href="{{route('reservas.index')}}" class="btn btn-primary" 
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
    <form method="post" action="{{route('reservas.store')}}">
        @else
        <form method="post" action="{{route('reservas.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="clientes_id">Cliente:</label>
                    <select class="form-control" id="clientes_id" name="clientes_id">
                        @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}"
                                @if ((isset($reg) && $reg->clientes_id==$cliente->id) 
                                or old('clientes_id') == $cliente->id) selected @endif>
                                {{$cliente->nome}}</option>
                        @endforeach       
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="horarios_id">Horário:</label>
                    <select class="form-control" id="horarios_id" name="horarios_id">
                        @foreach ($horarios as $horario)
                        <option value="{{$horario->id}}"
                                @if ((isset($reg) && $reg->horarios_id==$horario->id) 
                                or old('horarios_id') == $horario->id) selected @endif>
                                {{$horario->hora}}</option>
                        @endforeach       
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Opcional 1</label>
                    <select class="form-control">
                        <option>Bola</option>
                        <option>Churrasquira</option>
                        <option>Colete</option>
                        <option>Rede de volei</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Opcional 2</label>
                    <select class="form-control">
                        <option>Bola</option>
                        <option>Churrasquira</option>
                        <option>Colete</option>
                        <option>Rede de volei</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Opcional 3</label>
                    <select class="form-control">
                        <option>Bola</option>
                        <option>Churrasquira</option>
                        <option>Colete</option>
                        <option>Rede de volei</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Opcional 4</label>
                    <select class="form-control">
                        <option>Bola</option>
                        <option>Churrasquira</option>
                        <option>Colete</option>
                        <option>Rede de volei</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="valor">Valor total:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" class="form-control" id="valor"
                               name="valor" 
                               value="{{$reg->valor or old('valor')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Opcionais</label>
                    <select name="framework" id="framework" class="form-control selectpicker" data-live-search="true" multiple>
                        <option value="Mustang">Mustang</option>
                        <option value="Ketchup">Ketchup</option>
                        <option value="Relish">Relish</option>
                    </select>
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
$('#data').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    startDate: '+0d',
    autoclose: true
});
$(document).ready(function () {
    $('#telefone').mask('(00)0000-0000');
});
$(document).ready(function () {
    $('.selectpicker').selectpicker();

});
</script>
@endsection


