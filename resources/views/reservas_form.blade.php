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
    @include('includes.alerts')        


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
                    <label for="selHorario">Horário:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <select class="form-control" id="selHorario" name="selHorario">
                        <option value="">Selecione o horário</option>  
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selOp">Opcionais (ctrl para vários)</label>
                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                    </div>
                      <select class="custom-select mb-3" id="selOp" multiple size=5 style="width: 284px"></select>
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
                        <input type="text" class="form-control" id="inPreco"
                               name="inPreco" placeholder="Valor da reserva"
                               value="{{$reg->valor or old('valor')}}"
                               required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group"> 
                    <label for="status">Status:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <select class="form-control" id="status" name="status">
                            <option value="concluído" 
                        @if ((isset($reg) && $reg->status=="concluído") 
                            or old('status')) selected @endif>
                                                Concluído</option>
                                        <option value="reservado"
                        @if ((isset($reg) && $reg->status=="reservado") 
                            or old('status')) selected @endif>                        
                                                Reservado</option>
                                        <option value="cancelado"
                        @if ((isset($reg) && $reg->status=="cancelado") 
                            or old('status')) selected @endif>
                                                Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group"> 
                        <label for="permanente">Permanente:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-question"></i>
                            </div>
                            <select class="form-control" id="permanente" name="permanente">
                                <option value="sim" 
                            @if ((isset($reg) && $reg->permanente=="sim") 
                                or old('permanente')) selected @endif>
                                                    Sim</option>
                                            <option value="nao"
                            @if ((isset($reg) && $reg->permanente=="não") 
                                or old('permanente')) selected @endif>                        
                                                    Não</option>
                                            
                            </select>
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



var selHorario = document.getElementById("selHorario");
var inPreco = document.getElementById("inPreco");
var selOp = document.getElementById("selOp");

var precos = [];
var opcionais = [];

function carregarHorarios() {

  var url = "http://localhost/ws/lista_horarios.php";

  fetch(url)
    .then(resp => resp.json())
    .then(function (data) {
      for (var d of data) {
        var option = document.createElement("option");
        option.value = d.id;
        option.text = d.horario;
        selHorario.appendChild(option);
        precos.push({ id: d.id, horario: d.horario, preco: d.preco });
      }
    });
}
window.addEventListener("load", carregarHorarios);

function obterValor() {
  // alert(selHorario.value);
  var preco;
  if (selHorario.value == "") {
    preco = 0;
  } else {
    for (var p of precos) {
      if (selHorario.value == p.id) {
        preco = p.preco;
        break;
      }
    }
  }
  return Number(preco);
}
selHorario.addEventListener("change", function () {
 //inPreco.value = obterValor().toFixed(2);
inPreco.value = (obterValor() + verOp()).toFixed(2);

});

function carregarOpcionais() {

  var url = "http://localhost/ws/lista_opcionais.php";

  fetch(url)
    .then(resp => resp.json())
    .then(function (data) {
      for (var d of data) {
        var option = document.createElement("option");
        option.value = d.id;
        option.text = d.nome;
        selOp.add(option);
        opcionais.push({ id: d.id, nome: d.nome, preco: d.preco });
      }
    });
}
window.addEventListener("load", carregarOpcionais);

function verOp() {
  var total = 0;
  for (var i = 0; i < selOp.length; i++) {
    if (selOp[i].selected) {
      total = total + Number(opcionais[i].preco);
    }
  }
  return total;
}

selOp.addEventListener("change", function () {
  inPreco.value = (obterValor() + verOp()).toFixed(2);
});
</script>

@stop

@section('css')
<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
@stop


