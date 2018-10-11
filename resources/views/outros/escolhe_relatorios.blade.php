@extends('adminlte::page')

@section('title', 'Selecionar Relatório')

@section('content_header')
<div class="row" style="background-color: white; margin-inline-start: -15px; margin-inline-end: -20px; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Selecionar Relatório</p> 
        </div>
</div>

@stop

@section('content')

<div class="row" >
    <br>
    <br>
        <div class="col-lg-4 col-xs-8">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <br>
                    <p style="font-size: 20px">Reservas</p>
                    <br>
                    <br>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <a href='{{route('reservas.index')}}' class="small-box-footer">
                   Filtrar
                    <i class="fa fa-filter"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner"> 
                            <br>
                            <p style="font-size: 20px">Clientes</p>
                            <br>
                            <br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href='{{route('clientes.index')}}' class="small-box-footer">
                            Filtrar
                        <i class="fa fa-filter"></i>
                    </a>
                </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                        <br>
                        <p style="font-size: 20px">Horários</p>
                        <br>
                        <br>
                 </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <a href='{{route('horarios.index')}}' class="small-box-footer">
                        Filtrar
                    <i class="fa fa-filter"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                        <br>
                        <p style="font-size: 20px">Opcionais</p>
                        <br>
                        <br>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href='{{route('opcionais.index')}}' class="small-box-footer">
                        Filtrar
                    <i class="fa fa-filter"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                            <br>
                            <p style="font-size: 20px">Quadras</p>
                            <br>
                            <br>
                    </div>
                    <div class="icon">
                        <i class="fa fa-square"></i>
                    </div>
                    <a href='{{route('opcionais.index')}}' class="small-box-footer">
                            Filtrar
                        <i class="fa fa-filter"></i>
                    </a>
                </div>
            </div>
        
    </div>
@stop