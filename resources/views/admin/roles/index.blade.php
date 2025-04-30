@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Roles</b></h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Registro de roles</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/roles/create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <div class="input-group">
                                    <input type="text" value="{{ old('name') }}" class="form-control" name="name" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                            <i class="fas fa-save"></i> Registrar
                                        </button>
                                        <a href="{{ url('/admin/roles/reporte') }}" target="_blank" class="btn btn-danger" style="margin-left: 20px;">
                                            <i class="fas fa-file-pdf"></i> reporte
                                        </a>
                                    </div>
                                </div>
                                @error('name')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de roles -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Roles registrados</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align: center">Nro</th>
                            <th style="text-align: center">Nombre del rol</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($roles as $role)
                        <tr>
                            <td style="text-align: center">{{ $contador++ }}</td>
                            <td style="text-align: center">{{ $role->name }}</td>
                            <td style="text-align: center">
                                <!-- Botón Asignar -->
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#asignarModal{{ $role->id }}">
                                    <i class="fas fa-check"></i>
                                </button>

                                <!-- Botón Editar -->
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal{{ $role->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <!-- Formulario Eliminar -->
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este rol?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <!-- Modal Editar -->
                                <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{ $role->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $role->id }}">Editar Rol</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nombre del Rol</label>
                                                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @foreach($roles as $rol)
<!-- Modal Asignar -->
<div class="modal fade" id="asignarModal{{ $rol->id }}" tabindex="-1" role="dialog" aria-labelledby="asignarLabel{{ $rol->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><b>Asignar permisos al rol: {{ $rol->name }}</b></h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ url('/admin/roles/asignar', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @foreach($permisos as $permiso)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                                {{ $rol->permissions->contains($permiso->id) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permiso->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<!-- Estilos adicionales si necesitas -->
@stop

@section('js')
<!-- Asegúrate de tener jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@stop
