# Imagen base con PHP 8.2 + extensiones necesarias para Laravel
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    sqlite3 \
    libsqlite3-dev

# Habilitar extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear carpeta para la app
WORKDIR /var/www

# Copiar archivos
COPY . .

# Instalar dependencias del proyecto
RUN composer install --no-dev --optimize-autoloader

# Generar APP_KEY
# RUN php artisan key:generate

# Permisos para storage y cache
RUN chmod -R 777 storage bootstrap/cache

# Exponer puerto para Render
EXPOSE 8080

# Comando que ejecutará Render
CMD php artisan serve --host 0.0.0.0 --port 8080
