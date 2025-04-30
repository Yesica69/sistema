@extends('adminlte::page')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary"><i class="fas fa-boxes mr-2"></i>Gestión de Productos</h1>
        <a href="{{ url('/admin/productos') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Volver
        </a>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header bg-white border-bottom-0">
                    <h3 class="card-title text-primary">
                        <i class="fas fa-plus-circle mr-2"></i>Nuevo Producto
                    </h3>
                </div>
                
                <div class="card-body">
                    <form action="{{ url('/admin/productos/create') }}" method="post" enctype="multipart/form-data" id="productForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Sección principal del formulario -->
                            <div class="col-md-8">
                                <!-- Primera fila - Categoría y Laboratorio -->
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="categoria_id" class="form-label text-primary">
                                            <i class="fas fa-tag mr-1"></i>Categoría
                                        </label>
                                        <select name="categoria_id" class="form-control select2" required>
                                            <option value="">Seleccionar una categoría</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                    {{$categoria->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categoria_id')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="laboratorio_id" class="form-label text-primary">
                                            <i class="fas fa-flask mr-1"></i>Laboratorio
                                        </label>
                                        <select name="laboratorio_id" class="form-control select2" required>
                                            <option value="">Seleccionar un laboratorio</option>
                                            @foreach($laboratorios as $laboratorio)
                                                <option value="{{ $laboratorio->id }}" {{ old('laboratorio_id') == $laboratorio->id ? 'selected' : '' }}>
                                                    {{ $laboratorio->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('laboratorio_id')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Segunda fila - Código y Nombre -->
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="codigo" class="form-label text-primary">
                                            <i class="fas fa-barcode mr-1"></i>Código
                                        </label>
                                        <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" required>
                                        @error('codigo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-9 mb-3">
                                        <label for="nombre" class="form-label text-primary">
                                            <i class="fas fa-box mr-1"></i>Nombre del Producto
                                        </label>
                                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del producto" required>
                                        @error('nombre')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label text-primary">
                                        <i class="fas fa-align-left mr-1"></i>Descripción
                                    </label>
                                    <textarea class="form-control" name="descripcion" rows="2">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <!-- Tercera fila - Stock -->
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="stock" class="form-label text-primary">
                                            <i class="fas fa-boxes mr-1"></i>Stock Actual
                                        </label>
                                        <input type="number" class="form-control" name="stock" value="{{ old('stock', 0) }}" required>
                                        @error('stock')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="stock_minimo" class="form-label text-primary">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Stock Mínimo
                                        </label>
                                        <input type="number" class="form-control" name="stock_minimo" value="{{ old('stock_minimo', 0) }}" required>
                                        @error('stock_minimo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="stock_maximo" class="form-label text-primary">
                                            <i class="fas fa-warehouse mr-1"></i>Stock Máximo
                                        </label>
                                        <input type="number" class="form-control" name="stock_maximo" value="{{ old('stock_maximo', 0) }}" required>
                                        @error('stock_maximo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Cuarta fila - Precios -->
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="precio_compra" class="form-label text-primary">
                                            <i class="fas fa-money-bill-wave mr-1"></i>Precio de Compra
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="precio_compra" value="{{ old('precio_compra') }}" required>
                                        </div>
                                        @error('precio_compra')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="precio_venta" class="form-label text-primary">
                                            <i class="fas fa-tag mr-1"></i>Precio de Venta
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="precio_venta" value="{{ old('precio_venta') }}" required>
                                        </div>
                                        @error('precio_venta')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Quinta fila - Fechas -->
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_ingreso" class="form-label text-primary">
                                            <i class="fas fa-calendar-plus mr-1"></i>Fecha de Ingreso
                                        </label>
                                        <input type="date" class="form-control" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" required>
                                        @error('fecha_ingreso')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_vencimiento" class="form-label text-primary">
                                            <i class="fas fa-calendar-times mr-1"></i>Fecha de Vencimiento
                                        </label>
                                        <input type="date" class="form-control" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}">
                                        @error('fecha_vencimiento')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sección de imagen -->
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <label class="form-label text-primary">
                                            <i class="fas fa-image mr-1"></i>Imagen del Producto
                                        </label>
                                        
                                        <div class="file-upload-wrapper mt-2">
                                            <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png" class="file-upload-input">
                                            <label for="file" class="file-upload-label">
                                                <i class="fas fa-cloud-upload-alt mr-2"></i>Seleccionar imagen
                                            </label>
                                        </div>
                                        
                                        <div class="image-preview-container mt-4">
                                            <output id="list" class="img-fluid rounded shadow" style="max-height: 200px;"></output>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12 text-right">
                                <button type="reset" class="btn btn-outline-secondary mr-2">
                                    <i class="fas fa-undo mr-1"></i> Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Guardar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Estilos generales */
    .card {
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }
    
    .card-header {
        padding: 1rem 1.5rem;
        background-color: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    /* Estilos para formulario */
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
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
    
    /* Botones */
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
    
    /* Mensajes de error */
    .text-danger {
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
</style>
@endsection

@section('js')
<script>
    // Script para vista previa de imagen
    document.getElementById('file').addEventListener('change', function(e) {
        const preview = document.getElementById('list');
        const files = e.target.files;

        // Limpiar vista previa
        preview.innerHTML = '';

        // Iterar sobre los archivos seleccionados
        for (let i = 0, f; f = files[i]; i++) {
            // Verificar si es una imagen
            if (!f.type.match('image.*')) {
                continue;
            }

            const reader = new FileReader();
            
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'img-fluid rounded shadow';
                img.style.maxHeight = '200px';
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(f);
        }
    });
    
    // Inicializar select2
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>
@endsection