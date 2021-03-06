@extends('adminlte::page')

@section('title', 'Relatório Opcionais')

@section('content_header')
<div class="row" style="background-color: white; margin-inline-start: -15px; margin-inline-end: -20px; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Relatório Opcionais</p> 
        </div>
</div>

@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session('success') }}
    </div>
@endif  
<div class="box box-success">
    <div class="box-body">
<div class="col-sm-12" style="background: white">
    <form method="post" action="{{route('relatorio.opcional')}}">
        {{ csrf_field() }}

        <div class="col-sm-4">
                <div class="form-group">
                        <label for="dataIni"> Data inicial: </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="dataIni" name="dataIni" class="form-control">
                        </div>
                </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="dataFin"> Data final: </label>
                <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    <input type="text" id="dataFin" name="dataFin" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="quadra_id">Opcional:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-square"></i>
                    </div>
                    <select class="form-control" id="opcional_id" name="opcional_id">
                        <option value="0">Todos</option>
                        @foreach ($opcionais as $opcional)
                        <option value="{{$opcional->id}}"
                                @if ((isset($reg) && $reg->opcional_id==$opcional->id) 
                                or old('opcional_id') == $opcional->id) selected @endif>
                                {{$opcional->nome}}</option>
                        @endforeach       
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label> &nbsp; </label>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button> 
            </div>
           
        </div>
    </form>
    
</div>
</div>

@stop

@section('js')
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>  
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>

<script>
$('#dataIni').datepicker({     
    format: "yyyy/mm/dd",
    language: "pt-BR",
    //startDate: '+0d',
    orientation: "bottom",
    autoclose: true,
});
$('#dataFin').datepicker({     
    format: "yyyy/mm/dd",
    language: "pt-BR",
    //startDate: '+0d',
    orientation: "bottom",
    autoclose: true,
});

</script>

@stop

@section('css')
<link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
@stop


