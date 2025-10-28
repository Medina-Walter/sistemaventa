<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-bold mb-4 text-center">Editar Usuario</h2>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="apellido" class="block text-gray-700">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $usuario->apellido) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="usuario" class="block text-gray-700">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="{{ old('usuario', $usuario->usuario) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="rol" class="block text-gray-700">Rol</label>
            <input type="text" name="rol" id="rol" value="{{ old('rol', $usuario->rol) }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="flex justify-between">
            <a href="/home" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Actualizar
            </button>
        </div>
    </form>
</body>
</html>
