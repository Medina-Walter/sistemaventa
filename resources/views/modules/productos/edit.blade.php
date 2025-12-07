@extends('layouts.main')

@section('titulo', 'Editar Producto')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header fw-bold text-center">Editar producto</div>

          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <!-- Nombre -->
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
              </div>

              <!-- Código -->
              <div class="mb-3">
                <label class="form-label">Código de barra</label>
                <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $producto->codigo) }}" required>
              </div>

              <!-- Descripción -->
              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
              </div>

              <!-- Stock -->
              <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
              </div>

              <!-- Precio compra -->
              <div class="mb-3">
                <label class="form-label">Precio de compra</label>
                <input type="number" step="0.01" name="precio_compra" class="form-control" value="{{ old('precio_compra', $producto->precio_compra) }}" required>
              </div>

              <!-- Precio venta -->
              <div class="mb-3">
                <label class="form-label">Precio de venta</label>
                <input type="number" step="0.01" name="precio_venta" class="form-control" value="{{ old('precio_venta', $producto->precio_venta) }}" required>
              </div>

              <!-- Categoría -->
              <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select" required>
                  <option value="">Seleccionar categoría</option>
                  @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        {{ old('id_categoria', $producto->id_categoria) == $categoria->id ? 'selected' : '' }}>
                      {{ $categoria->nombre }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Proveedor -->
              <div class="mb-3">
                <label class="form-label">Proveedor</label>
                <select name="id_proveedor" class="form-select">
                  <option value="">Seleccionar proveedor</option>
                  @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" 
                        {{ old('id_proveedor', $producto->id_proveedor) == $proveedor->id ? 'selected' : '' }}>
                      {{ $proveedor->nombre }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Imagen actual -->
              <div class="mb-3">
                <label class="form-label">Imagen actual</label><br>
                @if ($producto->imagen)
                  <img src="{{ asset($producto->imagen->ruta) }}" alt="Imagen actual" width="100">
                @else
                  <span class="text-muted">Sin imagen</span>
                @endif
              </div>

              <!-- Cambiar imagen -->
              <div class="mb-3">
                <label class="form-label">Cambiar imagen</label>
                <input type="file" name="imagen" class="form-control">
              </div>

              <!-- Botones -->
              <div class="d-flex justify-content-between">
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar producto</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
