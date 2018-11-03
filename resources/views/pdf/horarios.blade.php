<!DOCTYPE html>
  <head>
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        @page { margin: 180px 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
        #footer .page:after { content: counter(page, upper-roman); }
    </style>
 </head>
 <body> 
 <div id="header">
        @foreach($locais as $local)
        <h1><u><strong>{{$local->nome}}</strong></u></h1>
    
        <p><span style="font-size:12px">Endereço: {{$local->endereco}}, N&ordm; {{$local->numero}}&nbsp;&nbsp;&nbsp; Complemento:  {{$local->complemento}}&nbsp; &nbsp; Bairro: {{$local->bairro}}&nbsp;&nbsp; Cidade: {{$local->cidade}}&nbsp; &nbsp; Telefone: {{$local->telefone}}</span></p>
        
        <p><span style="font-size:12px">Emitido dia: {{$data}}&nbsp; &nbsp; às: {{$hora}} </span></p>
    
        <hr />
        <h2><span style="font-size:20px"><u><strong>Relat&oacute;rio de Horários</strong></u></span></h2>
        @endforeach
        <p>&nbsp;</p>
 </div>
 <div id="content">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Horário</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->horario}}</td>
                <td>{{$customer->preco}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>
 </body>
</html>