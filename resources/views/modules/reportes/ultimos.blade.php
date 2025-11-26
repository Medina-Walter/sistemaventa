@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
<main id="main" class="main">

  <!-- Título de página -->
  <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-secondary">🕒 Últimos Productos Vendidos</h1>
    <a href="{{ route('reportes.index') }}" class="btn btn-primary btn-sm fw-bold shadow-sm">
      <i class="fa-solid fa-arrow-left me-1"></i> Volver a Reportes
    </a>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-3">
          <div class="card-body">

            <!-- Header de la card -->
            <div class="card-header bg-gradient bg-secondary text-white fw-bold rounded-top">
              Detalle de Ventas Recientes
            </div>

            <!-- Tabla -->
            <div class="card-body table-responsive p-2">
              <table class="table table-sm table-striped table-bordered align-middle mb-0">
                <thead class="table-dark">
                  <tr>
                    <th>Fecha</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($ultimosVendidos as $d)
                    <tr>
                      <td>{{ $d->venta ? $d->venta->created_at->format('d/m/Y H:i') : '' }}</td>
                      <td>{{ $d->producto ? $d->producto->codigo : '' }}</td>
                      <td>{{ $d->producto ? $d->producto->nombre : '' }}</td>
                      <td><span class="badge bg-primary">{{ $d->cantidad }}</span></td>
                      <td>${{ number_format($d->precio_unitario, 2) }}</td>
                      <td>${{ number_format($d->sub_total, 2) }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="6" class="text-muted text-center small">No hay ventas registradas.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

{{-- Estilos embebidos --}}
<style>
  .hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15) !important;
  }
</style>
@endsection
