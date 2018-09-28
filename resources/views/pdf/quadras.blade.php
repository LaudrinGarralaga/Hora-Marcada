<!DOCTYPE html>
 <head>
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
        <h1 style="text-align:center"><span style="font-size:36px">Centro Esportivo Hora Marcada</span></h1>

        <p><span style="font-size:18px">Rua: Santa Cruz, N&ordm; 12345&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Cidade: Pelotas - RS&nbsp; &nbsp; &nbsp; &nbsp; Telefone: (53) 3228 - 5555</span></p>
        
        <p><span style="font-size:18px">Data: {{$data}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hor&aacute;rio: {{$hora}} </span></p>
       
        <hr />
        <h2 style="text-align:center"><span style="font-size:20px"><u><strong>Relat&oacute;rio de Quadras</strong></u></span></h2>

        <p>&nbsp;</p>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->tipo}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </body>
</html>