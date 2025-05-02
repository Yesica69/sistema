@extends('adminlte::page')

@section('title', 'Gestión de Categorías')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark"><i class="fas fa-tags"></i> <strong>Categorías</strong></h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
        <i class="fas fa-plus-circle"></i> Nueva Categoría
    </button>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol mr-2"></i>Categorías Registradas
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mitabla" class="table table-hover table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 8%; text-align: center">Nro</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Descripción</th>
                                    <th style="width: 15%; text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1;?>
                                @foreach($categorias as $categoria)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$contador++}}</td>
                                    <td style="vertical-align: middle">
                                        <span class="badge badge-primary p-2">
                                            <i class="fas fa-tag mr-1"></i> {{$categoria->nombre}}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle">{{$categoria->descripcion}}</td>
                                    <td style="text-align: center; vertical-align: middle">
                                        <div class="btn-group" role="group">
                                            <!-- Botón Editar -->
                                            <button type="button" class="btn btn-sm btn-outline-warning mx-1" data-toggle="modal" 
                                                data-target="#editModal{{ $categoria->id }}" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Botón Eliminar -->
                                            <form action="{{ url('/admin/categorias', $categoria->id) }}" method="POST" 
                                                onclick="preguntar{{$categoria->id}}(event)" id="miFormulario{{$categoria->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger mx-1" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <script>
                                            function preguntar{{$categoria->id}}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: '¿Desea eliminar esta categoría?',
                                                    text: 'Si elimina esta categoría, se eliminarán todas las categorías relacionadas en la tabla productos.',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    cancelButtonText: 'Cancelar',
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Sí, eliminar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form = $('#miFormulario{{$categoria->id}}');
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Nueva Categoría -->
<div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-2"></i><strong>Registrar Categoría</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/admin/categorias/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre de la Categoría</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            </div>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required>
                        </div>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modales para Editar (se generan dinámicamente para cada categoría) -->
@foreach($categorias as $categoria)
<div class="modal fade" id="editModal{{ $categoria->id }}" role="dialog" aria-labelledby="editModalLabel{{ $categoria->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title" id="editModalLabel{{ $categoria->id }}">
                    <i class="fas fa-edit mr-2"></i>Editar Categoría
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('/admin/categorias', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre de la categoría</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre">
                        </div>
                        @error('nombre')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion">
                        </div>
                        @error('descripcion')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .table thead th {
        background-color: #f1f5f9;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .badge-primary {
        background-color: #3b82f6;
    }
    .btn-outline-warning {
        color: #eab308;
        border-color: #eab308;
    }
    .btn-outline-warning:hover {
        background-color: #eab308;
        color: #1f2937;
    }
    .btn-outline-danger {
        color: #ef4444;
        border-color: #ef4444;
    }
    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: white;
    }
    .modal-header {
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }
    .input-group-text {
        background-color: #f8fafc;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Opcional: Inicializar DataTables si lo deseas
        // $('table').DataTable();
    });
</script>
<script>
    $('#mitabla'). DataTable({
        "pageLength":5,
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
@stop