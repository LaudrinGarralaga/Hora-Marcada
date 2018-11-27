@extends('adminlte::page')

@section('title', 'Cadastro de Local')

@section('content_header')
    @if ($acao == 1)
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Cadastro de Local</p> 
            </div>
        </div>
    @else
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: green; margin-left: 20px; margin-top: 15px">Alteração de Local</p> 
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
        <div class="box box-success">
                <div class="box-body">
            <form method="post" action="{{route('locais.store')}}">
                @else
                <div class="box box-success">
                        <div class="box-body">
                    <form method="post" action="{{route('locais.update', $reg->id)}}">
                        {!! method_field('put') !!}
                        @endif
                        {{ csrf_field() }}
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome do Local:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <input type="text" class="form-control" id="nome"
                                            name="nome" placeholder="Digite o nome do local"
                                            value="{{$reg->nome or old('nome')}}">
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input type="text" class="form-control" id="endereco"
                                        name="endereco" placeholder="Digite o endereço do local"
                                        value="{{$reg->endereco or old('endereco')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="numero">Número:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <input  type="text" class="form-control" id="numero"  
                                            name="numero" placeholder="Digite o número do local"
                                            value="{{$reg->numero or old('numero')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="complemento">Complemento:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <input type="text" class="form-control" id="complemento"
                                        name="complemento" placeholder="Digite o complemento do local"
                                        value="{{$reg->complemento or old('complemento')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cidade">Cidade:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <input type="text" class="form-control" id="cidade"
                                        name="cidade" placeholder="Digite a cidade do local"
                                        value="{{$reg->cidade or old('cidade')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input type="text" class="form-control" id="bairro"
                                            name="bairro" placeholder="Digite o bairro do local"
                                            value="{{$reg->bairro or old('bairro')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cep">CEP:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="text" class="form-control" id="cep"
                                                name="cep" placeholder="Digite o cep do local"
                                                value="{{$reg->cep or old('cep')}}">
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
                                            <input type="phone" class="form-control" id="telefone"
                                                name="telefone" placeholder="Digite o telefone do local"
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