@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle de la venta</b></h1>
@endsection

@section('content')
<div class="row">
    <!-- Formulario para crear un usuario -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos registrdos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Formulario -->
                

                <div class="row">
                        <!-- Columna izquierda (Tabla de productos) -->
                        <div class="col-md-8">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                                 <th>Nro</th>
                                                <th>Codigo</th>
                                                <th>Cantidad</th>
                                                <th>Nombre</th>
                                                <th>Costo</th>
                                                <th>Total</th>
                                                <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; $total_cantidad = 0; $total_venta = 0; ?>
                                    @foreach($venta->detallesVenta as $detalle)
                                        <tr>
                                            <td style="text-align: center">{{$cont++}}</td>
                                            <td style="text-align: center">{{$detalle->producto->codigo}}</td>
                                            <td style="text-align: center">{{$detalle->cantidad}}</td>
                                            <td>{{$detalle->producto->nombre}}</td>
                                            <td style="text-align: center">{{$detalle->producto->precio_venta}}</td>
                                            <td style="text-align: center">{{$costo = $detalle->cantidad * $detalle->producto->precio_venta}}</td>
                                        </tr>
                                        @php
                                            $total_cantidad += $detalle->cantidad;
                                            $total_venta += $costo;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: right">Total</td>
                                        <td style="text-align: center"><b>{{$total_cantidad}}</b></td>
                                        <td colspan="2" style="text-align: right">Total venta</td>
                                        <td style="text-align: center"><b>{{$total_venta}}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Columna derecha (Fecha y detalles de compra) -->
                        <div class="col-md-4">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="">Nombre del cliente</label>
                            <input type="text" class="form-control" id="nombre_cliente_select" 
                                value="{{ $venta->cliente ? $venta->cliente->nombre_cliente : 'Cliente no encontrado' }}" disabled>
                            <input type="text" class="form-control" id="id_cliente" name="cliente_id" value="{{ $venta->cliente ? $venta->cliente->nit_ci : 'NIT/CI no encontrado' }}" hidden>
                        </div>

                            <div class="col-md-6">
                                <label for="">NIT/CI del cliente</label>
                            <input type="text" class="form-control" id="nit_cliente_select" 
                            value="{{ $venta->cliente ? $venta->cliente->nit_ci : 'NIT/CI no encontrado' }}" disabled>  
                                               
                           </div>
                          </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha venta</label>
                                        <input type="date" class="form-control" name="fecha" value="{{$venta->fecha }}" disabled>
                                    </div>
                                </div>

                                

                            </div> 

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_total">Total</label>
                                        <input type="text" style="text-align: center;background-color: pink" class="form-control" name="precio_total" value="{{$total_venta}}">
                                    </div>
                                </div>
                            </div> 
                        </div>  
                    </div>

            </div>
          

            <div class="modal-footer">
            <a href="{{url('/admin/ventas')}}" type="submit" class="btn btn-outline-primary">Volver
    
    </a>
    
                    
                </div>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection

@section('js')
<script>

//selecionar de la busqueda lab
$('.seleccionar-btn-laboratorio').click(function (){
    var id_laboratorio = $(this).data('id');
    var nombre = $(this).data('nombre');
  // alert(nombre);   nombre_laboratorio
   $('#nombre_laboratorio').val(nombre);
   $('#id_laboratorio').val(id_laboratorio);
   //cerra el modal 
   $('#labModal').modal('hide');
   
});


//selecionar de la busqueda un producto
$('.seleccionar-btn').click(function (){
    var id_producto = $(this).data('id');
   // alert(id_producto)
   $('#codigo').val(id_producto);
   //cerra el modal 
   $('#verModal').modal('hide');
   $('#verModal').on('hidden.bs.modal', function () {
    $('#codigo').focus();
   });
});


//eliminar un compra
$('.delete-btn').click(function () {
    var id = $(this).data('id');
    if (id) {
        $.ajax({
            url: "{{url('/admin/compras/create/tmp')}}/"+id, // Se corrigió el uso de route()
            type: 'POST',
            data: {
                _token: '{{ csrf_token()}}', // Se corrigió el espacio en csrf_token()
                _method: 'DELETE' // Se corrigió method por _method
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Se eliminó el producto",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload();
                } else {
                    alert('Error: no se pudo eliminar el producto');
                }
            },
            error: function (error) {
                alert(error);
            }
        });
    }
});

//para que aparesca al presionar enter
$('#codigo').focus();
//la 
$('#form_compra').on('keypress',function (e){
    if(e.keyCode === 13){   
        e.preventDefault();
    }
});
//para buscar el prodiucto meiante un codio
    $('#codigo').on('keyup', function (e) {
        if (e.which === 13){
            var codigo = $(this).val();
        var cantidad = $('#cantidad').val();

        if(codigo.length > 0) {
            $.ajax({
                url: "{{ route ('admin.compras.tmp_compras')}}",
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    codigo: codigo,
                    cantidad: cantidad
                },
                success: function (response) {
                    // Si hay éxito, mostramos el mensaje específico
                    if(response.success){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se regristro el producto",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    } else {
                        alert('No se encontró el producto');
                    }
                },
                error: function(error) {
                    // Mostramos el mensaje de error con el contenido del objeto
                    alert(JSON.stringify(error)); // Si necesitas ver todo el error
                }
            });
        }
        }
    });
</script>

<script>
    $('#mitabla').DataTable({
        "pageLength": 5,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos disponibles en la tabla"
        }
    });


    $('#mitabla2').DataTable({
        "pageLength": 5,
        "language": {
            "lengthMenu": "Mostrar _MENU_ ",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos disponibles en la tabla"
        }
    });



</script>
@endsection
