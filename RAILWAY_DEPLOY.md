# Deploy no Railway - Guia Completo

## 🚀 Configuração Inicial

### 1. Variáveis de Ambiente no Railway

Configure estas variáveis no painel do Railway:

```env
# Aplicação
APP_NAME=EstoquePro
APP_ENV=production
APP_KEY=base64:SEU_APP_KEY_AQUI
APP_DEBUG=false
APP_URL=https://seu-projeto.up.railway.app

# Banco de Dados (Railway MySQL)
# O Railway preenche automaticamente DATABASE_URL
# Ou configure manualmente:
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Cache e Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Logging
LOG_CHANNEL=errorlog
LOG_LEVEL=error
```

### 2. Gerar APP_KEY

No seu terminal local:
```bash
php artisan key:generate --show
```

Copie a chave gerada e cole na variável `APP_KEY` no Railway.

### 3. Adicionar Serviço MySQL

1. No Railway, clique em **"+ New"**
2. Selecione **"Database" → "MySQL"**
3. O Railway criará automaticamente as variáveis `DATABASE_URL`, `MYSQLHOST`, etc.

### 4. Configurar Build

O Railway detectará automaticamente o `Dockerfile.railway`. Se não:

1. Vá em **Settings**
2. Em **Build Configuration**:
   - Builder: **Dockerfile**
   - Dockerfile Path: `Dockerfile.railway`

### 5. Configurar Porta

O Railway usa a variável `$PORT` automaticamente. Não precisa configurar manualmente.

## 📦 Deploy

### Opção 1: Via GitHub (Recomendado)

1. Faça commit das alterações:
```bash
git add .
git commit -m "Configure Railway deployment"
git push origin main
```

2. No Railway:
   - Conecte seu repositório GitHub
   - Selecione a branch `main`
   - O deploy iniciará automaticamente

### Opção 2: Via Railway CLI

```bash
# Instalar Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link ao projeto
railway link

# Deploy
railway up
```

## 🔧 Após o Primeiro Deploy

### 1. Rodar Migrations

Via Railway CLI:
```bash
railway run php artisan migrate --force
```

Ou via painel:
1. Vá em **Deployments**
2. Clique nos 3 pontos do deploy ativo
3. Selecione **"View Logs"**
4. As migrations rodam automaticamente no start.sh

### 2. Criar Admin

```bash
railway run php artisan db:seed --class=AdminSeeder --force
```

### 3. Verificar Logs

```bash
railway logs
```

## ⚙️ Otimizações Aplicadas

- ✅ **Alpine Linux** - Imagem 70% menor
- ✅ **Nginx + PHP-FPM** - Servidor web completo
- ✅ **Supervisor** - Gerencia processos
- ✅ **OPcache** - Cache de bytecode PHP
- ✅ **Gzip** - Compressão de assets
- ✅ **Multi-stage build** - Build otimizado

## 🐛 Troubleshooting

### Erro: "Connection refused"
- Verifique se o serviço MySQL está rodando
- Confirme as variáveis de ambiente DB_*

### Erro: "APP_KEY not set"
```bash
railway run php artisan key:generate
```

### Erro: "Storage not writable"
- O Dockerfile já configura permissões
- Se persistir, verificar logs: `railway logs`

### App carrega lento
- Primeira requisição é lenta (compila OPcache)
- Requisições seguintes serão rápidas

### Arquivos não aparecem
- Railway não persiste arquivos em `/storage`
- Use S3/Cloudinary para uploads

## 📊 Monitoramento

### Ver métricas
```bash
railway status
```

### Ver logs em tempo real
```bash
railway logs --follow
```

### Acessar shell do container
```bash
railway run bash
```

## 🔄 Redeploy

### Forçar rebuild
```bash
railway up --detach
```

### Rollback para deploy anterior
No painel Railway:
1. **Deployments**
2. Selecione o deploy anterior
3. **Redeploy**

## 💡 Dicas

1. **Variáveis de ambiente** sempre sobrescrevem `.env`
2. **Não commite** arquivo `.env` no Git
3. **Use** `railway.json` para configurações
4. **Monitore** uso de recursos no painel
5. **Configure** domínio customizado em Settings

## 🎯 Checklist de Deploy

- [ ] MySQL adicionado no Railway
- [ ] Variáveis de ambiente configuradas
- [ ] APP_KEY gerada
- [ ] Código commitado no GitHub
- [ ] Deploy bem-sucedido
- [ ] Migrations executadas
- [ ] Admin criado
- [ ] Site acessível

---

**Pronto!** Sua aplicação estará rodando em:
`https://seu-projeto.up.railway.app`

Login padrão:
- Email: `admin@sistema.com`
- Senha: `admin123`
