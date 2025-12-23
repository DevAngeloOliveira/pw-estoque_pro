#!/bin/sh
set -e

echo "🚀 Iniciando aplicação no Railway..."

# Criar diretórios necessários
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Ajustar permissões
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Aguardar banco de dados (se DATABASE_URL estiver definida)
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "⏳ Aguardando banco de dados..."
    max_attempts=30
    attempt=0

    until php artisan migrate:status 2>/dev/null || [ $attempt -eq $max_attempts ]; do
        attempt=$((attempt + 1))
        echo "Tentativa $attempt/$max_attempts..."
        sleep 2
    done

    if [ $attempt -eq $max_attempts ]; then
        echo "⚠️  Aviso: Banco de dados não respondeu, continuando mesmo assim..."
    else
        echo "✅ Banco de dados conectado!"

        # Rodar migrations
        php artisan migrate --force --no-interaction

        # Criar admin se não existir
        php artisan db:seed --class=AdminSeeder --force 2>/dev/null || true
    fi
fi

# Otimizar Laravel
echo "⚡ Otimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Substituir PORT no nginx.conf se necessário
if [ -n "$PORT" ]; then
    sed -i "s/listen 8080/listen $PORT/g" /etc/nginx/nginx.conf
fi

echo "✅ Iniciando serviços..."

# Iniciar supervisor (que gerencia nginx e php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
