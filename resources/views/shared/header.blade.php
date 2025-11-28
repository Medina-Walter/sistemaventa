<header id="header" class="header fixed-top d-flex align-items-center bg-gradient shadow-sm">

    <div class="d-flex align-items-center justify-content-between w-100 px-3">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo d-flex align-items-center text-white fw-bold">
            <i class="bi bi-shop me-2 fs-4 bg-primary rounded-circle p-1"></i>
            <span class="d-none d-lg-block">Sistema de Ventas</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn fs-3 cursor-pointer ms-3"></i>

        <!-- Perfil usuario a la derecha -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4 me-2"></i> <!-- Icono al lado -->
                    <div class="d-flex flex-column">
                        <span class="fw-bold">{{ session('usuario_nombre') }}</span>
                        <small class="text-muted">{{ ucfirst(session('usuario_rol')) }}</small>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                    <li>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-2"></i> Salir
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</header>
