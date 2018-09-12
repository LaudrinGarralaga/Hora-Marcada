<!DOCTYPE html>
 <head>
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
    <table class="table table-striped table-bordered">
        <caption><h1>Lista de Clientes</h1></caption>
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