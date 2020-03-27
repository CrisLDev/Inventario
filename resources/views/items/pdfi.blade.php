<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>  
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Curso y Paralelo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">codigo</th>
                <th scope="col">cantidad</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($items as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td><label>{{$item->nombre}}</label></td>
                    <td><label>{{$item->curso}} {{$item->paralelo}}</label></td>
                    <td><label>{{$item->descripcion}}</label></td>
                    <td><label>{{$item->codigo}}</label></td>
                    <td><label>{{$item->cantidad}}</label></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>