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
<div class="row">
<div class='col-sm-12'>
    <div class="col-sm-6">
        <div id="piechart_3d" style="width: auto; height: 500px;"></div>
    </div>
    <div class="col-sm-6">
        <div id="piechart_3d1" style="width: auto; height: 500px;"></div>
    </div>
    <div class="col-sm-6">
        <div id="piechart_3d2" style="width: auto; height: 500px; margin-top: 30px"></div>
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
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Horário', 'Nº Reservas'],
                @foreach ($semanas as $semana)
                {!! "['$semana->semana', $semana->num]," !!}          
                @endforeach
            ]);
            var options = {
            title: 'Total de reservas por dia da semana',
            is3D: true, 
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
            chart.draw(data, options);
        }
    </script>
@stop
