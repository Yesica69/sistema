@extends('adminlte::page')

@section('title', 'Gestión de Proveedores')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark"><i class="fas fa-truck mr-2"></i> <strong>Proveedores</strong></h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
        <i class="fas fa-plus-circle mr-1"></i> Nuevo Proveedor
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
                        <i class="fas fa-list-ol mr-2"></i>Proveedores Registrados
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
                                    <th style="width: 5%; text-align: center">Nro</th>
                                    <th style="text-align: center">Empresa</th>
                                    <th style="text-align: center">Dirección</th>
                                    <th style="text-align: center">Teléfono</th>
                                    <th style="text-align: center">Correo</th>
                                    <th style="text-align: center">Contacto</th>
                                    <th style="text-align: center">Celular</th>
                                    <th style="width: 12%; text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1;?>
                                @foreach($proveedores as $proveedor)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle">{{$contador++}}</td>
                                    <td style="vertical-align: middle">
                                        <span class="badge badge-primary p-2">
                                            <i class="fas fa-building mr-1"></i> {{$proveedor->empresa}}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle">{{$proveedor->direccion}}</td>
                                    <td style="vertical-align: middle">{{$proveedor->telefono}}</td>
                                    <td style="vertical-align: middle">{{$proveedor->email}}</td>
                                    <td style="vertical-align: middle">{{$proveedor->nombre}}</td>
                                    <td style="vertical-align: middle; text-align: center">
                                        <a href="https://wa.me/591{{$proveedor->celular}}" target="_blank"
                                           class="btn btn-sm btn-success" title="Contactar por WhatsApp">
                                            <i class="fab fa-whatsapp mr-1"></i> {{$proveedor->celular}}
                                        </a>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle">
                                        <div class="btn-group" role="group">
                                            <!-- Botón Ver -->
                                            <button type="button" class="btn btn-sm btn-outline-info mx-1" 
                                                    data-toggle="modal" data-target="#verModal{{ $proveedor->id }}"
                                                    title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            
                                            <!-- Botón Editar -->
                                            <button type="button" class="btn btn-sm btn-outline-warning mx-1" 
                                                    data-toggle="modal" data-target="#editModal{{ $proveedor->id }}"
                                                    title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Botón Eliminar -->
                    <form action="{{ url('/admin/proveedores', $proveedor->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" >
                            <i class="fas fa-trash"></i> 
                        </button>
                    </form>
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
    </div>
</div>

<!-- Modal para Crear Nuevo Proveedor -->
<div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-2"></i><strong>Registrar Proveedor</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/admin/proveedores/create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('empresa') }}" name="empresa" required>
                                </div>
                                @error('empresa')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('direccion') }}" name="direccion" required>
                                </div>
                                @error('direccion')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono" required>
                                </div>
                                @error('telefono')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" required>
                                </div>
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre del proveedor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" required>
                                </div>
                                @error('nombre')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ old('celular') }}" name="celular" required>
                                </div>
                                @error('celular')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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

<!-- Modales para Ver y Editar (se generan dinámicamente para cada proveedor) -->
@foreach($proveedores as $proveedor)
<!-- Modal Ver -->
<div class="modal fade" id="verModal{{ $proveedor->id }}" role="dialog" aria-labelledby="verModalLabel{{ $proveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title" id="verModalLabel{{ $proveedor->id }}">
                    <i class="fas fa-info-circle mr-2"></i>Detalles del Proveedor
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3 border-0 shadow-none">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Empresa:</label>
                                    <p class="form-control-static">{{$proveedor->empresa}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Dirección:</label>
                                    <p class="form-control-static">{{$proveedor->direccion}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Teléfono:</label>
                                    <p class="form-control-static">{{$proveedor->telefono}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Correo:</label>
                                    <p class="form-control-static">{{$proveedor->email}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Contacto:</label>
                                    <p class="form-control-static">{{$proveedor->nombre}}</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Celular:</label>
                                    <p class="form-control-static">
                                        <a href="https://wa.me/591{{$proveedor->celular}}" target="_blank"
                                           class="btn btn-sm btn-success">
                                            <i class="fab fa-whatsapp mr-1"></i> {{$proveedor->celular}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editModal{{ $proveedor->id }}" role="dialog" aria-labelledby="editModalLabel{{ $proveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title" id="editModalLabel{{ $proveedor->id }}">
                    <i class="fas fa-edit mr-2"></i>Editar Proveedor
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('/admin/proveedores', $proveedor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="empresa" value="{{ $proveedor->empresa }}" required>
                                </div>
                                @error('empresa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="direccion" value="{{ $proveedor->direccion }}" required>
                                </div>
                                @error('direccion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $proveedor->telefono }}" name="telefono">
                                </div>
                                @error('telefono')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $proveedor->email }}" name="email" required>
                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre del Contacto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $proveedor->nombre }}" name="nombre" required>
                                </div>
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $proveedor->celular }}" name="celular" required>
                                </div>
                                @error('celular')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    .btn-outline-info {
        color: #3b82f6;
        border-color: #3b82f6;
    }
    .btn-outline-info:hover {
        background-color: #3b82f6;
        color: white;
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
    .bg-gradient-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }
    .input-group-text {
        background-color: #f8fafc;
    }
    .form-control-static {
        padding: 0.375rem 0;
        margin-bottom: 0;
        line-height: 1.5;
        border-bottom: 1px solid #dee2e6;
    }
    #mitabla_wrapper .dataTables_filter input {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 5px;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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