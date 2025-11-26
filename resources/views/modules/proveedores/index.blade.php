@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
<main id="main" class="main">

  <div class="pagetitle flex justify-between items-center">
    <h1>Proveedores</h1>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center mt-3">
              <h5 class="mb-0">Proveedores registrados</h5>
                <a href="{{ route('proveedores.create') }}" class="btn btn-light text-primary fw-bold">Agregar Nuevo Proveedor</a>
            </div>
            <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Dirección</th>
              <th>Sitio web</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($proveedores as $proveedor)
              <tr>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->sitio_web }}</td>
                <td class="d-flex gap-2">
                  <a href="{{ route('proveedores.edit', $proveedor->id_proveedor) }}" class="btn btn-sm btn-primary">Editar</a>
                  <form method="POST" action="{{ route('proveedores.destroy', $proveedor->id_proveedor) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar proveedor?')">Eliminar</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
