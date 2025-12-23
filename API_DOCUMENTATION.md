# API REST - EstoquePro

## 🔐 Autenticação

A API utiliza **Laravel Sanctum** com tokens Bearer para autenticação.

### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@sistema.com",
  "password": "admin123",
  "guard": "admin"  // opcional: "web" ou "admin"
}
```

**Resposta:**
```json
{
  "access_token": "1|xyz...",
  "token_type": "Bearer",
  "user": { ... }
}
```

### Logout
```http
POST /api/logout
Authorization: Bearer {token}
```

### Perfil do Usuário
```http
GET /api/me
Authorization: Bearer {token}
```

### Atualizar Perfil
```http
PUT /api/profile
Authorization: Bearer {token}

{
  "name": "Novo Nome",
  "email": "novo@email.com",
  "password": "novasenha",
  "password_confirmation": "novasenha"
}
```

---

## 📦 Produtos

### Listar Produtos
```http
GET /api/products?page=1&per_page=15&search=produto&category_id=1
Authorization: Bearer {token}
```

### Ver Produto
```http
GET /api/products/{id}
Authorization: Bearer {token}
```

### Criar Produto
```http
POST /api/products
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "company_id": 1,
  "category_id": 1,
  "supplier_id": 1,
  "name": "Produto Teste",
  "description": "Descrição",
  "price": 99.90,
  "quantity": 100,
  "sku": "PROD-001",
  "image": <file>
}
```

### Atualizar Produto
```http
PUT /api/products/{id}
Authorization: Bearer {token}

{
  "name": "Produto Atualizado",
  "price": 149.90
}
```

### Excluir Produto
```http
DELETE /api/products/{id}
Authorization: Bearer {token}
```

---

## 🏷️ Categorias

### Listar Categorias
```http
GET /api/categories?search=categoria
Authorization: Bearer {token}
```

### Ver Categoria
```http
GET /api/categories/{id}
Authorization: Bearer {token}
```

### Criar Categoria
```http
POST /api/categories
Authorization: Bearer {token}

{
  "company_id": 1,
  "name": "Eletrônicos",
  "description": "Produtos eletrônicos"
}
```

### Atualizar Categoria
```http
PUT /api/categories/{id}
Authorization: Bearer {token}

{
  "name": "Nova Categoria"
}
```

### Excluir Categoria
```http
DELETE /api/categories/{id}
Authorization: Bearer {token}
```

---

## 🚚 Fornecedores

### Listar Fornecedores
```http
GET /api/suppliers?search=fornecedor
Authorization: Bearer {token}
```

### Ver Fornecedor
```http
GET /api/suppliers/{id}
Authorization: Bearer {token}
```

### Criar Fornecedor
```http
POST /api/suppliers
Authorization: Bearer {token}

{
  "company_id": 1,
  "name": "Fornecedor ABC",
  "email": "fornecedor@email.com",
  "phone": "(11) 98765-4321",
  "cnpj": "12.345.678/0001-90",
  "address": "Rua Exemplo, 123"
}
```

### Atualizar Fornecedor
```http
PUT /api/suppliers/{id}
Authorization: Bearer {token}

{
  "name": "Novo Nome"
}
```

### Excluir Fornecedor
```http
DELETE /api/suppliers/{id}
Authorization: Bearer {token}
```

---

## 📊 Movimentações

### Listar Movimentações
```http
GET /api/movements?type=entrada&product_id=1&date_from=2025-01-01&date_to=2025-12-31
Authorization: Bearer {token}
```

### Ver Movimentação
```http
GET /api/movements/{id}
Authorization: Bearer {token}
```

### Criar Movimentação
```http
POST /api/movements
Authorization: Bearer {token}

{
  "product_id": 1,
  "type": "entrada",  // "entrada" ou "saida"
  "quantity": 50,
  "price": 99.90,
  "notes": "Observações opcionais"
}
```

### Excluir Movimentação
```http
DELETE /api/movements/{id}
Authorization: Bearer {token}
```
*Obs: Excluir reverte o estoque automaticamente*

---

## 🏢 Empresas

### Listar Empresas
```http
GET /api/companies?search=empresa&active=true
Authorization: Bearer {token}
```

### Ver Empresa
```http
GET /api/companies/{id}
Authorization: Bearer {token}
```

### Criar Empresa
```http
POST /api/companies
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "name": "Empresa ABC",
  "cnpj": "12.345.678/0001-90",
  "email": "empresa@email.com",
  "phone": "(11) 1234-5678",
  "address": "Av. Principal, 456",
  "logo": <file>,
  "active": true
}
```

### Atualizar Empresa
```http
PUT /api/companies/{id}
Authorization: Bearer {token}

{
  "name": "Novo Nome",
  "active": false
}
```

### Excluir Empresa
```http
DELETE /api/companies/{id}
Authorization: Bearer {token}
```

---

## 📝 Usando no JavaScript

```javascript
// Login
const { access_token, user } = await api.login('admin@sistema.com', 'admin123');

// Listar produtos
const products = await api.getProducts({ search: 'notebook', per_page: 20 });

// Criar produto
const newProduct = await api.createProduct({
  company_id: 1,
  category_id: 2,
  name: 'Notebook Dell',
  price: 3500.00,
  quantity: 10,
  sku: 'NB-DELL-001'
});

// Atualizar produto
await api.updateProduct(1, { price: 3200.00 });

// Excluir produto
await api.deleteProduct(1);

// Logout
await api.logout();
```

---

## ⚠️ Tratamento de Erros

```javascript
try {
  await api.createProduct(data);
} catch (error) {
  console.log(error.status);      // 422
  console.log(error.message);     // Mensagem de erro
  console.log(error.errors);      // Erros de validação
}
```

**Códigos de status:**
- `200` - Sucesso
- `201` - Criado
- `401` - Não autenticado
- `403` - Não autorizado
- `404` - Não encontrado
- `422` - Erros de validação
- `500` - Erro interno
