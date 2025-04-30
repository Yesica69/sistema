@extends('adminlte::page')

@section('title', 'Gestión de Productos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark"><i class="fas fa-boxes mr-2"></i>Gestión de Productos</h1>
        <a href="{{ url('/admin/productos/create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus-circle"></i> Nuevo Producto
        </a>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Listado de Productos</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" id="searchInput" class="form-control float-right" placeholder="Buscar producto...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row" id="productosContainer">
                        @foreach($productos as $producto)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 product-card">
                                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between">
                                    <span class="badge badge-light">#{{ $loop->iteration }}</span>
                                    <span class="text-muted small">Cód: {{ $producto->codigo }}</span>
                                </div>
                                
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column h-100">
                                        <div class="text-center mb-3">
                                            @if($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid product-image" alt="Imagen producto">
                                            @else
                                                <div class="no-image-placeholder">
                                                    <i class="fas fa-box-open fa-3x text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <h5 class="card-title text-primary font-weight-bold mb-2">{{ $producto->nombre }}</h5>
                                        <p class="card-text text-muted small mb-3 flex-grow-1">
                                            {{ Str::limit($producto->descripcion, 80) }}
                                        </p>
                                        
                                        <div class="product-meta">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted small"><i class="fas fa-cubes mr-1"></i> Stock:</span>
                                                <span class="badge {{ $producto->stock < $producto->stock_minimo ? 'badge-danger' : 'badge-success' }}">
                                                    {{ $producto->stock }}
                                                </span>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted small"><i class="fas fa-tag mr-1"></i> Preci111111111o:</span>
                                                <span class="font-weight-bold text-success">Bs {{ number_format($producto->precio_venta, 2) }}</span>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted small"><i class="fas fa-calendar-alt mr-1"></i> Vence:</span>
                                                <span class="font-weight-bold {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->lt(now()->addMonths(3)) ? 'text-danger' : 'text-dark' }}">
                                                    {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-white border-top-0 pt-0">
                                    <div class="d-flex justify-content-between">
                                        <!-- Botón Ver -->
                                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#verModal{{ $producto->id }}" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Botón Editar -->
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#editarModal{{ $producto->id }}" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <!-- Modal para Ver -->
<div class="modal fade" id="verModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="verModalLabel{{ $producto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title font-weight-bold" id="verModalLabel{{ $producto->id }}">
                    <i class="fas fa-box-open mr-2"></i>Detalles Completo del Producto
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="row no-gutters">
                    <!-- Sección de Imagen -->
                    <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4">
                        <div class="text-center">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                     class="img-fluid rounded shadow-sm product-detail-img" 
                                     alt="{{ $producto->nombre }}"
                                     style="max-height: 250px;">
                            @else
                                <div class="no-image-wrapper bg-white p-4 rounded shadow-sm">
                                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                                    <p class="text-muted small mb-0">Imagen no disponible</p>
                                </div>
                            @endif
                            <div class="mt-3">
                                <span class="badge badge-pill badge-{{ $producto->stock > 0 ? 'success' : 'danger' }} px-3 py-2">
                                    {{ $producto->stock > 0 ? 'DISPONIBLE' : 'AGOTADO' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección de Información -->
                    <div class="col-md-8">
                        <div class="p-4">
                            <!-- Encabezado -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="text-primary font-weight-bold mb-1">{{ $producto->nombre }}</h3>
                                    <p class="text-muted mb-2">{{ $producto->codigo }}</p>
                                </div>
                                <div class="text-right">
                                    <h4 class="text-success font-weight-bold mb-0">
                                        Bs{{ number_format($producto->precio_venta, 2) }}
                                    </h4>
                                    <small class="text-muted">Precio de venta</small>
                                </div>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="mb-4">
                                <p class="text-dark">{{ $producto->descripcion ?: 'Sin descripción disponible' }}</p>
                            </div>
                            
                            <hr class="my-4">
                            
                            <!-- Información detallada -->
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <div class="detail-card mb-3">
                                        <h6 class="detail-label"><i class="fas fa-tags mr-2 text-info"></i>Categoría</h6>
                                        <p class="detail-value">{{ $producto->categoria->nombre }}</p>
                                    </div>
                                    
                                    <div class="detail-card mb-3">
                                        <h6 class="detail-label"><i class="fas fa-flask mr-2 text-info"></i>Laboratorio</h6>
                                        <p class="detail-value">{{ $producto->laboratorio->nombre }}</p>
                                    </div>
                                    
                                    <div class="detail-card mb-3">
                                        <h6 class="detail-label"><i class="fas fa-warehouse mr-2 text-info"></i>Inventario</h6>
                                        <div class="progress mt-2" style="height: 8px;">
                                            @php
                                                $porcentaje = ($producto->stock / $producto->stock_maximo) * 100;
                                                $color = $porcentaje < 20 ? 'bg-danger' : ($porcentaje < 50 ? 'bg-warning' : 'bg-success');
                                            @endphp
                                            <div class="progress-bar {{ $color }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $porcentaje }}%" 
                                                 aria-valuenow="{{ $porcentaje }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <small class="text-muted">Actual: {{ $producto->stock }}</small>
                                            <small class="text-muted">Máx: {{ $producto->stock_maximo }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <div class="detail-card mb-3">
                                        <h6 class="detail-label"><i class="fas fa-money-bill-wave mr-2 text-info"></i>Precios</h6>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Compra:</span>
                                            <span class="font-weight-bold">Bs{{ number_format($producto->precio_compra, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Venta:</span>
                                            <span class="font-weight-bold text-success">Bs{{ number_format($producto->precio_venta, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <span class="text-muted">Margen:</span>
                                            <span class="font-weight-bold text-primary">
                                                @php
                                                    $margen = (($producto->precio_venta - $producto->precio_compra) / $producto->precio_compra) * 100;
                                                    echo number_format($margen, 2).'%';
                                                @endphp
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-card mb-3">
                                        <h6 class="detail-label"><i class="fas fa-calendar-alt mr-2 text-info"></i>Fechas</h6>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Ingreso:</span>
                                            <span class="font-weight-bold">{{ \Carbon\Carbon::parse($producto->fecha_ingreso)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <span class="text-muted">Vencimiento:</span>
                                            <span class="font-weight-bold {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->lt(now()->addMonths(3)) ? 'text-danger' : 'text-success' }}">
                                                {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/m/Y') }}
                                                @if(\Carbon\Carbon::parse($producto->fecha_vencimiento)->lt(now()->addMonths(3)))
                                                    <i class="fas fa-exclamation-triangle ml-1"></i>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                @php
                                                    $diasRestantes = \Carbon\Carbon::parse($producto->fecha_vencimiento)->diffInDays(now());
                                                    echo $diasRestantes > 0 ? "$diasRestantes días restantes" : "Vencido hace ".abs($diasRestantes)." días";
                                                @endphp
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cerrar
                </button>
                
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#editarModal{{ $producto->id }}">
                    <i class="fas fa-edit mr-1"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

                       <!-- Modal para Editar -->
<div class="modal fade" id="editarModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $producto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <!-- Encabezado con gradiente profesional -->
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title font-weight-600" id="editarModalLabel{{ $producto->id }}">
                    <i class="fas fa-edit mr-2"></i>Editar Producto
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ url('/admin/productos', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- Sección principal del formulario -->
                        <div class="col-lg-8">
                            <!-- Primera fila - Categoría y Laboratorio -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="categoria_id" class="form-label text-primary">
                                        <i class="fas fa-tag mr-1"></i>Categoría
                                    </label>
                                    <select name="categoria_id" class="form-control select2" required>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="laboratorio_id" class="form-label text-primary">
                                        <i class="fas fa-flask mr-1"></i>Laboratorio
                                    </label>
                                    <select name="laboratorio_id" class="form-control select2" required>
                                        @foreach($laboratorios as $laboratorio)
                                            <option value="{{ $laboratorio->id }}" {{ $laboratorio->id == $producto->laboratorio_id ? 'selected' : '' }}>
                                                {{ $laboratorio->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Segunda fila - Código y Nombre -->
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="codigo" class="form-label text-primary">
                                        <i class="fas fa-barcode mr-1"></i>Código
                                    </label>
                                    <input type="text" class="form-control" name="codigo" value="{{ $producto->codigo }}" required>
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label for="nombre" class="form-label text-primary">
                                        <i class="fas fa-box mr-1"></i>Nombre
                                    </label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
                                </div>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label text-primary">
                                    <i class="fas fa-align-left mr-1"></i>Descripción
                                </label>
                                <textarea class="form-control" name="descripcion" rows="2">{{ $producto->descripcion }}</textarea>
                            </div>
                            
                            <!-- Tercera fila - Stock -->
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="stock" class="form-label text-primary">
                                        <i class="fas fa-boxes mr-1"></i>Stock
                                    </label>
                                    <input type="number" class="form-control" name="stock" value="{{ $producto->stock }}" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="stock_minimo" class="form-label text-primary">
                                        <i class="fas fa-exclamation-circle mr-1"></i>Stock Mínimo
                                    </label>
                                    <input type="number" class="form-control" name="stock_minimo" value="{{ $producto->stock_minimo }}" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="stock_maximo" class="form-label text-primary">
                                        <i class="fas fa-warehouse mr-1"></i>Stock Máximo
                                    </label>
                                    <input type="number" class="form-control" name="stock_maximo" value="{{ $producto->stock_maximo }}" required>
                                </div>
                            </div>
                            
                            <!-- Cuarta fila - Precios -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio_compra" class="form-label text-primary">
                                        <i class="fas fa-money-bill-wave mr-1"></i>Precio Compra
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">Bs</span>
                                        </div>
                                        <input type="text" class="form-control" name="precio_compra" value="{{ $producto->precio_compra }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="precio_venta" class="form-label text-primary">
                                        <i class="fas fa-tag mr-1"></i>Precio Venta
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">Bs</span>
                                        </div>
                                        <input type="text" class="form-control" name="precio_venta" value="{{ $producto->precio_venta }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quinta fila - Fechas -->
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_ingreso" class="form-label text-primary">
                                        <i class="fas fa-calendar-plus mr-1"></i>Fecha Ingreso
                                    </label>
                                    <input type="date" class="form-control" name="fecha_ingreso" value="{{ $producto->fecha_ingreso }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_vencimiento" class="form-label text-primary">
                                        <i class="fas fa-calendar-times mr-1"></i>Fecha Vencimiento
                                    </label>
                                    <input type="date" class="form-control" name="fecha_vencimiento" value="{{ $producto->fecha_vencimiento }}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sección de imagen -->
                        <div class="col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <label class="form-label text-primary">
                                        <i class="fas fa-image mr-1"></i>Imagen del Producto
                                    </label>
                                    
                                    <div class="file-upload-wrapper mt-2">
                                        <input type="file" id="imagen{{ $producto->id }}" name="imagen" accept="image/*" class="file-upload-input">
                                        <label for="imagen{{ $producto->id }}" class="file-upload-label">
                                            <i class="fas fa-cloud-upload-alt mr-2"></i>Seleccionar imagen
                                        </label>
                                    </div>
                                    
                                    <div class="image-preview-container mt-4">
                                        @if($producto->imagen)
                                            <img id="preview{{ $producto->id }}" src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded shadow" style="max-height: 200px;">
                                        @else
                                            <div class="no-image-placeholder bg-light p-4 rounded shadow">
                                                <i class="fas fa-box-open fa-3x text-muted mb-2"></i>
                                                <p class="text-muted small mb-0">No hay imagen</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pie del modal -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
                        @endforeach
                    </div>
                </div>
                
             
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Estilos generales */
    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    /* Encabezado con gradiente */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6777ef 0%, #3abaf4 100%);
    }
    
    .modal-header {
        padding: 1.2rem 1.5rem;
        border-bottom: none;
    }
    
    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    /* Cuerpo del modal */
    .modal-body {
        padding: 1.5rem;
    }
    
    /* Estilos para formulario */
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .select2-container .select2-selection--single {
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-control:focus, .select2-container--focus .select2-selection--single {
        border-color: #3abaf4;
        box-shadow: 0 0 0 0.2rem rgba(58, 186, 244, 0.25);
    }
    
    /* Estilos para subida de imagen */
    .file-upload-wrapper {
        position: relative;
    }
    
    .file-upload-input {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }
    
    .file-upload-label {
        display: block;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border: 1px dashed #d1d3e2;
        border-radius: 0.375rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-label:hover {
        background-color: #e9ecef;
        border-color: #bac8f3;
    }
    
    .image-preview-container {
        margin-top: 1rem;
    }
    
    .no-image-placeholder {
        height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    /* Pie del modal */
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
    }
    
    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-outline-secondary {
        border: 1px solid #e0e0e0;
    }
    
    .btn-primary {
        background-color: #3abaf4;
        border-color: #3abaf4;
    }
    
    .btn-primary:hover {
        background-color: #2a9fd8;
        border-color: #2a9fd8;
        transform: translateY(-1px);
    }
</style>

<style>
    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .modal-header {
        padding: 1.2rem 1.5rem;
        border-bottom: none;
    }
    
    .product-detail-img {
        max-width: 100%;
        height: auto;
        object-fit: contain;
        border: 1px solid #eaeaea;
    }
    
    .no-image-wrapper {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .detail-card {
        background-color: #f8fafc;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        border-left: 3px solid #3abaf4;
    }
    
    .detail-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #6c757d;
        margin-bottom: 0.3rem;
        font-weight: 600;
    }
    
    .detail-value {
        font-size: 0.95rem;
        color: #343a40;
        font-weight: 500;
        margin-bottom: 0;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6777ef 0%, #3abaf4 100%);
    }
    
    .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem;
    }
</style>
<style>
    .product-card {
        transition: all 0.3s ease;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: none;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .product-image {
        max-height: 120px;
        object-fit: contain;
        border-radius: 4px;
    }
    
    .no-image-placeholder {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 4px;
    }
    
    .no-image-placeholder-lg {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 4px;
    }
    
    .product-meta {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
        margin-top: auto;
    }
    
    .info-item {
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
    }
    
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        padding-top: 0.375rem !important;
    }
    
    .custom-file-label::after {
        content: "Buscar" !important;
    }
</style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar List.js para búsqueda
        var options = {
            valueNames: ['card-title', 'card-text'],
            page: 12,
            pagination: true
        };

        var productosList = new List('productosContainer', options);

        $('#searchInput').on('keyup', function() {
            productosList.search($(this).val());
        });

        // Inicializar Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Vista previa de imagen al editar
        $('input[type="file"]').change(function(e) {
            var previewId = $(this).attr('id').replace('imagen', 'preview');
            if (e.target.files.length > 0) {
                var src = URL.createObjectURL(e.target.files[0]);
                $('#' + previewId).attr('src', src);
            }
        });

        // Actualizar nombre del archivo seleccionado
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>

<script>
    // Script para vista previa de imagen
    document.getElementById('imagen{{ $producto->id }}').addEventListener('change', function(e) {
        const preview = document.getElementById('preview{{ $producto->id }}');
        const file = e.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
            
            // Ocultar placeholder si existe
            const placeholder = document.querySelector('.no-image-placeholder');
            if(placeholder) placeholder.style.display = 'none';
        }
        
        if(file) {
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
