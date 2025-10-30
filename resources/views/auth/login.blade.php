<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('login.submit') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center">Iniciar Sesión</h2>

        {{-- Mostrar errores generales --}}
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
            <label for="usuario" class="block text-gray-700">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
            Ingresar
        </button>
    </form>
</body>
</html>
