@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')
    @if ($acao == 1)
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Cadastro de Cliente</p> 
            </div>
        </div>
    @else
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: steelblue; margin-left: 20px; margin-top: 15px">Alteração de Cliente</p> 
            </div>
        </div>
    @endif

@stop

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
        <div class="box box-primary">
                <div class="box-body">
            <form method="post" action="{{route('clientes.store')}}">
                @else
                <div class="box box-primary">
                        <div class="box-body">
                    <form method="post" action="{{route('clientes.update', $reg->id)}}">
                        {!! method_field('put') !!}
                        @endif
                        {{ csrf_field() }}
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="nome">Nome do cliente:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </div>
                                    <input type="text" class="form-control" id="nome"
                                        name="nome" placeholder="Digite o nome do cliente"
                                        value="{{$reg->nome or old('nome')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" id="email"
                                        name="email" placeholder="Digite o email do cliente"
                                        value="{{$reg->email or old('email')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="telefone">Telefone:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input  type="phone" class="form-control" id="telefone"  
                                                name="telefone" placeholder="Telefone"
                                                value="{{$reg->telefone or old('telefone')}}">
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>        
                            <button type="reset" class="btn btn-warning"><i class="fa fa-eraser"></i> Limpar</button>
                        </div>
                    </form>  
                </div>  
            </form>       
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
<script src="{{asset('view-source:https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('js/jquery.maskedinput.js')}}"></script> 

<script>
    $(document).ready(function () {
        jQuery("#telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                 lement.mask("(99) 9999-9999?9");
            }
        });
    });
</script>

@stop
