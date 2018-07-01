@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')

<div class='col-sm-11'>
    @if ($acao == 1)
    <h2> Cadastro de cliente </h2>
    @else
    <h2> Alteração de cliente </h2>
    @endif
</div>
<div class='col-sm-1'>
    <a href="{{route('clientes.index')}}" class="btn btn-primary" 
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
    <form method="post" action="{{route('clientes.store')}}">
        @else
        <form method="post" action="{{route('clientes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-12">
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
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input  type="text" class="form-control" id="telefone"  
                                name="telefone" placeholder="Digite o telefone do cliente"
                                value="{{$reg->telefone or old('telefone')}}"
                                required>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
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
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Enviar</button>        
                <button type="reset" class="btn btn-warning">Limpar</button>
            </div>
        </form>    
    </form>
</div>
@endsection

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
                    element.mask("(99) 9999-9999?9");
                }
            });

});
</script>
@endsection

