<!DOCTYPE html>
 <head>
    <title>Relatório</title>
    <style type="text/css">
    table{
        width: auto;
        margin: 0 auto;
        border: 1px solid;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
    <table class="table table-striped table-bordered">
        <caption><h1>Lista de Reservas</h1></caption>
        <thead class="thead-dark">
            <tr>
                <th>Cliente</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Quadra</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Permanente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->cliente->nome}}</td>
                <td>{{$customer->data}}</td>
                <td>{{$customer->horario->hora}}</td>
                <td>{{$customer->quadra->tipo}}</td>
                <td>{{$customer->valor}}</td>
                <td>{{$customer->status}}</td>
                <td>{{$customer->permanente}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </body>
</html>