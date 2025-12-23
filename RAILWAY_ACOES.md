# 🎯 AÇÕES IMEDIATAS NO RAILWAY

## ⚡ Configure AGORA no Railway

### 1. Acesse seu projeto:
https://railway.app/project/f38e3746-1260-46f4-a824-a814c848ff1d?environmentId=fe828eb7-9944-4f87-b339-5c1f70d4a74b

### 2. Adicione MySQL (se ainda não tiver):
1. Clique em **"+ New"**
2. Selecione **"Database"** → **"MySQL"**
3. Aguarde criação (30-60 segundos)

### 3. Configure o Build do seu serviço principal:

**Settings** → **Build**:
```
Builder: Dockerfile
Dockerfile Path: Dockerfile.railway
```

**Settings** → **Deploy**:
```
Start Command: (deixe vazio, o Dockerfile já define)
```

### 4. Adicione estas Variáveis de Ambiente:

**Settings** → **Variables**:

```bash
# CRÍTICO - Gere a chave primeiro:
# Execute localmente: php artisan key:generate --show
APP_KEY=base64:SUA_CHAVE_AQUI_GERADA_PELO_COMANDO_ACIMA

# Outras variáveis
APP_NAME=EstoquePro
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.up.railway.app

# Logging
LOG_CHANNEL=errorlog
LOG_LEVEL=error

# Cache e Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

**⚠️ IMPORTANTE sobre o Banco de Dados:**

O Railway cria automaticamente a variável `DATABASE_URL` quando você adiciona o MySQL.

**MAS** você precisa adicionar estas variáveis manualmente também:

```bash
# Copie os valores do serviço MySQL no Railway
DB_CONNECTION=mysql
DB_HOST=containers-us-west-xxx.railway.app  # Copie do MySQL service
DB_PORT=6379                                 # Copie do MySQL service
DB_DATABASE=railway                          # Copie do MySQL service
DB_USERNAME=root                             # Copie do MySQL service
DB_PASSWORD=xxxxxxxxx                        # Copie do MySQL service
```

**Como encontrar esses valores:**
1. Clique no serviço **MySQL** no seu projeto Railway
2. Vá em **Variables**
3. Copie os valores de:
   - `MYSQLHOST` → use em `DB_HOST`
   - `MYSQLPORT` → use em `DB_PORT`
   - `MYSQLDATABASE` → use em `DB_DATABASE`
   - `MYSQLUSER` → use em `DB_USERNAME`
   - `MYSQLPASSWORD` → use em `DB_PASSWORD`

### 5. Trigger Deploy:

O push que acabamos de fazer já deve ter iniciado o deploy.

**Verifique:**
- Vá em **"Deployments"**
- O build deve estar rodando
- Aguarde 3-5 minutos

### 6. Após Deploy Bem-sucedido:

**Ver logs:**
```bash
railway logs
```

**Acessar aplicação:**
```
https://seu-dominio.up.railway.app
```

**Login:**
- Email: `admin@sistema.com`
- Senha: `admin123`

## 🔧 Se der erro:

### "APP_KEY not set"
→ Adicione a variável APP_KEY (passo 4)

### "Connection refused" ou "Database forge not found"
→ O MySQL pode não estar vinculado. Verifique:
1. Se o MySQL está rodando
2. Se está no mesmo ambiente (fe828eb7-9944-4f87-b339-5c1f70d4a74b)

### "Build failed"
→ Verifique se o Dockerfile Path está correto: `Dockerfile.railway`

### "Container crashed"
→ Veja os logs: `railway logs` ou no painel Deployments

## 📋 Checklist Final:

- [ ] MySQL adicionado no Railway
- [ ] Build configurado (Dockerfile.railway)
- [ ] APP_KEY gerada e adicionada
- [ ] Variáveis de ambiente configuradas
- [ ] Deploy executado com sucesso
- [ ] Aplicação acessível
- [ ] Login funcionando

## 🎉 Pronto!

Sua aplicação estará rodando com:
- ✅ Nginx + PHP-FPM otimizado
- ✅ OPcache ativado (3x-5x mais rápido)
- ✅ Gzip compression
- ✅ Auto-migrations no startup
- ✅ Alpine Linux (imagem pequena)

---

**Precisa de ajuda?** Consulte [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)
