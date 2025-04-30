@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Proveedores</b></h1>
    
@stop

@section('content')
    
<div class="row">
          
    <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Proveedores registrados</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
                     <i class="fas fa-plus"></i> Nuevo 
                                    </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                
              </div>
             
              <div class="card-body">
                
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Empresa</th>
                            <th scope="col" style="text-align: center">Direccion</th>
                            <th scope="col" style="text-align: center">Telefono</th>
                            <th scope="col" style="text-align: center">Correo</th>
                            <th scope="col" style="text-align: center">Nombre del proveedor</th>
                            <th scope="col" style="text-align: center">Celular</th>
                            <th scope="col"style="text-align: center">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;?>
                        @foreach($proveedores as $proveedor)
                        <tr>
                           
                            <td style="text-align: center">{{$contador++}}</td>
                            <td >{{$proveedor->empresa}}</td>
                            <td >{{$proveedor->direccion}}</td>
                            <td >{{$proveedor->telefono}}</td>
                            <td >{{$proveedor->email}}</td>
                            <td >{{$proveedor->nombre}}</td>
                            <td>
                                <a href="https://wa.me/591{{$proveedor->celular}}" target="_blank"
                                class="btn btn-success" target="_blank"><i class="fa-brands fa-whatsapp"></i>
                                    {{$proveedor->celular}}
                                   

                            
                                </a>
                            </td>
                            <td style="text-align: center">


                              <!-- Botón Ver -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#verModal{{ $proveedor->id }}">
                    <i class="fas fa-eye"></i>
                            </button>
                    <!-- Botón Editar -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal{{ $proveedor->id }}">
                        <i class="fas fa-pencil"></i> 
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="{{ url('/admin/proveedores', $proveedor->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" >
                            <i class="fas fa-trash"></i> 
                        </button>
                    </form>


                                <div class="row">
                               

                                 <!--//modal para crear una nueva laboratorio-->
                         <div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- Header del modal -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="exampleModalLabel"><b>Registrar Proveedor</b></h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Cuerpo del modal con el formulario -->
                                        <div class="modal-body">
                                        <div class="form-group text-left">
                                            <!-- Formulario para crear una categoría -->
                                            <form action="{{ url('/admin/proveedores/create') }}" method="post">
                    
                                                @csrf

                                                <div class="row">
                                                    <!-- Campo Nombre  -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="empresa">Empresa</label>
                                                            <input type="text" class="form-control" value="{{ old('empresa') }}" name="empresa" required>
                                                            
                                                            @error('empresa')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Campo Nombre  -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="direccion">Direccion</label>
                                                            <input type="text" class="form-control" value="{{ old('direccion') }}" name="direccion" required>
                                                            
                                                            @error('direccion')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Campo Nombre  -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telefono">Telefono</label>
                                                            <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono" required>
                                                            
                                                            @error('telefono')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Campo Nombre  -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Correo</label>
                                                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" required>
                                                            
                                                            @error('email')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                <!-- Campo Nombre  -->
                                                <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre del proveedor</label>
                                                            <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" required>
                                                            
                                                            @error('nombre')
                                                            <small style="color: red;">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>   
                                                                
                                                    <!-- Campo Direccion -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="celular">Celular</label>
                                                            <div class="input-group">
                                                                <input type="text" value="{{ old('celular') }}" class="form-control" name="celular" required>
                                                               
                                                            </div>

                                                            @error('celular')
                                                                <small style="color: red;">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                                                        <i class="fas fa-save"></i> Registrar
                                                                    </button>
                                                                </div>
                                                    </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>


                                     <!-- MODAL PARA VER -->
                                     <div class="modal fade" id="verModal{{ $proveedor->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Header del modal -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Proveedor registrado</b></h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Formulario -->
                                                <form action="{{ route('admin.proveedores.show', $proveedor->id) }}" method="GET">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body" >
                                                         <!-- Campo: Fecha de registro -->
                                                         <div class="form-group text-left">
                                                            <label for="empresa" class="text-dark font-weight-bold">Empresa</label>
                                                            <p > {{$proveedor->empresa }}</p>
                                                            @error('empresa')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <!-- Campo: Fecha de registro -->
                                                        <div class="form-group text-left">
                                                            <label for="direccion" class="text-dark font-weight-bold">Direccion</label>
                                                            <p > {{$proveedor->direccion }}</p>
                                                            @error('direccion')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <!-- Campo: Fecha de registro -->
                                                        <div class="form-group text-left">
                                                            <label for="telefono" class="text-dark font-weight-bold">Telefono</label>
                                                            <p > {{$proveedor->telefono }}</p>
                                                            @error('telefono')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <!-- Campo: Correo -->
                                                        <div class="form-group text-left">
                                                            <label for="email" class="text-dark font-weight-bold">Correo</label>
                                                            <p > {{$proveedor->email }}</p>
                                                            @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                     
                                                        <!-- Campo: Nombre del proveedor -->
                                                        <div class="form-group text-left">
                                                            <label for="name" class="text-dark font-weight-bold">Nombre del proveedor</label>
                                                            <p > {{$proveedor->name }}</p>
                                                            @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        
                                                        <!-- Campo: Fecha de registro -->
                                                        <div class="form-group text-left">
                                                            <label for="celular" class="text-dark font-weight-bold">Celular</label>
                                                            <p> {{$proveedor->celular }}</p>
                                                            @error('celular')
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

                                </div>


                    <!-- MODAL PARA EDITAR -->
                    <div class="modal fade" id="editModal{{ $proveedor->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                              


<!-- Formulario -->
<form action="{{ url('/admin/proveedores', $proveedor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-left">
                        <div class="row">
                            <!-- Primera columna -->
                            <div class="col-md-6">
                               
                                    
                                    
                                        <div class="form-group">
                                            <label for="empresa">Empresa</label>
                                            <input type="text" class="form-control" name="empresa" value="{{ $proveedor->empresa }}" required>
                                            @error('empresa')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Direccion</label>
                                            <input type="text" class="form-control" name="direccion" value="{{ $proveedor->direccion }}" required>
                                            @error('direccion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <!-- Segunda fila -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="text" class="form-control"  value="{{ $proveedor->telefono }}" name="telefono">
                                            @error('telefono')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input type="textr" class="form-control" value="{{ $proveedor->email }}" name="email" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    

                                <!-- Tercera fila -->
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Producto</label>
                                            <input type="text" class="form-control" value="{{ $proveedor->nombre }}" name="nombre"  required>
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="text" class="form-control" value="{{ $proveedor->celular }}"  name="celular" required>
                                            @error('celular')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                   
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

                    </div>
                </div>


            </div>
        </div>
    </div>
</td>
    </form>
</td>


                                        
                            
                        </tr>
                        
                        @endforeach
                    </thody>
                       
                        
                </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
          
</div>
@stop

@section('css')

    
@stop

@section('js')
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