# 📦 Estoque Pro - Sistema de Gestão Multi-Empresas

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-8.83.29-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-2.x-4E56A6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
</p>

<p align="center">
  <strong>Sistema moderno de gerenciamento de estoque multi-empresas com painel administrativo centralizado</strong>
</p>

---

## 📋 Sobre o Projeto

**Estoque Pro** é uma solução completa e profissional de gerenciamento de estoque desenvolvida com **Laravel 8** e **Livewire 2**, projetada para atender múltiplas empresas de forma simultânea e independente. O sistema oferece controle total sobre produtos, movimentações, fornecedores, categorias e relatórios, com uma interface moderna que suporta **Dark Mode** completo.

### ✨ Destaques

- 🎨 **Interface Moderna** - Design responsivo com Tailwind CSS e animações fluidas
- 🌙 **Dark Mode Completo** - Tema escuro em todas as views com transições suaves
- 📱 **Responsivo** - Funciona perfeitamente em desktops, tablets e smartphones
- ⚡ **Performance** - Carregamento rápido com Livewire e DataTables
- 🔒 **Segurança** - Autenticação multi-guard e isolamento de dados por empresa
- 🐳 **Docker Ready** - Deploy facilitado com Docker Compose

---

## 🎯 Principais Funcionalidades

### 👥 Painel da Empresa

#### Autenticação e Segurança
- ✅ **Login por CNPJ** - Autenticação segura com validação de CNPJ
- 🔐 **Multi-Guard** - Sistema de autenticação separado para empresas e admin
- 🏢 **Isolamento de Dados** - Cada empresa visualiza apenas seus próprios dados
- 🔑 **Gerenciamento de Senha** - Alteração segura de senha com criptografia

#### Dashboard Interativo
- 📊 **Cards Estatísticos** - Total de produtos, valor em estoque, alertas e lucros
- 📈 **Gráficos Dinâmicos** - Chart.js com movimentações dos últimos 7 dias
- 🔥 **Top 5 Produtos** - Produtos mais vendidos nos últimos 30 dias
- ⚠️ **Alertas de Estoque** - Notificações de produtos com estoque baixo
- 💰 **Resumo Financeiro** - Total de entradas, saídas e lucro bruto

#### Gestão de Produtos
- 📦 **CRUD Completo** - Criar, editar, visualizar e excluir produtos
- 🖼️ **Upload de Imagens** - Suporte a imagens de produtos
- 🏷️ **SKU Automático** - Geração automática de códigos únicos
- 📂 **Categorização** - Organização por categorias com cores
- 🚚 **Fornecedores** - Vinculação de produtos a fornecedores
- 🔍 **Busca Avançada** - Pesquisa por nome, SKU ou descrição
- 📋 **Exportação** - Relatórios em PDF e Excel

#### Página de Detalhes do Produto
- 📊 **Visão Completa** - Todas as informações do produto em uma tela
- 💹 **Estatísticas** - Preço, quantidade, valor total e status
- 📈 **Gráfico de Movimentações** - Histórico visual de entradas/saídas
- 📋 **Histórico Completo** - Todas as movimentações do produto
- 🏪 **Informações do Fornecedor** - Dados de contato e relacionamento

#### Movimentações de Estoque
- 🔄 **Registro de Entradas** - Controle de compras e recebimentos
- 📤 **Registro de Saídas** - Controle de vendas e baixas
- 🔢 **Atualização Automática** - Estoque atualizado em tempo real
- 📝 **Observações** - Campo para anotações em cada movimentação
- 💵 **Valores Unitários** - Registro de preço por unidade
- 📊 **Filtros Avançados** - Por tipo, período e produto
- 📄 **Relatórios** - Exportação detalhada em PDF e Excel

#### Fornecedores
- 🏪 **Modo Duplo** - Usar fornecedores próprios ou globais do sistema
- ➕ **CRUD Completo** - Gerenciamento total de fornecedores próprios
- 📇 **Dados Completos** - CNPJ, contatos, endereço e observações
- 🔄 **Alternância Simples** - Trocar entre próprios e globais facilmente
- 🌐 **Fornecedores Globais** - Acesso a base compartilhada do sistema

#### Categorias
- 📂 **Organização Visual** - Categorias com cores personalizadas
- ✏️ **Gestão Fácil** - Modal para criar/editar rapidamente
- 📊 **Contagem de Produtos** - Quantidade de produtos por categoria
- ✅ **Status Ativo/Inativo** - Controle de visibilidade
- 🎨 **Seletor de Cores** - Escolha de cores com color picker

#### Auditoria
- 📜 **Log de Atividades** - Registro de todas as ações no sistema
- 👤 **Rastreamento** - Identifica usuário, data e hora de cada ação
- 🔍 **Filtros** - Por ação (criação, edição, exclusão), módulo e período
- 📊 **Estatísticas** - Total de logs hoje, na semana e geral

#### Perfil
- 👤 **Edição de Dados** - Atualização de informações da empresa
- 📞 **Contatos** - Email, telefone e endereço
- 🔑 **Alteração de Senha** - Troca segura com confirmação
- ℹ️ **Informações Visuais** - Avatar com inicial e status da conta

### 🔐 Painel Administrativo

#### Dashboard Admin
- 📊 **Visão Consolidada** - Estatísticas de todas as empresas
- 🏢 **Total de Empresas** - Ativas e cadastradas
- 📦 **Produtos Totais** - Somatório de todos os produtos
- 💰 **Valor Total** - Valor consolidado em estoque
- 📈 **Gráficos** - Visualização de dados agregados

#### Gerenciamento de Empresas
- ➕ **Cadastro de Empresas** - Criar novas empresas no sistema
- ✏️ **Edição** - Atualizar dados de empresas existentes
- 🗑️ **Exclusão** - Remover empresas (com confirmação)
- ✅ **Ativar/Desativar** - Controle de acesso das empresas
- 🔍 **Busca** - Pesquisa por CNPJ, razão social ou nome fantasia

#### Fornecedores Globais
- 🌐 **Base Compartilhada** - Fornecedores disponíveis para todas as empresas
- ➕ **CRUD Completo** - Gestão total dos fornecedores globais
- 📊 **Uso por Empresas** - Visualizar quais empresas usam cada fornecedor

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **Laravel 8.83.29** - Framework PHP robusto e moderno
- **Livewire 2.12.8** - Framework full-stack reativo
- **PHP 8.3** - Linguagem de programação de alto desempenho
- **MySQL 8.0** - Banco de dados relacional confiável

### Frontend
- **Tailwind CSS 3.x** - Framework CSS utility-first
- **Alpine.js** - Framework JavaScript leve (via Livewire)
- **Font Awesome 6** - Biblioteca de ícones
- **Chart.js 4.4.0** - Gráficos interativos
- **DataTables 2.1.8** - Tabelas avançadas com ordenação e filtros
- **Dark Mode** - Tema escuro completo com localStorage

### Bibliotecas PHP
- **Maatwebsite Excel 3.1** - Exportação para Excel
- **DomPDF 2.0** - Geração de PDF
- **Laravel Sanctum** - Autenticação de API

### Infraestrutura
- **Docker** - Containerização da aplicação
- **Docker Compose** - Orquestração de serviços
- **Nginx** - Servidor web de alto desempenho
- **Redis** - Cache e filas (opcional)
---

## 📦 Estrutura do Projeto

```
pw-estoque_pro/
├── app/
│   ├── Exports/
│   │   ├── MovementsExport.php          # Exportação movimentações Excel
│   │   └── ProductsExport.php           # Exportação produtos Excel
│   ├── Helpers/
│   │   └── TenantHelper.php             # Helper multi-tenant
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminAuthController.php
│   │   │   │   ├── AdminDashboardController.php
│   │   │   │   └── CompanyController.php
│   │   │   ├── Auth/
│   │   │   │   └── CompanyAuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── MovementController.php
│   │   │   ├── ProductController.php
│   │   │   └── ReportController.php     # Geração de PDF
│   │   ├── Livewire/
│   │   │   ├── AuditLogList.php
│   │   │   ├── CategoryList.php
│   │   │   ├── CompanyForm.php
│   │   │   ├── CompanyList.php
│   │   │   ├── CompanySelector.php
│   │   │   ├── Dashboard.php
│   │   │   ├── MovementForm.php
│   │   │   ├── MovementList.php
│   │   │   ├── Notifications.php
│   │   │   ├── ProductDetails.php
│   │   │   ├── ProductForm.php
│   │   │   ├── ProductList.php
│   │   │   ├── Profile.php
│   │   │   └── SupplierList.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── CompanySelectedMiddleware.php
│   ├── Models/
│   │   ├── Admin.php
│   │   ├── AuditLog.php
│   │   ├── Category.php
│   │   ├── Company.php
│   │   ├── Product.php
│   │   ├── ProductMovement.php
│   │   └── Supplier.php
│   └── Traits/
│       └── Auditable.php                # Trait para auditoria
│
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2024_*_create_companies_table.php
│   │   ├── 2024_*_create_categories_table.php
│   │   ├── 2024_*_create_suppliers_table.php
│   │   ├── 2024_*_create_products_table.php
│   │   ├── 2024_*_create_product_movements_table.php
│   │   ├── 2024_*_create_admins_table.php
│   │   └── 2024_*_create_audit_logs_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       ├── CompanySeeder.php
│       ├── CategorySeeder.php
│       ├── SupplierSeeder.php
│       ├── ProductSeeder.php
│       └── ProductMovementSeeder.php
│
├── public/
│   ├── css/
│   │   └── modern-theme.css             # CSS customizado + Dark Mode
│   └── storage/                         # Symlink para storage/app/public
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── layout.blade.php
│       │   ├── login.blade.php
│       │   ├── dashboard.blade.php
│       │   └── companies.blade.php
│       ├── auth/
│       │   └── login.blade.php
│       ├── components/
│       │   ├── app-layout.blade.php     # Layout com sidebar e dark mode
│       │   └── guest-layout.blade.php
│       ├── livewire/                    # Views dos componentes Livewire
│       │   ├── audit-log-list.blade.php
│       │   ├── category-list.blade.php
│       │   ├── company-*.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── movement-*.blade.php
│       │   ├── product-*.blade.php
│       │   ├── profile.blade.php
│       │   └── supplier-list.blade.php
│       └── welcome.blade.php
│
├── routes/
│   └── web.php                          # Rotas da aplicação
│
├── docker-compose.yml                   # Orquestração Docker
├── Dockerfile                           # Imagem da aplicação
└── README.md                            # Este arquivo
```

---

## 🚀 Instalação e Configuração

### Pré-requisitos

- Docker Desktop
- Docker Compose
- Git

### 🐳 Instalação com Docker (Recomendado)

1. **Clone o repositório**
```bash
git clone https://github.com/DevAngeloOliveira/pw-estoque_pro.git
cd pw-estoque_pro
```

2. **Configure o ambiente**
```bash
# No Windows (PowerShell)
Copy-Item -Path ".env.example" -Destination ".env"

# No Linux/Mac
cp .env.example .env
```

3. **Inicie os containers Docker**
```bash
docker compose up -d --build
```

4. **Execute as migrations e seeders**
```bash
docker compose exec app php artisan migrate:fresh --seed
```

5. **Acesse o sistema**
- 🌐 **Aplicação**: http://localhost:8080
- 🔐 **Login Admin**: http://localhost:8080/admin/login
- 🏢 **Login Empresa**: http://localhost:8080/login

### 📦 Serviços Docker

O projeto utiliza os seguintes containers:

- **app**: Aplicação Laravel (PHP 8.3-fpm)
- **nginx**: Servidor web (porta 8080)
- **db**: MySQL 8.0 (porta 3306)
- **redis**: Cache Redis (porta 6379)

### 🛠️ Comandos Úteis Docker

```bash
# Verificar status dos containers
docker compose ps

# Ver logs da aplicação
docker compose logs app

# Parar os containers
docker compose down

# Reiniciar os containers
docker compose restart

# Executar comandos artisan
docker compose exec app php artisan <comando>

# Acessar o container da aplicação
docker compose exec app bash

# Limpar cache
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
```

---

## 💾 Configuração do Banco de Dados

### Credenciais Docker (padrão)

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=estoque_pro
DB_USERNAME=estoque_user
DB_PASSWORD=secret
```

### 📊 Acesso ao MySQL

Para conectar ao banco de dados MySQL externamente:

```bash
Host: localhost
Port: 3306
Database: estoque_pro
Username: estoque_user
Password: secret
```

Ou use root:

```bash
Username: root
Password: root
```

---

## 🔧 Instalação Local (Sem Docker)

Se preferir rodar sem Docker:

### Pré-requisitos
- PHP 8.3 ou superior
- Composer
- MySQL 8.0 ou superior
- Node.js e NPM

### Passos

1. **Clone e configure**
```bash
git clone https://github.com/DevAngeloOliveira/pw-estoque_pro.git
cd pw-estoque_pro
composer install
npm install
cp .env.example .env
php artisan key:generate
```

2. **Configure o banco no `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estoque_pro
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

3. **Execute migrations**
```bash
php artisan migrate:fresh --seed
```

4. **Compile assets**
```bash
npm run production
```

5. **Inicie o servidor**
```bash
php artisan serve
```

6. **Acesse**: http://127.0.0.1:8000

---

## 🔐 Credenciais de Acesso

### 👨‍💼 Administrador do Sistema

O administrador possui acesso completo ao painel de gerenciamento de empresas:

| Campo | Valor |
|-------|-------|
| **URL de Acesso** | http://localhost:8080/admin/login |
| **Email** | admin@admin.com |
| **Senha** | admin123 |

**Funcionalidades do Admin:**
- ✅ Criar, editar e excluir empresas
- ✅ Gerenciar fornecedores globais (compartilhados entre todas as empresas)
- ✅ Visualizar estatísticas gerais do sistema
- ✅ Acesso a logs de auditoria de todas as empresas

---

### 🏢 Empresas de Teste

O sistema vem com **3 empresas** pré-cadastradas com dados completos:

#### Empresa 1: **TechSol Tecnologia Ltda**
| Campo | Valor |
|-------|-------|
| **URL de Acesso** | http://localhost:8080/login |
| **CNPJ** | 12.345.678/0001-95 |
| **Senha** | senha123 |
| **Razão Social** | TechSol Tecnologia Ltda |
| **Email** | contato@techsol.com.br |
| **Telefone** | (11) 98765-4321 |

#### Empresa 2: **ABC Store Comércio**
| Campo | Valor |
|-------|-------|
| **URL de Acesso** | http://localhost:8080/login |
| **CNPJ** | 98.765.432/0001-10 |
| **Senha** | senha123 |
| **Razão Social** | ABC Store Comércio Ltda |
| **Email** | contato@abcstore.com.br |
| **Telefone** | (21) 91234-5678 |

#### Empresa 3: **XYZ Distribuidora**
| Campo | Valor |
|-------|-------|
| **URL de Acesso** | http://localhost:8080/login |
| **CNPJ** | 11.222.333/0001-44 |
| **Senha** | senha123 |
| **Razão Social** | XYZ Distribuidora S.A. |
| **Email** | contato@xyzdistribuidora.com.br |
| **Telefone** | (11) 95555-1234 |

> **⚠️ Importante**: No login de empresas, use apenas o **CNPJ** (sem formatação ou com pontos/barras) e a **senha**.

---

### 📊 Dados de Exemplo no Sistema

Após executar `php artisan migrate:fresh --seed`, o banco será populado com:

| Tipo de Dado | Quantidade | Descrição |
|--------------|------------|-----------|
| **Administradores** | 1 | Acesso total ao sistema |
| **Empresas** | 3 | Empresas ativas com dados completos |
| **Categorias** | 12+ | Eletrônicos, Alimentos, Roupas, etc. |
| **Fornecedores Globais** | 5 | Disponíveis para todas as empresas |
| **Fornecedores por Empresa** | 3-5 | Específicos de cada empresa |
| **Produtos** | 30+ | Distribuídos entre as 3 empresas |
| **Movimentações** | 150+ | Entradas e saídas de estoque |
| **Logs de Auditoria** | 200+ | Rastreamento de todas as ações |

---

### 🎯 Fluxo de Teste Recomendado

1. **Faça login como Admin** → Explore o painel de empresas e fornecedores globais
2. **Faça login como Empresa** (ex: TechSol) → Navegue pelo dashboard e veja os produtos
3. **Teste o Dark Mode** → Clique no ícone 🌙/☀️ no topo direito
4. **Crie um Produto** → Produtos → Novo Produto
5. **Registre uma Movimentação** → Movimentações → Nova Movimentação
6. **Exporte Relatórios** → Teste Excel/PDF nas telas de produtos e movimentações
7. **Verifique Auditoria** → Veja os logs de todas as ações realizadas

---

## 💻 Exemplos de Código

### 1. Autenticação com Guard Customizado

```php
// config/auth.php
'guards' => [
    'company' => [
        'driver' => 'session',
        'provider' => 'companies',
    ],
],

'providers' => [
    'companies' => [
        'driver' => 'eloquent',
        'model' => App\Models\Company::class,
    ],
],
```

**Explicação**: Configuração de guard personalizado para autenticação de empresas ao invés de usuários, permitindo login via CNPJ.

### 2. Model Company com Authenticatable

```php
// app/Models/Company.php
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    protected $fillable = [
        'cnpj', 'razao_social', 'nome_fantasia', 
        'email', 'telefone', 'endereco', 
        'password', 'active'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Auto-hash de senha
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
```

**Explicação**: Estende `Authenticatable` para suporte a autenticação, com mutator automático para criptografar senhas usando bcrypt.

### 3. Componente Livewire de Login

```php
// app/Http/Livewire/Auth/Login.php
public function login()
{
    $this->validate();
    $cnpjClean = preg_replace('/\D/', '', $this->cnpj);
    
    $company = Company::where('cnpj', $cnpjClean)
        ->where('active', true)
        ->first();

    if (!$company || !Hash::check($this->password, $company->password)) {
        $this->addError('password', 'Credenciais inválidas');
        return;
    }

    Auth::guard('company')->login($company, $this->remember);
    return redirect()->route('dashboard');
}
```

**Explicação**: Valida CNPJ limpo (apenas números), verifica empresa ativa, compara senha com hash e autentica usando guard customizado.

### 4. Dashboard com Dados Dinâmicos

```php
// app/Http/Livewire/Dashboard.php
public function render()
{
    $companyId = auth()->guard('company')->user()->id;

    // Estatísticas
    $totalProducts = Product::where('company_id', $companyId)->count();
    $totalValue = Product::where('company_id', $companyId)
        ->sum(DB::raw('price * quantity'));

    // Dados para gráfico (últimos 7 dias)
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $entradas = ProductMovement::where('company_id', $companyId)
            ->where('type', 'entrada')
            ->whereDate('movement_date', $date)
            ->sum('total_price');
        // ... saídas
        $chartData[] = [
            'date' => now()->subDays($i)->format('d/m'),
            'entradas' => round($entradas, 2),
            'saidas' => round($saidas, 2)
        ];
    }

    return view('livewire.dashboard', compact('chartData', ...));
}
```

**Explicação**: Busca dados isolados por empresa, calcula estatísticas em tempo real e prepara dados dos últimos 7 dias para gráficos.

### 5. Gráfico Interativo com Chart.js

```javascript
// resources/views/livewire/dashboard.blade.php
const chartData = @json($chartData);
const labels = chartData.map(item => item.date);
const entradasData = chartData.map(item => item.entradas);

new Chart(movCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Entradas (R$)',
            data: entradasData,
            borderColor: 'rgb(59, 130, 246)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => 'R$ ' + value.toFixed(2)
                }
            }
        }
    }
});
```

**Explicação**: Blade injeta dados PHP como JSON, JavaScript mapeia arrays e Chart.js renderiza gráfico responsivo com formatação de moeda.

### 6. Observer para Atualização Automática de Estoque

```php
// app/Models/ProductMovement.php
protected static function boot()
{
    parent::boot();

    static::created(function ($movement) {
        $product = Product::find($movement->product_id);
        if ($movement->type === 'entrada') {
            $product->increment('quantity', $movement->quantity);
        } else {
            $product->decrement('quantity', $movement->quantity);
        }
    });
}
```

**Explicação**: Observer no model atualiza automaticamente o estoque do produto quando uma movimentação é criada, usando `increment`/`decrement`.

### 7. Máscaras de Input com jQuery Mask

```javascript
// Máscara de CNPJ
$('#cnpj').mask('00.000.000/0000-00', {
    onKeyPress: function(val, e, field, options) {
        @this.set('cnpj', val); // Atualiza Livewire
    }
});

// Máscara de telefone dinâmica
var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 
        ? '(00) 00000-0000' 
        : '(00) 0000-00009';
};
$('#telefone').mask(SPMaskBehavior, spOptions);

// Máscara de moeda
$('#price').mask('#.##0,00', { reverse: true });
```

**Explicação**: jQuery Mask aplica formatação visual mantendo sincronização com Livewire via `@this.set()`, com máscaras dinâmicas e reversas.

### 8. Middleware de Autenticação

```php
// routes/web.php
Route::middleware(['auth:company'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // ... outras rotas protegidas
});
```

**Explicação**: Middleware `auth:company` protege rotas usando guard customizado, redirecionando para login se não autenticado.

---

## 🎨 Features Implementadas

### 🏠 Landing Page
- Design moderno com animações CSS
- Seções: Hero, Estatísticas, Recursos, CTA, Footer
- Navegação suave entre seções
- Totalmente responsiva

### 🔐 Sistema de Autenticação Dupla
#### Empresas
- Login via CNPJ com máscara automática
- Registro de novas empresas com validação completa
- Validação de CNPJ (algoritmo oficial)
- Guard customizado `company`

#### Administradores
- Login via email
- Sistema separado com guard `admin`
- Controle total do sistema

### 🛡️ Painel Administrativo
- **Dashboard Admin**: Visão consolidada de todas as empresas
- **Estatísticas Gerais**: Total de empresas, produtos, fornecedores, valor em estoque
- **Top 5 Empresas**: Mais ativas nos últimos 30 dias
- **Movimentações por Tipo**: Análise de entradas e saídas
- **Produtos com Estoque Baixo**: Alert cross-company
- **Gerenciamento de Empresas**:
  - Criar, editar e visualizar empresas
  - Ativar/desativar empresas
  - Configurar uso de fornecedores globais
  - Validação de CNPJ e email únicos
- **Fornecedores Globais**:
  - CRUD completo com modal
  - Disponíveis para todas as empresas
  - Informações completas (endereço, contatos, website)
  - Busca em tempo real
  - Estatísticas (total, ativos, em uso)

### 📊 Dashboard Empresarial
- **Cards de estatísticas**: Produtos, valor, alertas, movimentações
- **Gráfico de linha**: Movimentações dos últimos 7 dias
- **Gráfico de pizza**: Entradas vs Saídas
- **Top 5 produtos**: Mais movimentados
- **Alertas de estoque baixo**: Lista de produtos críticos
- **Últimas movimentações**: Histórico recente

### 📦 Gestão de Produtos
- **CRUD Completo**: Create, Read, Update, Delete
- **Página de Detalhes**:
  - Header com gradiente e imagem
  - Cards com preço, quantidade, valor total e status
  - Estatísticas dos últimos 30 dias
  - Gráfico de movimentações (Chart.js)
  - Histórico de movimentações recentes
  - Botões para editar e nova movimentação
- **Categorização**: Organização por categorias
- **Fornecedores**: Vinculação a fornecedores
- **SKU único** por empresa
- **Controle de estoque** em tempo real
- **Máscaras de preço**: R$ formatado

### 📂 Categorias
- CRUD completo via Livewire
- Modal para criação/edição rápida
- Vinculação automática a produtos
- Isolamento por empresa

### 🚚 Fornecedores
- **Fornecedores Próprios**: Cada empresa cria seus fornecedores
- **Fornecedores Globais**: Sistema compartilhado gerenciado pelo admin
- **Configuração Flexível**: Empresa escolhe usar globais ou não
- **Informações Completas**: Nome, razão social, CNPJ, contatos, endereço completo
- CRUD completo via modal
- Busca e filtros

### 🔄 Movimentações
- Registro de entradas e saídas
- Atualização automática de estoque via Observer
- Histórico completo com filtros
- Cálculo automático de valores totais
- Data, tipo, quantidade, preço unitário e total
- Observações opcionais

### 👤 Perfil de Usuário
- Edição de informações da empresa
- Troca de senha com validação
- Máscaras de telefone dinâmicas
- Feedback visual de sucesso/erro
- Validações em tempo real

### 📋 Relatórios e Exportação
- Exportação para PDF
- Exportação para Excel
- Relatórios personalizados
- Dados filtrados por período

### 🎨 Interface e UX
- **Tailwind CSS 3.x**: Design utility-first moderno
- **Livewire 2.x**: Reatividade sem JavaScript complexo
- **Chart.js 4.x**: Gráficos interativos e responsivos
- **Font Awesome 6.x**: Ícones vetoriais
- **Animações CSS**: fadeIn, hover-lift, pulse, gradientes
- **Scrollbar customizada**: Visual moderno
- **Loading states**: Feedback visual em todas as ações
- **Modals**: Interface limpa com overlay
- **Tooltips**: Ajuda contextual
- **Badges**: Status visual colorido
- **Responsividade**: Mobile-first design
- **Máscaras de Input**: CNPJ, telefone, CEP, moeda

---

## 📁 Banco de Dados

### Tabelas Principais

#### `admins`
```sql
- id (PK)
- name
- email (UNIQUE)
- password
- super_admin (boolean)
- active (boolean)
- remember_token
- timestamps
```

#### `companies`
```sql
- id (PK)
- cnpj (UNIQUE)
- razao_social
- nome_fantasia
- email (UNIQUE)
- telefone
- endereco
- password
- active (boolean)
- use_global_suppliers (boolean)
- remember_token
- timestamps
```

#### `suppliers`
```sql
- id (PK)
- company_id (FK, nullable)
- is_global (boolean)
- name
- legal_name
- cnpj
- email
- phone
- whatsapp
- website
- address
- address_number
- complement
- neighborhood
- city
- state
- zip_code
- notes
- active (boolean)
- timestamps

Índices:
- (company_id, active)
- (is_global, active)
- cnpj
```

#### `categories`
```sql
- id (PK)
- company_id (FK)
- name
- description
- active (boolean)
- timestamps

Índices:
- (company_id, active)
```

#### `products`
```sql
- id (PK)
- company_id (FK)
- category_id (FK, nullable)
- supplier_id (FK, nullable)
- name
- description
- sku (UNIQUE per company)
- price
- quantity
- image
- timestamps

Índices:
- (company_id, active)
- category_id
- supplier_id
- sku
```

#### `product_movements`
```sql
- id (PK)
- company_id (FK)
- product_id (FK)
- type (entrada/saida)
- quantity
- unit_price
- total_price
- movement_date
- observation
- timestamps

Índices:
- (company_id, movement_date)
- (product_id, type)
- movement_date
```

#### `audit_logs` (opcional)
```sql
- id (PK)
- company_id (FK, nullable)
- user_type (admin/company)
- user_id
- action
- model
- model_id
- old_values (JSON)
- new_values (JSON)
- ip_address
- user_agent
- timestamps
```

---

## 🔒 Segurança

- ✅ **Autenticação Multi-Guard**: Guards separados para admin e empresas
- ✅ **Senhas Criptografadas**: Hash bcrypt em todos os níveis
- ✅ **Proteção SQL Injection**: Eloquent ORM + Prepared Statements
- ✅ **Validação de CNPJ**: Algoritmo oficial no backend
- ✅ **Isolamento Multi-Tenant**: Middleware `TenantMiddleware` para dados por empresa
- ✅ **CSRF Protection**: Token Laravel em todos os formulários
- ✅ **Middleware de Autenticação**: Rotas protegidas por tipo de usuário
- ✅ **Validação de Email**: Verificação de unicidade
- ✅ **XSS Protection**: Blade escaping automático
- ✅ **Session Security**: Regeneração após login
- ✅ **Rate Limiting**: Proteção contra força bruta
- ✅ **Input Sanitization**: Validação Laravel em todas as entradas

---

## 🎯 Roadmap de Melhorias

### ✅ Concluído
- [x] Sistema multi-tenant com isolamento de dados
- [x] Painel administrativo completo
- [x] Gestão de fornecedores globais
- [x] Categorias de produtos
- [x] Página de detalhes de produtos
- [x] Gráficos interativos com Chart.js
- [x] Exportação de relatórios (PDF/Excel)
- [x] Upload de imagens de produtos
- [x] Sistema de autenticação dupla (Admin/Empresas)

### 🚀 Próximas Implementações
- [ ] **Dashboard Avançado**
  - [ ] Mais gráficos e métricas comparativas
  - [ ] Análise de tendências e previsão de estoque
  - [ ] Comparativos entre períodos customizados
  
- [ ] **Notificações em Tempo Real**
  - [ ] Sistema de notificações push no navegador
  - [ ] Alertas de estoque baixo via email automático
  - [ ] Webhooks para integrações externas
  
- [ ] **Relatórios Avançados**
  - [ ] Relatórios personalizados com filtros customizados
  - [ ] Agendamento automático de relatórios
  - [ ] Análise de lucratividade e ROI
  - [ ] Dashboards personalizáveis por usuário
  
- [ ] **API REST Completa**
  - [ ] Endpoints RESTful para integrações
  - [ ] Documentação Swagger/OpenAPI
  - [ ] OAuth2 authentication
  - [ ] Rate limiting por API key
  
- [ ] **Auditoria Completa**
  - [x] Sistema de logs básico implementado
  - [ ] Rastreamento detalhado de mudanças com diff
  - [ ] Histórico de acessos e sessões
  - [ ] Relatório de auditoria exportável
  
- [ ] **Melhorias de UX/UI**
  - [x] DataTables implementado em todas as listagens
  - [x] Dark Mode completo com persistência
  - [ ] PWA (Progressive Web App) com offline support
  - [ ] Atalhos de teclado para navegação rápida
  - [ ] Tour guiado para novos usuários
  
- [ ] **Funcionalidades Extras**
  - [ ] Importação em massa (CSV/Excel)
  - [ ] Backup automático agendado
  - [ ] Múltiplos idiomas (i18n - PT-BR, EN, ES)
  - [ ] Geração e leitura de códigos de barras
  - [ ] Integração com e-commerce (WooCommerce, Shopify)
  - [ ] Sistema de pedidos de compra
  - [ ] Integração com NFe
  
- [ ] **Performance e Escalabilidade**
  - [ ] Cache Redis para queries frequentes
  - [ ] Queue system para tarefas pesadas
  - [ ] Otimização de imagens com lazy loading
  - [ ] CDN para assets estáticos

---

## 🏗️ Arquitetura do Sistema

### Multi-Tenant Architecture
```
┌─────────────────────────────────────────────────────────┐
│                    Landing Page (/)                     │
└─────────────────────────────────────────────────────────┘
                            │
        ┌───────────────────┴───────────────────┐
        │                                       │
┌───────▼────────┐                    ┌────────▼────────┐
│  Admin Login   │                    │ Company Login   │
│ (/admin/login) │                    │    (/login)     │
└───────┬────────┘                    └────────┬────────┘
        │                                      │
        │ Guard: admin                         │ Guard: company
        │                                      │
┌───────▼────────────────┐          ┌─────────▼─────────────────┐
│   Admin Dashboard      │          │   Company Dashboard       │
│                        │          │   (Tenant Isolated)       │
│ ├─ Manage Companies    │          │                           │
│ ├─ Global Suppliers    │          │ ├─ Products (CRUD)        │
│ ├─ System Stats        │          │ ├─ Product Details        │
│ ├─ Company Details     │          │ ├─ Categories             │
│ └─ Activity Logs       │          │ ├─ Suppliers              │
│                        │          │ ├─ Movements              │
└────────────────────────┘          │ ├─ Reports (PDF/Excel)    │
                                    │ └─ Profile                │
                                    └───────────────────────────┘
```

### Data Flow
```
┌──────────────┐
│   Browser    │
└──────┬───────┘
       │ HTTP Request
       ▼
┌──────────────┐
│   Nginx      │ ← Docker container (porta 8080)
└──────┬───────┘
       │
       ▼
┌──────────────┐
│   Routes     │ ← web.php (routing)
└──────┬───────┘
       │
       ├─→ Middleware ─→ [auth:admin] ─→ Admin Routes
       │
       └─→ Middleware ─→ [auth:company, tenant] ─→ Company Routes
                              │
                              ▼
                    ┌──────────────────┐
                    │ TenantMiddleware │
                    │ (Isolate Data)   │
                    └─────────┬────────┘
                              │
                              ▼
                    ┌──────────────────┐
                    │ Livewire Component│
                    └─────────┬────────┘
                              │
                              ▼
                    ┌──────────────────┐
                    │  Eloquent ORM    │
                    └─────────┬────────┘
                              │
                              ▼
                    ┌──────────────────┐
                    │  MySQL Database  │
                    │ (Docker container)│
                    └──────────────────┘
```

### Isolamento Multi-Tenant
```
┌─────────────────────────────────────────────────────┐
│              Request com Guard: company              │
└────────────────────┬────────────────────────────────┘
                     │
                     ▼
        ┌────────────────────────────┐
        │    TenantMiddleware        │
        │  $companyId = auth()->id() │
        └────────────┬───────────────┘
                     │
                     ▼
        ┌────────────────────────────┐
        │    Global Scope Aplicado   │
        │ WHERE company_id = ?       │
        └────────────┬───────────────┘
                     │
         ┌───────────┴───────────┐
         │                       │
         ▼                       ▼
┌─────────────────┐   ┌──────────────────┐
│   Products      │   │  Movements       │
│ (filtered)      │   │  (filtered)      │
└─────────────────┘   └──────────────────┘

❌ Company A não vê dados de Company B
✅ Admin vê todos os dados (sem scope)
```

## 📊 Tecnologias e Padrões

### Design Patterns Utilizados
- **Repository Pattern**: Separação de lógica de negócio
- **Observer Pattern**: Atualização automática de estoque
- **Middleware Pattern**: Autenticação e isolamento de dados
- **Factory Pattern**: Seeders para dados de teste
- **MVC Pattern**: Estrutura Laravel padrão

### Boas Práticas Implementadas
- ✅ **SOLID Principles**: Código limpo e manutenível
- ✅ **DRY (Don't Repeat Yourself)**: Reuso de componentes
- ✅ **PSR Standards**: Código seguindo padrões PHP
- ✅ **RESTful Routes**: Rotas semânticas e organizadas
- ✅ **Eager Loading**: Otimização de queries N+1
- ✅ **Form Requests**: Validação centralizada
- ✅ **Database Transactions**: Integridade de dados
- ✅ **Soft Deletes**: Recuperação de dados
- ✅ **Seeders**: Dados de exemplo para desenvolvimento

---

## ❓ Troubleshooting (Solução de Problemas)

### 🐳 Problemas com Docker

**Containers não iniciam:**
```bash
# Parar e remover containers existentes
docker compose down -v

# Limpar cache do Docker
docker system prune -a

# Rebuild completo
docker compose build --no-cache
docker compose up -d
```

**Erro "port 8080 already in use":**
```bash
# Descobrir processo usando a porta
netstat -ano | findstr :8080

# Matar o processo (Windows)
taskkill /PID <process_id> /F

# Ou alterar a porta no docker-compose.yml
# nginx -> ports: "8081:80"
```

**Permissões de arquivo no Linux/Mac:**
```bash
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

### 🔧 Problemas com Laravel

**Erro 500 após instalação:**
```bash
# Limpar todos os caches
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan route:clear

# Regenerar autoload
docker compose exec app composer dump-autoload

# Verificar permissões
docker compose exec app chmod -R 777 storage bootstrap/cache
```

**Migrations não funcionam:**
```bash
# Verificar conexão com banco
docker compose exec app php artisan tinker
# Dentro do tinker: DB::connection()->getPdo();

# Reset completo do banco
docker compose exec app php artisan migrate:fresh --seed
```

**Livewire não atualiza:**
```bash
# Limpar cache de views
docker compose exec app php artisan view:clear
docker compose exec app php artisan livewire:discover

# No navegador: Ctrl + F5 (hard refresh)
```

### 🎨 Problemas com Frontend

**CSS/JS não carrega:**
```bash
# Limpar cache do navegador (Ctrl + Shift + Delete)
# Ou acessar com aba anônima

# Rebuild dos assets
npm run production

# Verificar se storage link existe
docker compose exec app php artisan storage:link
```

**Dark Mode não persiste:**
```bash
# Verificar localStorage no console do navegador
localStorage.getItem('theme')

# Limpar localStorage
localStorage.clear()
```

### 🔐 Problemas de Login

**"Credenciais inválidas" mesmo com senha correta:**
```bash
# Verificar se seeders rodaram
docker compose exec app php artisan db:seed --class=AdminSeeder
docker compose exec app php artisan db:seed --class=CompanySeeder

# Resetar senha do admin no tinker
docker compose exec app php artisan tinker
# Admin::first()->update(['password' => bcrypt('admin123')])
```

**Guard incorreto:**
- Login de empresa: usar `/login` (guard: company)
- Login de admin: usar `/admin/login` (guard: admin)

### 📊 Problemas com Banco de Dados

**Dados não aparecem:**
```bash
# Verificar se está logado na empresa correta
# Verificar middleware TenantMiddleware

# Ver queries executadas (no tinker)
DB::enableQueryLog();
Product::all();
DB::getQueryLog();
```

---

## 📚 Recursos Adicionais

### Documentação das Tecnologias
- [Laravel 8 Documentation](https://laravel.com/docs/8.x)
- [Livewire 2 Documentation](https://laravel-livewire.com/docs/2.x/quickstart)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Chart.js Documentation](https://www.chartjs.org/docs/latest/)
- [Docker Documentation](https://docs.docker.com/)

### Tutoriais Recomendados
- [Laravel Multi-Tenancy Guide](https://tenancyforlaravel.com/)
- [Livewire CRUD Tutorial](https://laravel-livewire.com/screencasts/)
- [Docker para Laravel](https://laravel.com/docs/8.x/sail)

---

## 🔄 Changelog

### Versão 2.0 (Atual)
- ✅ Sistema multi-tenant completo
- ✅ Painel administrativo
- ✅ Dark Mode com persistência
- ✅ DataTables em todas as listagens
- ✅ Exportação PDF/Excel
- ✅ Gráficos interativos Chart.js
- ✅ Sistema de auditoria básico
- ✅ Fornecedores globais
- ✅ Docker Compose configurado

### Versão 1.0 (Base)
- ✅ CRUD de produtos
- ✅ Gestão de estoque
- ✅ Movimentações
- ✅ Categorias e fornecedores
- ✅ Autenticação básica

---

## 📝 Licença e Direitos Autorais

**© 2025 Gabriel Ângelo Oliveira Silva. Todos os direitos reservados.**

Este é um **software proprietário** desenvolvido para fins comerciais. O uso, cópia, modificação, distribuição ou comercialização deste software sem autorização prévia e expressa do autor é **estritamente proibido**.

### ⚖️ Termos de Uso

- ❌ **Uso não autorizado** é proibido
- ❌ **Redistribuição** não permitida sem licença
- ❌ **Modificação do código-fonte** requer autorização
- ❌ **Uso comercial por terceiros** não permitido
- ✅ **Uso para demonstração/portfólio** apenas com créditos ao autor

Para informações sobre **licenciamento comercial**, entre em contato com o autor.

---

## 👨‍💻 Autor

**Gabriel Ângelo Oliveira Silva**
- 🎓 Estudante de Ciência da Computação - Unipê (P8)
- 💻 Desenvolvedor Full Stack
- 🚀 Sistema desenvolvido com Laravel, Livewire e Tailwind CSS

### 📧 Contato para Licenciamento
- Email: contato através do GitHub
- Licenças comerciais disponíveis mediante consulta

---

## 📞 Suporte

Para dúvidas sobre o sistema:
- 📧 Email: Através do sistema
- 💼 Suporte comercial disponível para clientes licenciados

---

<p align="center">
  Feito com ❤️ e ☕ por <strong>Gabriel Ângelo</strong>
</p>

<p align="center">
  <sub>Sistema de Gestão Multi-Empresas - Estoque Pro © 2025</sub>
</p>
