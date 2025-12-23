#!/bin/sh
set -e

echo "🚀 Iniciando aplicação..."

# Aguardar o banco de dados estar pronto
until php artisan migrate:status 2>/dev/null; do
  echo "⏳ Aguardando banco de dados..."
  sleep 3
done

echo "✅ Banco de dados pronto!"

# Ajustar permissões
echo "🔐 Ajustando permissões..."
chown -R www-data:www-data /var/www/html/storage || true
chown -R www-data:www-data /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage || true
chmod -R 775 /var/www/html/bootstrap/cache || true

echo "✅ Aplicação pronta!"

# Iniciar PHP-FPM
exec php-fpm
