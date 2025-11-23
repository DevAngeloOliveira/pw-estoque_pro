<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ============================================
// ROTAS ADMINISTRATIVAS
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])
            ->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login']);
    });

    // Rotas protegidas do admin
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/companies', [App\Http\Controllers\Admin\AdminDashboardController::class, 'companies'])
            ->name('companies');

        Route::get('/companies/{id}', [App\Http\Controllers\Admin\AdminDashboardController::class, 'companyDetails'])
            ->name('company-details');

        // Gerenciamento de empresas
        Route::get('/companies/create', [App\Http\Controllers\Admin\AdminDashboardController::class, 'createCompany'])
            ->name('companies.create');
        Route::get('/companies/{id}/edit', [App\Http\Controllers\Admin\AdminDashboardController::class, 'editCompany'])
            ->name('companies.edit');
        Route::post('/companies/{id}/toggle-status', [App\Http\Controllers\Admin\AdminDashboardController::class, 'toggleCompanyStatus'])
            ->name('companies.toggle-status');

        // Fornecedores Globais
        Route::get('/global-suppliers', [App\Http\Controllers\Admin\AdminDashboardController::class, 'globalSuppliers'])
            ->name('global-suppliers');
    });
});

// Rotas de Autenticação (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// Rota de Logout
Route::get('/logout', function () {
    Auth::guard('company')->logout();
    session()->flush();
    return redirect()->route('login');
})->name('logout');

// Rotas Protegidas (Autenticadas) + Tenant Isolation
Route::middleware(['auth:company', 'tenant'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas de Empresas - DESABILITADAS no modelo tenant
    // Cada empresa é isolada e gerencia apenas seus próprios dados
    // Para administração de empresas, criar um painel admin separado
    /*
    Route::get('/companies', function () {
        return view('companies.index');
    })->name('companies.index');

    Route::get('/companies/create', function () {
        return view('companies.create');
    })->name('companies.create');

    Route::get('/companies/{id}/edit', function ($id) {
        return view('companies.edit', ['id' => $id]);
    })->name('companies.edit');
    */

    // Rotas de Produtos
    Route::get('/products', function () {
        return view('products.index');
    })->name('products.index');

    Route::get('/products/create', function () {
        return view('products.create');
    })->name('products.create');

    Route::get('/products/{id}/edit', function ($id) {
        return view('products.edit', ['id' => $id]);
    })->name('products.edit');

    Route::get('/products/{id}', function ($id) {
        return view('products.show', ['id' => $id]);
    })->name('products.show');

    // Rotas de Movimentações
    Route::get('/movements', function () {
        return view('movements.index');
    })->name('movements.index');

    Route::get('/movements/create', function () {
        return view('movements.create');
    })->name('movements.create');

    // Perfil
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Relatórios - Produtos
    Route::get('/reports/products/pdf', [App\Http\Controllers\ReportController::class, 'exportProductsPdf'])
        ->name('reports.products.pdf');
    Route::get('/reports/products/excel', [App\Http\Controllers\ReportController::class, 'exportProductsExcel'])
        ->name('reports.products.excel');

    // Relatórios - Movimentações
    Route::get('/reports/movements/pdf', [App\Http\Controllers\ReportController::class, 'exportMovementsPdf'])
        ->name('reports.movements.pdf');
    Route::get('/reports/movements/excel', [App\Http\Controllers\ReportController::class, 'exportMovementsExcel'])
        ->name('reports.movements.excel');

    // Relatório Geral (Dashboard)
    Route::get('/reports/dashboard/pdf', [App\Http\Controllers\ReportController::class, 'exportDashboardPdf'])
        ->name('reports.dashboard.pdf');

    // Auditoria
    Route::get('/audit', function () {
        return view('audit.index');
    })->name('audit.index');

    // Rotas de Categorias
    Route::get('/categories', function () {
        return view('categories.index');
    })->name('categories.index');

    // Rotas de Fornecedores
    Route::get('/suppliers', function () {
        return view('suppliers.index');
    })->name('suppliers.index');
});
