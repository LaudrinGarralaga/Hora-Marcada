@extends('adminlte::page')

@section('title', 'Hora Marcada')

@section('content_header')
<h2 style="text-align: center">Software Hora Marcada</h2>
@stop

@section('content')
<h4 style="text-align: center">Seja bem vido ao Hora Marcada, aqui você gerencia sua quadra esportiva.</h4>&nbsp;

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$totalReservas}}</h3>
                <p>Reservas</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href='{{route('reservas.index')}}' class="small-box-footer">
                Mais Infomações
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$totalClientes}}</h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href='{{route('clientes.index')}}' class="small-box-footer">
                    Mais Infomações
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
    </div>
    <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$totalHorarios}}</h3>
                        <p>Horários</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href='{{route('horarios.index')}}' class="small-box-footer">
                        Mais Infomações
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
    </div>
            <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$totalOpcionais}}</h3>
                            <p>Opcionais</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                        <a href='{{route('opcionais.index')}}' class="small-box-footer">
                            Mais Infomações
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
</div>

@stop