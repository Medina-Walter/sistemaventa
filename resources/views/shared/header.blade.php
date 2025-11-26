<header id="header" class="header fixed-top d-flex align-items-center bg-gradient bg-primary shadow-sm">

  <div class="d-flex align-items-center justify-content-between w-100 px-3">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo d-flex align-items-center text-white fw-bold">
      <i class="bi bi-shop me-2 fs-4"></i>
      <span class="d-none d-lg-block">Sistema de Ventas</span>
    </a>

    <!-- Botón toggle sidebar -->
    <i class="bi bi-list toggle-sidebar-btn text-white fs-3 cursor-pointer"></i>
  </div>

  <!-- Navegación -->
  <nav class="header-nav ms-auto pe-3">
    <ul class="d-flex align-items-center mb-0">

      <!-- Perfil usuario -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-profile d-flex align-items-center text-white fw-semibold" href="#" data-bs-toggle="dropdown">
          <i class="fa-regular fa-circle-user fs-4 me-2"></i>
          <span class="d-none d-md-block dropdown-toggle">{{ session('usuario_nombre') }}</span>
        </a>

        <!-- Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile shadow-lg border-0">
          <li class="dropdown-header text-center bg-light py-3">
            <h6 class="fw-bold mb-0">{{ session('usuario_nombre') }}</h6>
            <span class="text-muted small">{{ ucfirst(session('usuario_rol')) }}</span>
          </li>

          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center text-danger fw-bold" href="{{ route('logout') }}">
              <i class="bi bi-box-arrow-right me-2"></i>
              <span>Salir</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>

</header>
