@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Clientes</b></h1>
    
@stop

@section('content')
    
<div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro de una nuevo cliente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                
              </div>
             
              <div class="card-body">
                
                <form action="{{ url('/admin/clientes/create') }}" method="post">
                    
                    @csrf

                    <div class="row">
                    <!-- Campo Nombre  -->
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_cliente">Nombre</label>
                                <input type="text" class="form-control" value="{{ old('nombre_cliente') }}" name="nombre_cliente" required>
                                
                                @error('nombre_cliente')
                                <small style="color: red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>   
                         <!-- Campo Nit -->
                    <div class="col-md-2">
                            <div class="form-group">
                                <label for="nit_ci">NIT/CI</label>
                                <input type="text" class="form-control" value="{{ old('nit_ci') }}" name="nit_ci" >
                                
                                @error('nit_ci')
                                <small style="color: red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>  
                        <!-- Campo Nombre  -->
                    <div class="col-md-2">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" value="{{ old('celular') }}" name="celular" >
                                
                                @error('celular')
                                <small style="color: red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>                 
                        <!-- Campo Correo -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <div class="input-group">
                                    <input type="email" value="{{ old('email') }}" class="form-control" name="email" >
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">
                                            <i class="fas fa-save"></i> Registrar
                                        </button>
                                    </div>
                                </div>

                                @error('email')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>



    <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Clientes registrados</h3>
                <div class="card-tools">
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
                            <th scope="col" style="text-align: center">Nombre </th>
                            <th scope="col" style="text-align: center">NIT/CI </th>
                            <th scope="col" style="text-align: center">Celular</th>
                            <th scope="col" style="text-align: center">Correo</th>
                            <th scope="col"style="text-align: center">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;?>
                        @foreach($clientes as $cliente)
                        <tr>
                           
                            <td style="text-align: center">{{$contador++}}</td>
                            <td >{{$cliente->nombre_cliente}}</td>
                            <td >{{$cliente->celular}}</td>
                            <td >{{$cliente->nit_ci}}</td>
                            <td >{{$cliente->email}}</td>
                            <td style="text-align: center">
                    <!-- Botón Editar -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal{{ $cliente->id }}">
                        <i class="fas fa-pencil"></i> 
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="{{ url('/admin/clientes', $cliente->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" >
                            <i class="fas fa-trash"></i> 
                        </button>
                    </form>

                    <!-- MODAL PARA EDITAR -->
                    <div class="modal fade" id="editModal{{ $cliente->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar el cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/admin/clientes', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- Campo Nombre -->
                                                                                    
                                        <div class="form-group">
                                        <label for="nombre_cliente">Nombre del cliente</label>
                                        <input type="text" class="form-control" value="{{$cliente->nombre_cliente}}" name="nombre_cliente"  >
                                                            
                                       @error('nombre_cliente')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                       <!-- Campo NIT/CI-->
                                                                                    
                                       <div class="form-group">
                                        <label for="nit_ci">NIT/CI</label>
                                        <input type="text" class="form-control" value="{{$cliente->nit_ci}}" name="nit_ci" >
                                                            
                                       @error('nit_ci')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                                <!-- Campo celular-->
                                                                                    
                                        <div class="form-group">
                                        <label for="celular">Celular</label>
                                        <input type="text" class="form-control" value="{{$cliente->celular}}" name="celular" >
                                                            
                                       @error('celular')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                        <!-- Campo Correo-->
                                                                                    
                                        <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="text" class="form-control" value="{{$cliente->email}}" name="email" >
                                                            
                                       @error('email')
                                        <small style="color: red;">{{$message}}</small>
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