<aside id="sidebar" class="sidebar shadow-lg" style="background: linear-gradient(180deg, #0d6efd 0%, #0a58ca 100%);">
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
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('productos.index') }}">
        <i class="bi bi-box-seam me-2 fs-5"></i>
        <span>Productos</span>
      </a>
    </li>

    <!-- Ventas -->
    <li class="nav-item mb-3">
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" data-bs-target="#ventas-nav" data-bs-toggle="collapse">
        <i class="fa-solid fa-cart-shopping me-2 fs-5"></i>
        <span>Ventas</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="ventas-nav" class="nav-content collapse bg-light rounded-2 mt-2 ms-3 p-2 shadow-sm" data-bs-parent="#sidebar-nav">
        <li>
          <a href="" class="nav-link fw-semibold d-flex align-items-center rounded hover-sub">
            <i class="bi bi-circle me-2"></i><span>Consultar Ventas</span>
          </a>
        </li>
        <li>
          <a href="{{ route('carrito.index') }}" class="nav-link fw-semibold d-flex align-items-center rounded hover-sub">
            <i class="bi bi-circle me-2"></i><span>Carrito</span>
          </a>
        </li>
        <li>
          <a href="{{ route('detalle_venta.index') }}" class="nav-link fw-semibold d-flex align-items-center rounded hover-sub">
            <i class="bi bi-circle me-2"></i><span>Detalle Venta</span>
          </a>
        </li>
      </ul>
    </li>

    <hr class="border-light">

    <!-- Categorías -->
    <li class="nav-item mb-3">
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('categorias.index') }}">
        <i class="fa-solid fa-list me-2 fs-5"></i>
        <span>Categorías</span>
      </a>
    </li>

    <!-- Proveedores -->
    <li class="nav-item mb-3">
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('proveedores.index') }}">
        <i class="fa-solid fa-truck me-2 fs-5"></i>
        <span>Proveedores</span>
      </a>
    </li>

    <!-- Usuarios -->
    <li class="nav-item mb-3">
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('usuarios.index') }}">
        <i class="fa-solid fa-users me-2 fs-5"></i>
        <span>Usuarios</span>
      </a>
    </li>

    <!-- Reportes -->
    <li class="nav-item mb-3">
      <a class="nav-link fw-bold d-flex align-items-center rounded hover-link" href="{{ route('reportes.index') }}">
        <i class="fa-solid fa-chart-pie me-2 fs-5"></i>
        <span>Reportes</span>
      </a>
    </li>

  </ul>
</aside>

{{-- Estilos embebidos --}}
<style>
  /*estilos especificos para mejorar la apariencia
  /* Enlaces principales */
  .sidebar .nav-link {
    color: #fff !important;
    padding: 10px 12px;
    transition: all 0.3s ease;
  }

  /* Hover principal */
  .sidebar .nav-link.hover-link:hover {
    background-color: rgba(255, 255, 255, 0.2) !important;
    color: #fff !important;
    transform: translateX(5px);
  }

  /* Submenús */
  .sidebar .nav-content .nav-link {
    color: #212529 !important;
  }

  /* Hover submenú */
  .sidebar .nav-link.hover-sub:hover {
    background-color: #0d6efd !important;
    color: #fff !important;
  }
</style>
