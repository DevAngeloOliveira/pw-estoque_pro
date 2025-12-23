# 🚂 Deploy Railway - Checklist Rápido

## ✅ Passo a Passo

### 1️⃣ No Railway Dashboard

**Adicionar MySQL:**
1. Vá em: https://railway.app/project/f38e3746-1260-46f4-a824-a814c848ff1d
2. Clique em **"+ New"** → **"Database"** → **"MySQL"**
3. Aguarde a criação (Railway gera variáveis automaticamente)

### 2️⃣ Configurar Variáveis de Ambiente

No seu serviço principal, adicione:

```
APP_NAME=EstoquePro
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.up.railway.app
```

**Gerar APP_KEY localmente:**
```bash
php artisan key:generate --show
```
Copie o resultado e adicione como variável `APP_KEY` no Railway.

### 3️⃣ Configurar Build

No Railway → **Settings** → **Build**:
- ✅ Builder: **Dockerfile**
- ✅ Dockerfile Path: **Dockerfile.railway**

### 4️⃣ Deploy

**Opção A - Via Git (automático):**
```bash
git add .
git commit -m "Configure Railway deployment"
git push origin main
```

**Opção B - Via CLI:**
```bash
npm i -g @railway/cli
railway login
railway link
railway up
```

### 5️⃣ Após Deploy

**Verificar logs:**
```bash
railway logs
```

**Criar admin (se necessário):**
```bash
railway run php artisan db:seed --class=AdminSeeder --force
```

## 🔧 Estrutura Criada

```
📁 railway/
  ├── nginx.conf        - Configuração Nginx
  ├── supervisord.conf  - Gerenciador de processos
  └── start.sh          - Script de inicialização

📄 Dockerfile.railway   - Dockerfile otimizado
📄 railway.json         - Configuração do Railway
📄 RAILWAY_DEPLOY.md    - Guia completo
```

## 🎯 O que foi otimizado?

- ✅ **Nginx + PHP-FPM** em um único container
- ✅ **Alpine Linux** - Imagem 70% menor
- ✅ **OPcache** ativado
- ✅ **Gzip** compression
- ✅ **Auto migrations** no startup
- ✅ **Supervisor** para gerenciar processos
- ✅ **FastCGI** buffers otimizados

## 🐛 Problemas Comuns

### "Connection refused"
→ MySQL ainda não está pronto. Aguarde 1-2 minutos.

### "APP_KEY not set"
→ Configure a variável `APP_KEY` no Railway.

### "Database 'forge' not found"
→ Limpe o cache: `railway run php artisan config:clear`

### Deploy falhou
→ Verifique logs: `railway logs`

## 📱 Acessar Aplicação

Após deploy bem-sucedido:
```
https://seu-projeto.up.railway.app
```

**Login padrão:**
- Email: `admin@sistema.com`
- Senha: `admin123`

---

**Documentação completa:** Veja [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)
