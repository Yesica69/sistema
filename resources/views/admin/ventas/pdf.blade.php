<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <table border="1">
    <tr>
        <!-- Celda para la información -->
        <td style="text-align: left; padding-right: 300px; vertical-align: middle;">
            {{$sucursal->nombre}} <br>
            <strong>Nit:     </strong> {{$sucursal->telefono}} <br>
            <strong>Teléfono:</strong> {{$sucursal->telefono}} <br>
            <strong>Dirección:</strong> {{$sucursal->direccion}} <br>
            <strong>Correo:   </strong> {{$sucursal->email}} <br>
        </td>
       
        
        <!-- Celda para la imagen alineada a la derecha -->
        <td style="text-align: right; vertical-align: middle;">
            <img src="{{ public_path('storage/'.$sucursal->imagen) }}" width="100px" alt="Imagen no encontrada">
           
        </td>
           
        
    </tr>
    
   
</table>
<table>
<tr>
    <td style="text-align: center">
            <b>  FACTURA</b>
        </td>
    </tr>
</table>

<?php
$fecha_db = $venta->fecha;
// la fecha
$fecha_formateada = date("d", strtotime($fecha_db)) ." de ".
date("F", strtotime($fecha_db)) . " de " .
date("Y", strtotime($fecha_db));
$meses = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];
$fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);
?>
<!-- Datos del Cliente -->
<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
            <th colspan="4" style="text-align: center; background-color: black; color: white;"><b>Datos de los Clientes</b></th>
        </tr>
        <tr>
            <th><b>Nombre</b></th>
            <th><b>Celular</b></th>
            <th><b>NIT/CI</b></th>
            <th><b>Fecha</b></th>
        </tr>
    </thead>
    <tbody>
        <!-- Datos del cliente -->
        <tr>
            <td>{{$venta->cliente->nombre_cliente}}</td>
            <td>{{$venta->cliente->celular}}</td>
            <td>{{$venta->cliente->nit_ci}}</td>
            <td width="200px">{{$fecha_formateada}}</td>
        </tr>
    </tbody>
</table>

<!-- Espacio entre las tablas -->
<br>

<!-- Detalle de la Venta -->
<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; background-color: black; color: white;">
                <b>Detalle de venta</b>
            </th>
        </tr>
        <tr>
            <td width="30px" style="background-color: #cccccc;text-align: center"><b>Nro</b></td>
            <td width="200px" style="background-color: #cccccc;text-align: center"><b>Productos</b></td>
            <td width="210px" style="background-color: #cccccc;text-align: center"><b>Descripción</b></td>
            <td width="80px" style="background-color: #cccccc;text-align: center"><b>Cantidad</b></td>
            <td width="80px" style="background-color: #cccccc;text-align: center"><b>P/U (Bs)</b></td>
            <td width="80px" style="background-color: #cccccc;text-align: center"><b>Subtotal (Bs)</b></td>
        </tr>
    </thead>
    <tbody>
        @php
        $contador = 1;
        $subtotal = 0;
        $suma_cantidad = 0;
        $suma_precio_unitario = 0;
        $suma_subtotal = 0;
        @endphp

        @foreach($venta->detallesVenta as $detalle)
        @php
        $subtotal = $detalle->cantidad * $detalle->producto->precio_venta;
        $suma_subtotal += $subtotal;
        $suma_precio_unitario += $detalle->producto->precio_venta;
        $suma_cantidad += $detalle->cantidad;
        @endphp
        <tr>
            <td style="text-align: center">{{$contador++}}</td>
            <td>{{$detalle->producto->nombre}}</td>
            <td>{{$detalle->producto->descripcion}}</td>
            <td style="text-align: center">{{$detalle->cantidad}}</td>
            <td style="text-align: center"><b>Bs </b>{{$detalle->producto->precio_venta}}</td>
            <td style="text-align: center"><b>Bs </b>{{$subtotal}}</td>
        </tr>
        @endforeach

        <!-- total -->
        <tr>
            <td colspan="3" style="background-color: #cccccc; text-align: center"><b>Total</b></td>
            <td style="background-color: #cccccc; text-align: center"><b>{{$suma_cantidad}}</b></td>
            <td style="background-color: #cccccc; text-align: center"><b>Bs {{$suma_precio_unitario}}</b></td>
            <td style="background-color: #cccccc; text-align: center"><b>Bs {{$suma_subtotal}}</b></td>
        </tr>
    </tbody>
</table>
<p>
    <b>Monto a cancelar:</b>{{$venta->precio_total}} <br> <br>
    <b>Son: </b>{{$literal}}
</p>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>


