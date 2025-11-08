<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('productos.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Productos</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse">
                <i class="fa-solid fa-cart-shopping"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Consultar Ventas</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Carrito</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Ventas Nav -->

        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('categorias.index') }}">
                <i class="fa-solid fa-list"></i>
                <span>Categorías</span>
            </a>
        </li><!-- End Blank Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('proveedores.index') }}">
                <i class="fa-solid fa-truck"></i>
                <span>Proveedores</span>
            </a>
        </li><!-- End Blank Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('usuarios.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Usuarios</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside>
