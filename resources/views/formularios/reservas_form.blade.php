@extends('adminlte::page')

@section('title', 'Cadastro de Reservas')

@section('content_header')

    @if ($acao == 1)
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Cadastro de Reserva</p> 
            </div>
        </div>
    @else
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Alteração de Reserva</p> 
            </div>
        </div>
    @endif
   
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
                        <select class="custom-select form-control form-control-sm" id="cliente_id" name="cliente_id">
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
                    <label for="horario_id">Horário:</label>
                    <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <select class="custom-select form-control form-control-sm" id="horario_id" name="horario_id">
                                @foreach ($horarios as $horario)
                                <option value="{{$horario->id}}"
                                        @if ((isset($reg) && $reg->horario_id==$horario->id) 
                                        or old('horario_id') == $horario->id) selected @endif>
                                        {{$horario->horario}}</option>
                                @endforeach       
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
                      <select class="custom-select mb-3" id="selOp" multiple size=3 style="width: 284px"></select>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="Preco">Valor:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" class="form-control" id="Preco"
                               name="Preco" placeholder="Valor da reserva"
                               value="{{$reg->preco or old('preco')}}"
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
                                            <option value="não"
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
    format: "DD yyyy/mm/dd",
    language: "pt-BR",
    //startDate: '+0d',
    orientation: "bottom",
    autoclose: true,
});

var quadra_id = document.getElementById("quadra_id");
var Preco = document.getElementById("Preco");
var selOp = document.getElementById("selOp");

var precos = [];
var opcionais = [];

function carregarQuadras() {

  var url = "http://localhost/WebServiceTCC/SisWeb/lista_quadras.php";

  fetch(url)
    .then(resp => resp.json())
    .then(function (data) {
      for (var d of data) {
        var option = document.createElement("option");
        option.value = d.id;
        option.text = d.tipo;
        quadra_id.appendChild(option);
        precos.push({ id: d.id, tipo: d.tipo, preco: d.preco });
      }
    });
}
window.addEventListener("load", carregarQuadras);

function obterValor() {
  // alert(horario_id.value);
  var preco;
  if (quadra_id.value == "") {
    preco = 0;
  } else {
    for (var p of precos) {
      if (quadra_id.value == p.id) {
        preco = p.preco;
        break;
      }
    }
  }
  return Number(preco);
}
quadra_id.addEventListener("change", function () {
 //Preco.value = obterValor().toFixed(2);
Preco.value = (obterValor() + verOp()).toFixed(2);

});

function carregarOpcionais() {

  var url = "http://localhost/WebServiceTCC/SisWeb/lista_opcionais.php";

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
  Preco.value = (obterValor() + verOp()).toFixed(2);
});
</script>

@stop

@section('css')
<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
@stop


