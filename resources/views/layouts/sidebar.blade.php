<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <i class="fas fa-pills ml-2"></i> <!-- Icono de farmacia -->
        <span class="brand-text font-weight-light">{{ config('app.name', 'Farmacia') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel (opcional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <!-- Productos -->
                <li class="nav-item">
                    <a href="{{ route('productos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Productos</p>
                    </a>
                </li>

                <!-- Categorías -->
                <li class="nav-item">
                    <a href="{{ route('categorias.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Categorías</p>
                    </a>
                </li>

                <!-- Proveedores -->
                <li class="nav-item">
                    <a href="{{ route('proveedores.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Proveedores</p>
                    </a>
                </li>

                <!-- Ventas -->
                <li class="nav-item">
                    <a href="{{ route('ventas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Ventas</p>
                    </a>
                </li>

                <!-- Clientes -->
                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->
