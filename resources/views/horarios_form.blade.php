@extends('adminlte::page')

@section('title', 'Cadastro de Horários')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Cadastro de horário </h2>
    @else
    <h2> Alteração de horário </h2>
    @endif
</div>

<div class='col-sm-1'>
    <a href="{{route('horarios.index')}}" class="btn btn-primary" 
       role="button">Voltar</a>
</div>

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
    <form method="post" action="{{route('horarios.store')}}">
        @else
        <form method="post" action="{{route('horarios.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input class="form-control" type="text" id="hora" 
                                   name="hora" placeholder="Digite a hora"
                                   value="{{$reg->hora or old('hora')}}"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-usd"></i>
                            </div>
                            <input type="number" class="form-control" id="valor"
                                   name="valor" placeholder="Digite o valor da hora"
                                   value="{{$reg->valor or old('valor')}}"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>        
                    <button type="reset" class="btn btn-warning">Limpar</button>     
                </div> 
            </div>
        </form>    
    </form>
</div>

@stop

@section('js')
 
<script src="{{asset('/js/jquery.mask.min.js')}}"></script> 

<script>

$(document).ready(function () {
    $('#hora').mask("99:99 - 99:99" );
});
</script>
@endsection
