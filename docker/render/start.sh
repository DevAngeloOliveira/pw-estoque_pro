#!/bin/bash
set -e

echo "🚀 Iniciando EstoquePro no Render..."

# Gerar APP_KEY se não existir
if [ -z "$APP_KEY" ]; then
    echo "🔑 Gerando APP_KEY..."
    php artisan key:generate --force --no-interaction
    export APP_KEY=$(grep APP_KEY .env | cut -d '=' -f2)
fi

# Aguardar banco de dados
echo "⏳ Aguardando banco de dados..."
sleep 10

# Verificar conexão com banco
until php artisan migrate:status --no-interaction 2>/dev/null; do
    echo "⏳ Aguardando PostgreSQL ficar disponível..."
    sleep 5
done

# Executar migrations
echo "📦 Executando migrations..."
php artisan migrate --force --no-interaction

# Criar usuário admin
echo "👤 Criando usuário admin..."
php artisan db:seed --class=AdminSeeder --force --no-interaction 2>/dev/null || echo "Admin já existe"

# Otimizações Laravel
echo "⚡ Otimizando aplicação..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# Permissões finais
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Aplicação pronta!"
echo "📧 Login: admin@sistema.com"
echo "🔐 Senha: admin123"

# Iniciar Apache
exec apache2-foreground
