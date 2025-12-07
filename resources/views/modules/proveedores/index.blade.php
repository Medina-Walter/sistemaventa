@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div
                                class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center rounded-top mt-3">
                                <h5 class="mb-0 fw-bold">Proveedores registrados</h5>
                                <a href="{{ route('proveedores.create') }}"
                                    class="btn btn-light text-primary fw-bold">Agregar Nuevo Proveedor</a>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Teléfono</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Dirección</th>
                                        <th class="text-center">Sitio web</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td class="text-center">{{ $proveedor->nombre }}</td>
                                            <td class="text-center">{{ $proveedor->telefono }}</td>
                                            <td class="text-center">{{ $proveedor->email }}</td>
                                            <td class="text-center">{{ $proveedor->direccion }}</td>
                                            <td class="text-center">{{ $proveedor->sitio_web }}</td>
                                            <td class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                                                    class="btn btn-sm btn-primary">Editar</a>
                                                <form method="POST"
                                                    action="{{ route('proveedores.destroy', $proveedor->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Eliminar proveedor?')">Eliminar</button>
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
