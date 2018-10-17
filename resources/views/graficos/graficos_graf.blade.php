@extends('adminlte::page')

@section('title', 'Gráficos Gerenciais')

@section('content_header')
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
    <div class="bred">
        <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Gráficos Estatísticos</p> 
    </div>
</div>
@stop

@section('content')
@if (isset($dataIni))
    <div class="alert alert-success">
       <p>
            <a href="#" data-dismiss="alert" aria-label="close"><i class="fa fa-close" ></i></a>
           Período da pesquisa: De {{$dataIni}} a {{$dataFin}}
       </p>
    </div>
@endif

<div class="container" style="background: white">
    <form method="post" action="{{route('graficos.filtro')}}">
        {{ csrf_field() }}

        <div class="col-sm-6">
                <div class="form-group">
                        <label for="dataIni"> Data inicial: </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="dataIni" name="dataIni" class="form-control" value="{{old('dataIni')}}">
                        </div>
                </div>
        </div>

        <div class="col-sm-6">
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

        <div class="col-sm-12">
            <div class="form-group">
                <label> &nbsp; </label>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                <a href="{{route('graficos.graficos')}}" class="btn btn-success" 
                role="button"><i class="fa fa-pie-chart"></i> Ver Todos</a> 
            </div>
           
        </div>
    </form>
    
</div>

<div class="row">
    <div class='col-sm-12'>
        <div class="col-sm-6">
            <div id="piechart_3d" style="width: auto; height: 500px; margin-top: 20px"></div>
        </div>
        <div class="col-sm-6">
            <div id="piechart_3d1" style="width: auto; height: 500px; margin-top: 20px"></div>
        </div>
        <div class="col-sm-6">
            <div id="piechart_3d3" style="width: auto; height: 500px; margin-top: 30px"></div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Quadra', 'Nº Reservas'],
                @foreach ($quadras as $quadra)
                {!! "['$quadra->quadra', $quadra->num]," !!}          
                @endforeach
            ]);
            var options = {
            title: 'Total de reservas por quadra',
            is3D: true,
            data: 'Sem registros',
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Horário', 'Nº Reservas'],
                @foreach ($horarios as $horario)
                {!! "['$horario->horario', $horario->num]," !!}          
                @endforeach
            ]);
            var options = {
            title: 'Total de reservas por horário',
            is3D: true, 
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d1'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Dia da Semana', 'Nº de Reservas'],
                @foreach ($semanas as $semana)
                {!! "['$semana->semana', $semana->num]," !!}          
                @endforeach
                
            ]);

        var options = {
          legend: { position: 'none' },
          chart: {
                title: 'Total de reservas por dia da semana',
                
            },
        
        };

        var chart = new google.charts.Bar(document.getElementById('piechart_3d3'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>

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