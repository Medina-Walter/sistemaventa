🛒 Sistema de Venta (Laravel - PHP - MySQL)

Aplicación web para gestionar un sistema de ventas con usuarios, productos y facturación.

✅ Requisitos

Antes de ejecutar el proyecto, asegurate de tener instalado:

| Software               | Versión recomendada             |
| ---------------------- | ------------------------------- |
| PHP                    | 8.1 o superior                  |
| Composer               | Última versión                  |
| MySQL / MariaDB        | Cualquier versión compatible    |
| XAMPP / Laragon / WAMP | (Opcional, para servidor local) |


Instalación y ejecución del proyecto
1. Clonar el repositorio

git clone https://github.com/usuario/sistemaventa.git
cd sistemaventa

2. Instalar dependencias
composer install

3. Configurar .env

Copiar el archivo de ejemplo:
cp .env.example .env

Configurar las credenciales de tu base de datos en el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistemaventa
DB_USERNAME=root
DB_PASSWORD=


4. Generar clave de aplicación
php artisan key:generate

5. Levantar el servidor
php artisan serve