@extends('adminlte::page')

@section('content_header')
    <h1><b>Usuarios</b></h1>
@endsection

@section('content')
<div class="row">
    <!-- Tabla de usuarios registrados -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Usuarios registrados</h3>
                            

                <div class="card-tools">
                   
       

  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalCrear">
  <i class="fas fa-plus"></i> Nuevo Usuario
                                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Nombre del Usuario</th>
                            <th scope="col" style="text-align: center">Correo</th>
                            <th scope="col" style="text-align: center">Rol</th>
                            <th scope="col" style="text-align: center">Sucursal</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td style="text-align: center">{{ $contador++ }}</td>
                                <td >{{ $usuario->name }}</td>
                                <td >{{ $usuario->email }}</td>
                                <td > {{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                <td > {{ $usuario->sucursal_id }}</td>
                                <td style="text-align: center">

                                      <!-- Botón ver-->
                                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#verModal{{ $usuario->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Botón Editar -->
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editarModal{{ $usuario->id }}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <!-- MODAL PARA VER -->
                                    <div class="modal fade" id="verModal{{ $usuario->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Header del modal -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Usuario registrado</b></h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Formulario -->
                                                <form action="{{ route('admin.usuarios.show', $usuario->id) }}" method="GET">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body" >
                                                        <!-- Campo: Rol -->
                                                        <div class="form-group text-left">
                                                            <label for="name" class="text-dark font-weight-bold">Nombre del rol</label>
                                                            <p class=" font-weight-bold"> {{ $usuario->roles->pluck('name')->implode(', ') }}</p>
                                                        </div>
                                                        <!-- Campo: Nombre del usuario -->
                                                        <div class="form-group text-left">
                                                            <label for="name" class="text-dark font-weight-bold">Nombre del usuario</label>
                                                            <p class= "font-weight-bold"> {{$usuario->name }}</p>
                                                            @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <!-- Campo: Correo -->
                                                        <div class="form-group text-left">
                                                            <label for="email" class="text-dark font-weight-bold">Correo</label>
                                                            <p class="font-weight-bold"> {{$usuario->email }}</p>
                                                            @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <!-- Campo: Fecha de registro -->
                                                        <div class="form-group text-left">
                                                            <label for="password" class="text-dark font-weight-bold">Fecha y hora de registro</label>
                                                            <p class=" font-weight-bold"> {{$usuario->created_at }}</p>
                                                            @error('password')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Footer del modal -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <!-- MODAL PARA EDITAR USUARIO -->
                                    <div class="modal fade" id="editarModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $usuario->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Header del modal -->
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title" id="editarModalLabel{{ $usuario->id }}"><b>Editar Usuario</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Formulario -->
                                                <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role-{{ $usuario->id }}">Nombre del Rol</label>
                                                            <select name="role" id="role-{{ $usuario->id }}" class="form-control">
                                                                <option value="">Seleccionar un Rol</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->name }}" {{ $role->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                  

                                                    <!-- Campo Nombre del Usuario -->
                                               
                                                        <div class="form-group">
                                                            <label for="name">Nombre del usuario</label>
                                                            <input type="text" class="form-control" value="{{$usuario->name}}" name="name" required >
                                                            
                                                            @error('name')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                  
                                                     <!-- Campo Nombre del Usuario -->
                                                    
                                                        <div class="form-group">
                                                            <label for="email">Correp del usuario</label>
                                                            <input type="email" class="form-control" value="{{$usuario->email}}" name="email" required >
                                                            
                                                            @error('email')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                     
                                                     <!-- Campo Nombre del Usuario -->
                                                    
                                                     <div class="form-group">
                                                            <label for="password">Cotraseña</label>
                                                            <input type="password" class="form-control" value="{{old('password')}}" name="password"  >
                                                            
                                                            @error('password')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    
                                                      <!-- Campo Nombre del Usuario -->
                                    
                                                      <div class="form-group">
                                                            <label for="password_confirmation">Confirmacion de Cotraseña</label>
                                                            <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation"  >
                                                            
                                                            
                                                        </div>
                                                    </div>    
                                                    

                                                    <!-- Footer del modal -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>
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
<div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Header del modal -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Usuario registrado</b></h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Formulario -->
                                                <div class="row">
    <!-- Formulario para crear un usuario -->
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/usuarios/create')}}" method="post">
                    @csrf
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="sucursal">Sucursal</label>
                                <select name="sucursal" id="" class="form-control" required>
                                    <option value="">Seleccionar una sucursal</option>
                                    @foreach($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Campo Rol -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Nombre del Rol</label>
                                <select name="role" id="" class="form-control" required>
                                    <option value="">Seleccionar un Rol</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <!-- Campo Nombre del Usuario -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del usuario</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" required autocomplete="off">
                                
                                @error('name')
                                <small style="color: red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Carnet de identidad</label>
                               <input type="number" name="ci" class="form-control">
                            </div>
                        </div>                  
                        <!-- Campo Correo -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" value="{{ old('email') }}" name="email" required autocomplete="off">
                                
                                @error('email')
                                <small style="color: red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('/admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                <i class="fas fa-save"></i> Registrar
                            </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
                                            </div>
                                        </div>
                                    </div>


@endsection

@section('css')
@endsection

@section('js')
@endsection