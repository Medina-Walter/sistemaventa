<aside id="sidebar" class="sidebar shadow-lg">
    <ul class="sidebar-nav p-3" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item mb-3">
            <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('home') }}">
                <i class="bi bi-speedometer2 me-2 fs-5"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Productos -->
        <li class="nav-item mb-3">
            <a class="nav-link fw-bold d-flex align-items-center rounded hover-link"
                href="{{ route('productos.index') }}">
                <i class="bi bi-box-seam me-2 fs-5"></i>
                <span>Productos</span>
            </a>
        </li>

        <!-- Ventas -->
        <li class="nav-item mb-3">
            <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" data-bs-target="#ventas-nav"
                data-bs-toggle="collapse">
                <i class="fa-solid fa-cart-shopping me-2 fs-5"></i>
                <span>Ventas</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ventas-nav" class="nav-content collapse bg-light rounded-2 mt-2 ms-3 p-2 shadow-sm"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ventas.index') }}"
                        class="nav-link fw-semibold d-flex align-items-center rounded hover-sub">
                        <i class="bi bi-circle me-2"></i><span>Consultar Ventas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('carrito.index') }}"
                        class="nav-link fw-semibold d-flex align-items-center rounded hover-sub">
                        <i class="bi bi-circle me-2"></i><span>Carrito</span>
                    </a>
                </li>
            </ul>
        </li>

        <hr class="border-light">

        <!-- Categorías -->
        <li class="nav-item mb-3">
            <a class="nav-link fw-bold d-flex align-items-center rounded hover-link"
                href="{{ route('categorias.index') }}">
                <i class="fa-solid fa-list me-2 fs-5"></i>
                <span>Categorías</span>
            </a>
        </li>

        <!-- Proveedores -->
        <li class="nav-item mb-3">
            <a class="nav-link fw-bold d-flex align-items-center rounded hover-link"
                href="{{ route('proveedores.index') }}">
                <i class="fa-solid fa-truck me-2 fs-5"></i>
                <span>Proveedores</span>
            </a>
        </li>

        <!-- Usuarios (solo admins) -->
        @can('ver-admin')
            <li class="nav-item mb-3">
                <a class="nav-link fw-bold d-flex align-items-center rounded hover-link"
                    href="{{ route('usuarios.index') }}">
                    <i class="fa-solid fa-users me-2 fs-5"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        @endcan
    </ul>
</aside>
