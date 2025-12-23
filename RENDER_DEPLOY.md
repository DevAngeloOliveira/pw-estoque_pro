# 🚀 Deploy no Render.com - Guia Completo

## ✅ Por que Render é melhor que Railway?

- ✅ MySQL gratuito incluído
- ✅ Detecta Laravel automaticamente
- ✅ Configuração mais simples
- ✅ Sem problemas de rede
- ✅ Deploy automático via Git

## 📋 Passo a Passo

### 1️⃣ Criar conta no Render
1. Acesse: https://render.com
2. Crie uma conta (pode usar GitHub)
3. Confirme seu email

### 2️⃣ Criar banco de dados MySQL
1. No dashboard, clique **"New +"** → **"MySQL"**
2. Configure:
   - **Name**: `estoque-pro-db`
   - **Database**: `estoque_pro`
   - **User**: `estoque_user`
   - **Region**: `Oregon (US West)` (gratuito)
   - **Plan**: **Free**
3. Clique **"Create Database"**
4. Aguarde 2-3 minutos até ficar "Available"
5. **Copie** o **Internal Database URL** (vamos usar depois)

### 3️⃣ Criar Web Service
1. No dashboard, clique **"New +"** → **"Web Service"**
2. Conecte seu repositório GitHub:
   - Selecione **"DevAngeloOliveira/pw-estoque_pro"**
3. Configure:
   - **Name**: `pw-estoque-pro`
   - **Region**: `Oregon (US West)`
   - **Branch**: `main`
   - **Runtime**: **Docker**
   - **Plan**: **Free** (ou Starter $7/mês para melhor performance)

### 4️⃣ Configurar variáveis de ambiente

Na seção **"Environment"**, adicione:

```bash
# Aplicação
APP_NAME=EstoquePro
APP_ENV=production
APP_DEBUG=false
APP_URL=https://pw-estoque-pro.onrender.com

# Banco de dados (COLE O INTERNAL DATABASE URL DO PASSO 2)
DATABASE_URL=mysql://estoque_user:SENHA@dpg-xxxxx/estoque_pro

# Cache e sessão
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Logs
LOG_CHANNEL=errorlog
LOG_LEVEL=error
```

### 5️⃣ Criar arquivo render.yaml

Crie na raiz do projeto:

```yaml
services:
  - type: web
    name: pw-estoque-pro
    env: docker
    plan: free
    healthCheckPath: /
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: DATABASE_URL
        fromDatabase:
          name: estoque-pro-db
          property: connectionString
```

### 6️⃣ Criar Dockerfile para Render

Criar arquivo `Dockerfile` (sem extensão):

```dockerfile
FROM php:8.3-fpm-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application
COPY . .

# Configure Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Run migrations and start
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
```

### 7️⃣ Criar configuração Apache

Criar `docker/apache/000-default.conf`:

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

### 8️⃣ Criar script de inicialização

Criar `docker/start.sh`:

```bash
#!/bin/bash
set -e

echo "🚀 Iniciando aplicação..."

# Gerar APP_KEY se não existir
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Aguardar banco de dados
sleep 5

# Migrations
php artisan migrate --force

# Criar admin
php artisan db:seed --class=AdminSeeder --force 2>/dev/null || true

# Otimizações
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar Apache
apache2-foreground
```

### 9️⃣ Fazer deploy

```bash
git add .
git commit -m "Configure Render deployment"
git push origin main
```

### 🔟 Aguardar deploy

1. No Render, vá em **"Events"**
2. Acompanhe o build (5-10 minutos)
3. Quando ficar verde, acesse:
   - **https://pw-estoque-pro.onrender.com**

## 🎯 Pronto!

Login padrão:
- Email: `admin@sistema.com`
- Senha: `admin123`

## 💡 Dicas

### Free tier limitations:
- ⚠️ Serviço hiberna após 15min de inatividade
- ⏱️ Primeiro acesso após hibernação demora ~30s
- 💰 Para produção, use plano Starter ($7/mês)

### Monitoramento:
```bash
# Ver logs
render logs -s pw-estoque-pro

# Status
render ps
```

### Redeploy manual:
1. No dashboard do Render
2. Clique **"Manual Deploy"** → **"Deploy latest commit"**

## 🆘 Troubleshooting

### Erro de conexão com banco:
- Verifique se DATABASE_URL está correto
- Certifique-se que o MySQL está "Available"

### App não inicia:
- Veja os logs em **"Logs"** no dashboard
- Verifique se APP_KEY foi gerado

### Migrations não rodam:
- Conecte via shell: `render shell -s pw-estoque-pro`
- Execute: `php artisan migrate --force`

---

**Muito mais simples que Railway!** 🎉
