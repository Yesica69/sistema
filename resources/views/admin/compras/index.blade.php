@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de compras</b></h1>
@endsection

@section('content')
<div class="row">
    <!-- Tabla de compras registradas -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Compras registradas</h3>

                <div class="card-tools">
                @if ($cajaAbierto)                 
                 
                <a href="{{ url('/admin/compras/create') }}" class="btn btn-primary" style="margin-left: 20px;">
                        <i class="fas fa-plus"></i> Nuevo compra
                    </a>
                 @else 
                 <a href="{{ url('/admin/cajas/create') }}" class="btn btn-danger" style="margin-left: 20px;">
                     <i class="fas fa-plus"></i> Abrir caja
                 </a>
                 @endif

            
                </div>
            </div>
            <div class="card-body">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Producto</th>
                            <th scope="col" style="text-align: center">Fecha</th>
                            <th scope="col" style="text-align: center">Precio de la compra</th>
                            <th scope="col" style="text-align: center">Comprobante</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($compras as $compra)
                            <tr>
                                <td style="text-align: center">{{ $contador++ }}</td>
                                <td style="vertical-align: middle">
                                    <ul>
                                        @foreach($compra->detalles as $detalle)
                                            <li>{{ $detalle->producto->nombre . ' - ' . $detalle->cantidad}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $compra->fecha }}</td>
                                <td>{{ $compra->precio_total }}</td>
                                <td>{{ $compra->comprobante }}</td>
                                <td style="text-align: center">
                                    <!-- Botón ver las compras-->
                                 
                                        <!-- Botón pverrr-->
                                        <a href="{{ url('/admin/compras', $compra->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Botón Editar -->
                                    <a href="{{url('/admin/compras/'. $compra->id.'/edit') }}" class="btn btn-outline-success">
                                        <i class="fas fa-pencil"></i>
                                    </a>

                                    <!-- Modal editar compras -->

                                    <!-- Botón Eliminar -->
                                    <form action="{{url('/admin/compras',$compra->id)}}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                         

                                </div> <!-- Cierra la fila correctamente -->

                            </div>  
                            
                            
                        </div>
                    </div>

                 
                </form>
            </div>
        </div>
    </div>
</div>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection

@section('js')
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
</script>
@endsection
