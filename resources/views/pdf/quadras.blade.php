<!DOCTYPE html>
 <head>
    <title>Relatório</title>
    <style type="text/css">
    table{
        width: 70%;
        margin: 0 auto;
        border: 1px solid;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
    <table class="table table-striped table-bordered">
        <caption><h1>Lista de Quadras</h1></caption>
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->tipo}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </body>
</html>