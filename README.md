# 📦 Estoque Pro - Sistema de Gestão Multi-Empresas

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-8.83.29-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-2.x-4E56A6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
</p>

## 📋 Sobre o Projeto

**Estoque Pro** é um sistema completo e moderno de gerenciamento de estoque desenvolvido com Laravel e Livewire, projetado para permitir que múltiplas empresas gerenciem seus produtos, movimentações, fornecedores e relatórios de forma independente e segura, com painel administrativo centralizado.

### 🎯 Principais Funcionalidades

#### 👥 Para Empresas
- ✅ **Autenticação por CNPJ** - Login seguro com validação de CNPJ
- 🏢 **Multi-Tenant** - Gestão isolada de dados por empresa
- 📦 **Gestão de Produtos** - CRUD completo com categorias e fornecedores
- 📊 **Página de Detalhes** - Visão completa de produtos com estatísticas e gráficos
- 🔄 **Movimentações** - Registro de entradas/saídas com atualização automática
- 📈 **Dashboard Interativo** - Gráficos em tempo real com Chart.js
- 🏪 **Fornecedores** - Gestão de fornecedores próprios ou uso de globais
- 📂 **Categorias** - Organização de produtos por categorias
- 👤 **Perfil** - Edição de dados e troca de senha
- 📋 **Relatórios** - Exportação para PDF e Excel

#### 🔐 Para Administradores
- 🛡️ **Painel Admin** - Dashboard administrativo completo
- 🏢 **Gerenciamento de Empresas** - CRUD completo de empresas
- 🚚 **Fornecedores Globais** - Sistema de fornecedores compartilhados
- 📊 **Estatísticas Gerais** - Visão consolidada de todas as empresas
- 👥 **Controle de Acesso** - Ativar/desativar empresas
- 🔍 **Monitoramento** - Acompanhar atividades do sistema

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **Laravel 8.6.12** - Framework PHP para desenvolvimento web
- **Livewire 2.12.8** - Framework full-stack para interfaces dinâmicas
- **PHP 7.4.3** - Linguagem de programação
- **SQLite** - Banco de dados leve e eficiente

### Frontend
- **Tailwind CSS** - Framework CSS utility-first
- **Chart.js 4.4.0** - Biblioteca para gráficos interativos
- **Font Awesome 6.4.0** - Ícones vetoriais
- **jQuery 3.6.0** - Biblioteca JavaScript
- **jQuery Mask Plugin 1.14.16** - Máscaras de input (CNPJ, telefone, moeda)

---

## 📦 Estrutura do Projeto

```
projeto-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       ├── AdminAuthController.php      # Autenticação admin
│   │   │       └── AdminDashboardController.php # Dashboard admin
│   │   ├── Livewire/
│   │   │   ├── Admin/
│   │   │   │   ├── CompanyManager.php           # CRUD empresas
│   │   │   │   └── GlobalSupplierManager.php    # CRUD fornecedores globais
│   │   │   ├── Auth/
│   │   │   │   ├── Login.php                    # Login empresas
│   │   │   │   └── Register.php                 # Registro empresas
│   │   │   ├── CategoryManager.php              # Gestão categorias
│   │   │   ├── Dashboard.php                    # Dashboard empresa
│   │   │   ├── ProductDetails.php               # Detalhes produto
│   │   │   ├── ProductList.php                  # Lista produtos
│   │   │   ├── ProductMovementManager.php       # Movimentações
│   │   │   ├── Profile.php                      # Perfil empresa
│   │   │   └── SupplierManager.php              # Gestão fornecedores
│   │   └── Middleware/
│   │       ├── Authenticate.php                 # Middleware auth customizado
│   │       └── TenantMiddleware.php             # Isolamento multi-tenant
│   └── Models/
│       ├── Admin.php                            # Model admin
│       ├── Category.php                         # Model categorias
│       ├── Company.php                          # Model empresas
│       ├── Product.php                          # Model produtos
│       ├── ProductMovement.php                  # Model movimentações
│       └── Supplier.php                         # Model fornecedores
│
├── database/
│   ├── migrations/
│   │   ├── *_create_companies_table.php
│   │   ├── *_create_products_table.php
│   │   ├── *_create_categories_table.php
│   │   ├── *_create_suppliers_table.php
│   │   ├── *_create_product_movements_table.php
│   │   └── *_create_admins_table.php
│   └── seeders/
│       ├── AdminSeeder.php                      # Admin padrão
│       ├── CompanySeeder.php                    # Empresas exemplo
│       ├── CategorySeeder.php                   # Categorias padrão
│       ├── SupplierSeeder.php                   # Fornecedores exemplo
│       ├── ProductSeeder.php                    # Produtos exemplo
│       └── ProductMovementSeeder.php            # Movimentações exemplo
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── layout.blade.php                 # Layout admin
│       │   ├── dashboard.blade.php              # Dashboard admin
│       │   ├── companies.blade.php              # Lista empresas
│       │   ├── company-form.blade.php           # Form empresas
│       │   ├── company-details.blade.php        # Detalhes empresa
│       │   └── global-suppliers.blade.php       # Fornecedores globais
│       ├── layouts/
│       │   ├── app.blade.php                    # Layout principal empresa
│       │   └── guest.blade.php                  # Layout autenticação
│       ├── livewire/                            # Views componentes Livewire
│       ├── products/
│       │   ├── index.blade.php                  # Lista produtos
│       │   ├── show.blade.php                   # Detalhes produto
│       │   ├── create.blade.php                 # Criar produto
│       │   └── edit.blade.php                   # Editar produto
│       ├── welcome.blade.php                    # Landing page
│       └── dashboard.blade.php                  # Dashboard empresa
│
├── routes/
│   └── web.php                                  # Rotas do sistema
│
└── config/
    └── auth.php                                 # Configuração guards
```

---

## 🚀 Instalação e Configuração

### Pré-requisitos

- PHP 7.4 ou superior
- Composer
- XAMPP ou servidor web similar

### Passo a Passo

1. **Clone o repositório**
```bash
cd c:\xampp\htdocs\pw_crud_serv
git clone <seu-repositorio> projeto-laravel
cd projeto-laravel
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados no `.env`**
```env
DB_CONNECTION=sqlite
```

5. **Crie o banco de dados**
```bash
touch database/database.sqlite
```

6. **Execute as migrations e seeders**
```bash
php artisan migrate:fresh --seed
```

7. **Inicie o servidor**
```bash
php artisan serve
```

8. **Acesse o sistema**
- Homepage: `http://127.0.0.1:8000`
- Login: `http://127.0.0.1:8000/login`

---

## 🔐 Credenciais de Teste

O sistema vem com dados de exemplo pré-cadastrados:

### 👨‍💼 Administrador
| Tipo | Email | Senha | URL |
|------|-------|-------|-----|
| Admin | admin@sistema.com | admin123 | /admin/login |

### 🏢 Empresas
| Empresa | CNPJ | Senha | URL |
|---------|------|-------|-----|
| TechSol | 12.345.678/0001-95 | senha123 | /login |
| ABC Store | 98.765.432/0001-10 | senha123 | /login |
| XYZ Distribuidora | 11.222.333/0001-44 | senha123 | /login |

### 📊 Dados de Exemplo Inclusos
- **1 Administrador** com acesso total
- **3 Empresas** ativas e configuradas
- **8 Fornecedores** (5 globais + 3 específicos)
- **12 Categorias** padrão
- **30 Produtos** distribuídos entre empresas
- **150+ Movimentações** de exemplo

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
  - [ ] Mais gráficos e métricas
  - [ ] Comparativos entre períodos
  - [ ] Previsão de estoque
  
- [ ] **Notificações**
  - [ ] Sistema de notificações push
  - [ ] Alertas de estoque baixo via email
  - [ ] Notificações de movimentações críticas
  
- [ ] **Relatórios Avançados**
  - [ ] Relatórios personalizados
  - [ ] Agendamento de relatórios
  - [ ] Análise de tendências
  
- [ ] **API REST**
  - [ ] Endpoints para integrações
  - [ ] Documentação Swagger
  - [ ] OAuth2 authentication
  
- [ ] **Auditoria**
  - [ ] Logs detalhados de ações
  - [ ] Rastreamento de mudanças
  - [ ] Histórico de acessos
  
- [ ] **Melhorias UX**
  - [ ] Implementar DataTables nas listagens
  - [ ] Dark mode
  - [ ] PWA (Progressive Web App)
  - [ ] Atalhos de teclado
  
- [ ] **Funcionalidades Extras**
  - [ ] Importação em massa (CSV/Excel)
  - [ ] Backup automático
  - [ ] Múltiplos idiomas (i18n)
  - [ ] Código de barras para produtos
  - [ ] Integração com sistemas de pagamento

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
                    │  SQLite Database │
                    └──────────────────┘
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

## 📝 Licença

Este projeto foi desenvolvido como sistema de gestão empresarial. Todos os direitos reservados.

---

## 👨‍💻 Autor

**Gabriel Ângelo Oliveira Silva**
- Estudante de Ciência da Computação - Unipê (P8)
- Sistema desenvolvido com Laravel, Livewire e Tailwind CSS

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

---

## 📞 Suporte

Para dúvidas, sugestões ou reportar problemas:
- 📧 Email: Através do sistema
- 🐛 Issues: Abra uma issue no repositório
- 💬 Discussões: Use a aba de discussões do GitHub

---

## 🙏 Agradecimentos

- Laravel Framework pela excelente documentação
- Livewire pela simplicidade e poder
- Tailwind CSS pelo design system
- Chart.js pelos gráficos interativos
- Font Awesome pelos ícones
- Comunidade PHP/Laravel pelo suporte

---

<p align="center">
  Feito com ❤️ e ☕ por <strong>Gabriel Ângelo</strong>
</p>

<p align="center">
  <sub>Sistema de Gestão Multi-Empresas - Estoque Pro © 2025</sub>
</p>
