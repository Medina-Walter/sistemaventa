@extends('layouts.main')

@section('titulo', 'Listado de Proveedores')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Proveedores</h2>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
      <div class="card-body">
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

        <div class="mt-3">
          {{ $proveedores->links() }}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
