<!DOCTYPE html>
 <head>
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
        @foreach($locais as $local)
        <h1 style="text-align: center;"><u><strong>{{$local->nome}}</strong></u></h1>

        <p><span style="font-size:12px">Endereço: {{$local->endereco}}, N&ordm; {{$local->numero}}&nbsp;&nbsp;&nbsp; Complemento:  {{$local->complemento}}&nbsp; &nbsp; Bairro: {{$local->bairro}}&nbsp;&nbsp; Cidade: {{$local->cidade}}&nbsp; &nbsp; Telefone: {{$local->telefone}}</span></p>
        
        <p><span style="font-size:12px">Data: {{$data}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hor&aacute;rio: {{$hora}} </span></p>
       
        <hr />
        <h2 style="text-align:center"><span style="font-size:20px"><u><strong>Relat&oacute;rio de Clientes</strong></u></span></h2>
        @endforeach
        <p>&nbsp;</p>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Pontos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->nome}}</td>
                <td>{{$customer->telefone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->pontos}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </body>
</html>