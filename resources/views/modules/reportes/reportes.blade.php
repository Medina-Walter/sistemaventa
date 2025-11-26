@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
<main id="main" class="main">

  <!-- Título de página -->
  <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-primary">📊 Reportes</h1>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-3">
          <div class="card-body">

            <!-- Header de la card con botón PDF -->
            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
              <h5 class="mb-0 fw-bold">Resumen de Ventas</h5>
              <a href="{{ route('reportes.exportarPdf') }}" 
                 class="btn btn-danger btn-sm fw-bold shadow-sm">
                 <i class="fa-solid fa-file-pdf me-1"></i> Exportar a PDF
              </a>
            </div>

            <!-- Métricas principales -->
            <div class="row mt-3">
              <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border-0 rounded-3 hover-card">
                  <div class="card-body text-center py-3">
                    <i class="fa-solid fa-calendar-day text-primary mb-1"></i>
                    <p class="mb-1 small">Ventas de Hoy</p>
                    <h5 class="fw-bold mb-0">{{ $ventasHoy ?? 0 }}</h5>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border-0 rounded-3 hover-card">
                  <div class="card-body text-center py-3">
                    <i class="fa-solid fa-sack-dollar text-success mb-1"></i>
                    <p class="mb-1 small">Total Ventas</p>
                    <h5 class="fw-bold mb-0">{{ $totalVentas ?? 0 }}</h5>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border-0 rounded-3 hover-card">
                  <div class="card-body text-center py-3">
                    <i class="fa-solid fa-star text-warning mb-1"></i>
                    <p class="mb-1 small">Producto Más Vendido</p>
                    @if(!empty($productoMasVendidoCard))
                      <p class="fw-bold mb-0">{{ $productoMasVendidoCard->nombre }}</p>
                      <span class="badge bg-secondary">Cod: {{ $productoMasVendidoCard->codigo }}</span>
                      <p class="mt-1 mb-0 small">Cant: <strong>{{ $productoMasVendidoCard->cantidad }}</strong></p>
                    @else
                      <p class="text-muted small mb-0">No hay ventas registradas.</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- Productos con bajo stock -->
            <div class="card shadow-sm mt-4 border-0 rounded-3">
              <div class="card-header bg-danger text-white fw-bold small">
                <i class="fa-solid fa-box-open me-2"></i> Productos con Bajo Stock
              </div>
              <div class="card-body table-responsive p-2">
                <table class="table table-sm table-hover align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($bajoStock as $p)
                      <tr>
                        <td>{{ $p->codigo }}</td>
                        <td>{{ $p->nombre }}</td>
                        <td><span class="badge bg-danger">{{ $p->stock }}</span></td>
                      </tr>
                    @empty
                      <tr><td colspan="3" class="text-muted text-center small">No hay productos con bajo stock.</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Acceso a últimos productos vendidos -->
            <div class="card shadow-sm mt-4 border-0 rounded-3">
              <div class="card-header bg-secondary text-white fw-bold small d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-clock-rotate-left me-2"></i> Últimos Productos Vendidos</span>
                <a href="{{ route('reportes.ultimos') }}" class="btn btn-light btn-sm fw-bold shadow-sm">
                  Ver detalle <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
              </div>
              <div class="card-body p-2">
                <p class="text-muted small mb-0">Consulta el detalle completo de los últimos productos vendidos en la sección dedicada.</p>
              </div>
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
