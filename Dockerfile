FROM richarvey/nginx-php-fpm:latest

# 1. Definimos explícitamente el directorio de trabajo
WORKDIR /var/www/html

# 2. Copiamos los archivos DENTRO de la ruta correcta
COPY . /var/www/html

# 3. Ajustamos la configuración de la imagen
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV COMPOSER_ALLOW_SUPERUSER 1

# 4. IMPORTANTE: Instalamos dependencias DURANTE la construcción (Build), no al arrancar
# Esto evita que el servidor falle al iniciarse si internet va lento
RUN composer install --no-dev --optimize-autoloader

# 5. Ajustamos permisos para que Nginx pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# 6. Variables de entorno para producción
ENV APP_ENV=production
ENV APP_DEBUG=true
ENV LOG_CHANNEL=stderr

# 7. Comando de arranque
# Quitamos el composer install de aquí. Solo migramos y arrancamos.
CMD sh -c "php artisan migrate:fresh --seed --force && /start.sh"