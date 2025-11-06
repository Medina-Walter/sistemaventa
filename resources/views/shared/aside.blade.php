<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#productos-nav" data-bs-toggle="collapse">
        <i class="bi bi-menu-button-wide"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="productos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('productos.index') }}">
            <i class="bi bi-circle"></i><span>Administrar productos</span>
          </a>
        </li>
        <li>
          <a href="{{ route('productos.create') }}">
            <i class="bi bi-circle"></i><span>Registrar nuevo producto</span>
          </a>
        </li>
      </ul>
    </li><!-- End Productos Nav -->

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
      <a class="nav-link collapsed" data-bs-target="#categorias-nav" data-bs-toggle="collapse">
        <i class="fa-solid fa-list"></i><span>Categorías</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="categorias-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('categorias.index') }}">
            <i class="bi bi-circle"></i><span>Listado de categorías</span>
          </a>
        </li>
        <li>
          <a href="{{ route('categorias.create') }}">
            <i class="bi bi-circle"></i><span>Registrar nueva categoría</span>
          </a>
        </li>
      </ul>
    </li><!-- End Categorías Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#proveedores-nav" data-bs-toggle="collapse">
        <i class="fa-solid fa-truck"></i><span>Proveedores</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="proveedores-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('proveedores.index') }}">
            <i class="bi bi-circle"></i><span>Listado de proveedores</span>
          </a>
        </li>
        <li>
          <a href="{{ route('proveedores.create') }}">
            <i class="bi bi-circle"></i><span>Registrar nuevo proveedor</span>
          </a>
        </li>
      </ul>
    </li><!-- End Proveedores Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("usuarios.index") }}">
          <i class="fa-solid fa-users"></i>
          <span>Usuarios</span>
        </a>
      </li><!-- End Blank Page Nav -->

  </ul>
</aside>
