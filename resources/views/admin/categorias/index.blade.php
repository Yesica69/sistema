@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Categorias</b></h1>
    
@stop

@section('content')
    
<div class="row">
          



    <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Categorias registrados</h3>
                <div class="card-tools">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
  <i class="fas fa-plus"></i> Nuevo Categoria
                                    </button>
                                   

                                  

                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                
              </div>
             
              <div class="card-body">
                
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Nombre de la categoria</th>
                            <th scope="col" style="text-align: center">descripcion</th>
                            
                            <th scope="col"style="text-align: center">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;?>
                        @foreach($categorias as $categoria)
                        <tr>
                           
                            <td style="text-align: center">{{$contador++}}</td>
                            <td >{{$categoria->nombre}}</td>
                            <td >{{$categoria->descripcion}}</td>

                            <td style="text-align: center">
                            <div class="btn-group" role="group">
                    <!-- Botón Editar -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal{{ $categoria->id }}">
                        <i class="fas fa-pencil"></i> 
                    </button>

                    <!-- Botón Eliminar -->
                            <form action="{{ url('/admin/categorias', $categoria->id) }}" method="POST" 
                                onclick="preguntar{{$categoria->id}}(event)" id="miFormulario{{$categoria->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                            </div>

                            <script>
                                function preguntar{{$categoria->id}}(event) {
                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente
                                    Swal.fire({
                                        title: '¿Desea eliminar esta categoría? Si elimina esta categoría, se eliminarán todas las categorías relacionada en la tabla productoss.',
                                        text: '',
                                        icon: 'question',
                                        showCancelButton: true,
                                        cancelButtonText: 'Cancelar',
                                        confirmButtonColor: '#a5161d',
                                        cancelButtonColor: '#270a0a',
                                        confirmButtonText: 'Eliminar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            var form = $('#miFormulario{{$categoria->id}}');
                                            form.submit(); // Envía el formulario si se confirma la eliminación
                                        }
                                    });
                                }
                            </script>
                            <!--//modal para crear una nueva categori-->
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
                                            <form action="{{ url('/admin/categorias/create') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nombre">Nombre de la Categoría</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                                    @error('nombre')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="descripcion">Descripción</label>
                                                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required>
                                                    @error('descripcion')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group text-center">
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
                    <div class="modal fade" id="editModal{{ $categoria->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/admin/categorias', $categoria->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- Campo Nombre del Usuario -->
                                                                                    
                                        <div class="form-group">
                                        <label for="nombre">Nombre de la categoria</label>
                                        <input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre"  >
                                                            
                                       @error('nombre')
                                        <small style="color: red;">{{$message}}</small>
                                          @enderror
                                       </div>
                                                <!-- Campo Nombre del Usuario -->
                                                                                    
                                        <div class="form-group">
                                        <label for="descripcion">Descripcion</label>
                                        <input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion" >
                                                            
                                       @error('descripcion')
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

