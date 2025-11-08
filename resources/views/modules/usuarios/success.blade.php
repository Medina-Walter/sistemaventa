@extends('layouts.main')

@section('titulo', 'Usuario Actualizado')

@section('contenido')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
  <div class="card shadow p-4 text-center" style="max-width: 400px;">
    <h2 class="text-success mb-3">¡Actualización Exitosa!</h2>
    <p class="mb-4">La información del usuario fue actualizada correctamente.</p>
    <a href="{{ route('home') }}" class="btn btn-success">Volver al Dashboard</a>
  </div>
</div>
@endsection
