#!/bin/bash
set -e

echo "🚀 Iniciando EstoquePro no Render..."

# Gerar APP_KEY se não existir
if [ -z "$APP_KEY" ]; then
    echo "🔑 Gerando APP_KEY..."
    php artisan key:generate --force --no-interaction || true
fi

# Permissões
echo "📁 Configurando permissões..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Tentar rodar migrations se DATABASE_URL existir
if [ -n "$DATABASE_URL" ]; then
    echo "📦 DATABASE_URL detectada, configurando banco..."

    # Aguardar banco
    sleep 5

    # Tentar migrations (máximo 3 tentativas)
    for i in {1..3}; do
        echo "⏳ Tentativa $i de conectar ao PostgreSQL..."
        if php artisan migrate:status --no-interaction 2>/dev/null; then
            echo "✅ Banco conectado!"
            php artisan migrate --force --no-interaction
            php artisan db:seed --class=AdminSeeder --force --no-interaction 2>/dev/null || echo "⚠️ Seeder pulado"
            break
        fi
        sleep 5
    done
fi

# Otimizações Laravel
echo "⚡ Otimizando aplicação..."
php artisan config:cache --no-interaction 2>/dev/null || true
php artisan route:cache --no-interaction 2>/dev/null || true
php artisan view:cache --no-interaction 2>/dev/null || true

echo "✅ Aplicação pronta!"
echo "📧 Login: admin@sistema.com"
echo "🔐 Senha: admin123"

# Iniciar Apache
exec apache2-foreground
