#!/bin/bash
set -e

echo "🚀 Iniciando EstoquePro no Render..."

# CRÍTICO: Deletar caches compilados localmente (têm referência ao Ignition)
echo "🧹 Limpando caches compilados localmente..."
rm -f bootstrap/cache/packages.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/config.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*

# Gerar APP_KEY via PHP puro (evita carregar Laravel/Ignition)
if [ -z "$APP_KEY" ]; then
    echo "🔑 Gerando APP_KEY..."
    APP_KEY="base64:$(openssl rand -base64 32)"
    export APP_KEY
    echo "APP_KEY=${APP_KEY}" >> .env
    echo "✅ APP_KEY gerada"
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

# Limpar cache compilado (pode ter sido gerado com Ignition)
echo "🧹 Limpando cache..."
rm -rf bootstrap/cache/*.php 2>/dev/null || true
rm -rf storage/framework/cache/data/* 2>/dev/null || true
rm -rf storage/framework/views/* 2>/dev/null || true

echo "✅ Aplicação pronta!"
echo "📧 Login: admin@sistema.com"
echo "🔐 Senha: admin123"
echo "🌐 Iniciando Apache..."
exec apache2-foreground
