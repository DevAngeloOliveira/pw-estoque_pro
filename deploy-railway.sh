#!/bin/bash

# Script para facilitar o deploy no Railway
echo "🚀 Preparando deploy para Railway..."

# 1. Verificar se tem alterações não commitadas
if [[ -n $(git status -s) ]]; then
    echo "📝 Commitando alterações..."
    git add .
    git commit -m "Deploy to Railway - $(date +%Y-%m-%d_%H:%M:%S)"
fi

# 2. Push para o repositório
echo "📤 Enviando para GitHub..."
git push origin main

echo ""
echo "✅ Deploy iniciado no Railway!"
echo ""
echo "📋 Próximos passos:"
echo "1. Acesse: https://railway.app/project/f38e3746-1260-46f4-a824-a814c848ff1d"
echo "2. Verifique os logs do deploy"
echo "3. Após deploy, configure as variáveis de ambiente se ainda não fez"
echo "4. Acesse sua aplicação!"
echo ""
echo "💡 Comandos úteis:"
echo "   railway logs          - Ver logs em tempo real"
echo "   railway status        - Ver status do deploy"
echo "   railway run bash      - Acessar shell do container"
echo ""
