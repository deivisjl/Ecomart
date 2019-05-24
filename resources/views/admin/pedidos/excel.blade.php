<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table style="width:100%">
        <thead>
            <tr>
                <td>Orden_id</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Correo_electronico</td>
                <td>Cliente</td>
                <td>Fecha_solicitud</td>
            </tr>
        </thead>
        <tbody>
        @foreach($ordenes as $index => $item)
            <tr>
                <td>{{ $item->orden }}</td>
                <td>{{ $item->producto }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->precio }}</td>
                <td>{{ $item->correo }}</td>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->fecha }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>