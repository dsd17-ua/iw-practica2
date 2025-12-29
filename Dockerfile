# Usamos una imagen preparada para Laravel con Nginx y PHP
FROM richarvey/nginx-php-fpm:latest

# Copiamos todo tu código al contenedor
COPY . .

# Configuración para que Nginx sepa dónde está el "index.php"
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Configuraciones de Laravel para producción
ENV APP_ENV=production
ENV APP_DEBUG=true
ENV LOG_CHANNEL=stderr

# Comando de arranque (inicia el servidor)
CMD sh -c "composer install && php artisan migrate:fresh --seed --force && /start.sh"