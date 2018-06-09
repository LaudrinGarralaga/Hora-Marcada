@extends('adminlte::page')

@section('title', 'Fomulário de Reservas de Permanentes')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Reservar horário permanente </h2>
    @else
    <h2> Alteração de reservas permanentes </h2>
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
            <div class="form-group">
                <label for="nome">Nome do cliente:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user-circle-o"></i>
                    </div>
                    <input type="text" class="form-control" id="nome"
                           name="nome" placeholder="Digite o nome do cliente"
                           value="{{$reg->nome or old('nome')}}"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input type="tel" class="form-control" id="telefone"
                           name="telefone" placeholder="Digite o telefone do cliente"
                           value="{{$reg->telefone or old('telefone')}}"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" id="email"
                           name="email" placeholder="Digite o email do cliente"
                           value="{{$reg->email or old('email')}}"
                           required>
                </div>
            </div>
            <div class="col-sm-6">
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
            <div class="col-sm-6">
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
            <div class="form-group">
                <label for="hora">Horário:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control" id="hora"
                           name="hora" placeholder="Seleciona o horário da reserva"
                           value="{{$reg->hora or old('hora')}}"
                           required>
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
            <div class="form-group">
                <label for="valor">Valor total:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-usd"></i>
                    </div>
                    <input type="number" class="form-control" id="valor"
                           name="valor" 
                           value="{{$reg->valor or old('valor')}}"
                           required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>        
            <button type="reset" class="btn btn-warning">Limpar</button>  
        </form>    
    </form>
</div>
@endsection

@section('js')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="{{ asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>
<script src="{{asset('../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    $('#dataInicial').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        startDate: '+0d',
        autoclose: true
    });
    $('#dataFinal').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        startDate: '+0d',
        autoclose: true
    });
</script>
@endsection