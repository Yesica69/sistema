@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Laboratorios</b></h1>
    
@stop

@section('content')
    
<div class="row">
         



    <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Laboratorios registrados</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
                     <i class="fas fa-plus"></i> Nuevo Laboratorio
                                    </button>
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
                            <th scope="col" style="text-align: center">Nombre del laboratorio</th>
                            <th scope="col" style="text-align: center">Telefono</th>
                            <th scope="col" style="text-align: center">Direccion</th>
                            <th scope="col"style="text-align: center">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;?>
                        @foreach($laboratorios as $laboratorio)
                        <tr>
                           
                            <td style="text-align: center">{{$contador++}}</td>
                            <td >{{$laboratorio->nombre}}</td>
                            <td >{{$laboratorio->telefono}}</td>
                            <td >{{$laboratorio->direccion}}</td>
                            <td style="text-align: center">
                    <!-- Botón Editar -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal{{ $laboratorio->id }}">
                        <i class="fas fa-pencil"></i> 
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="{{ url('/admin/laboratorios', $laboratorio->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" >
                            <i class="fas fa-trash"></i> 
                        </button>
                    </form>


                     <!--//modal para crear una nueva laboratorio-->
                         <div class="modal fade" id="modalCrear" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- Header del modal -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="exampleModalLabel"><b>Registrar Categoría</b></h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Cuerpo del modal con el formulario -->
                                        <div class="modal-body">
                                        
                                            <!-- Formulario para crear una categoría -->
                                            <form action="{{ url('/admin/laboratorios/create') }}" method="post">
                    
                                                    @csrf

                                                    <div class="row">
                                                    <!-- Campo Nombre  -->
                                                    <div class="col-md-12">
                                                    <div class="form-group text-left">
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre del laboratorio</label>
                                                                <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" required>
                                                                
                                                                @error('nombre')
                                                                <small style="color: red;">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                        </div>   
                                                        <!-- Campo Nombre  -->
                                                    <div class="col-md-12">
                                                    <div class="form-group text-left">
                                                            <div class="form-group">
                                                                <label for="telefono">Telefono</label>
                                                                <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono" required>
                                                                
                                                                @error('telefono')
                                                                <small style="color: red;">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                        </div>                 
                                                        <!-- Campo Direccion -->
                                                        <div class="col-md-12">
                                                        <div class="form-group text-left">
                                                            <div class="form-group">
                                                                <label for="direccion">Direccion</label>
                                                                <div class="input-group">
                                                                    <input type="text" value="{{ old('direccion') }}" class="form-control" name="direccion" required>
                                                                    
                                                                </div>

                                                                @error('direccion')
                                                                    <small style="color: red;">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                           

                                                        </div>
                                                        <div class="input-group-append text-right">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-save"></i> Registrar
                                                                </button>
                                                            </div>
                                                </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    <!-- MODAL PARA EDITAR -->
                    <div class="modal fade" id="editModal{{ $laboratorio->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Laboratorio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/admin/laboratorios', $laboratorio->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- Campo Nombre -->
                                                                                    
                                        <div class="form-group">
                                        <label for="nombre">Nombre de la categoria</label>
                                        <input type="text" class="form-control" value="{{$laboratorio->nombre}}" name="nombre"  >
                                                            
                                       @error('nombre')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                                <!-- Campo telefono-->
                                                                                    
                                        <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control" value="{{$laboratorio->telefono}}" name="telefono" >
                                                            
                                       @error('telefono')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                        <!-- Campo Direccion-->
                                                                                    
                                        <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" value="{{$laboratorio->direccion}}" name="direccion" >
                                                            
                                       @error('direccion')
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