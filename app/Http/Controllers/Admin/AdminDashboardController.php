<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductMovement;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Exibe a dashboard administrativa
     */
    public function index()
    {
        // Estatísticas gerais
        $stats = [
            'total_companies' => Company::count(),
            'active_companies' => Company::where('active', true)->count(),
            'total_products' => Product::count(),
            'total_suppliers' => Supplier::count(),
            'global_suppliers' => Supplier::where('is_global', true)->count(),
            'total_categories' => Category::count(),
            'total_movements' => ProductMovement::count(),
        ];

        // Valor total do estoque (todas as empresas)
        $stats['total_stock_value'] = Product::select(DB::raw('SUM(price * quantity) as total'))
            ->value('total') ?? 0;

        // Movimentações recentes (últimos 7 dias)
        $stats['recent_movements'] = ProductMovement::where('movement_date', '>=', Carbon::now()->subDays(7))
            ->count();

        // Produtos com estoque baixo (todas as empresas)
        $lowStockProducts = Product::with(['company', 'category'])
            ->where('quantity', '<=', 10)
            ->orderBy('quantity', 'asc')
            ->limit(10)
            ->get();

        // Empresas mais ativas (por número de movimentações nos últimos 30 dias)
        $topCompanies = Company::select('companies.*')
            ->join('product_movements', 'companies.id', '=', 'product_movements.company_id')
            ->where('product_movements.movement_date', '>=', Carbon::now()->subDays(30))
            ->groupBy(
                'companies.id',
                'companies.cnpj',
                'companies.razao_social',
                'companies.nome_fantasia',
                'companies.email',
                'companies.telefone',
                'companies.endereco',
                'companies.password',
                'companies.active',
                'companies.use_global_suppliers',
                'companies.created_at',
                'companies.updated_at'
            )
            ->selectRaw('COUNT(product_movements.id) as movements_count')
            ->orderBy('movements_count', 'desc')
            ->limit(5)
            ->get();

        // Movimentações por tipo (últimos 30 dias)
        $movementsByType = ProductMovement::select('type')
            ->selectRaw('COUNT(*) as count, SUM(total_price) as total_value')
            ->where('movement_date', '>=', Carbon::now()->subDays(30))
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        // Movimentações diárias (últimos 30 dias) para gráfico
        $dailyMovements = ProductMovement::select(DB::raw('DATE(movement_date) as date'))
            ->selectRaw('type')
            ->selectRaw('COUNT(*) as count')
            ->selectRaw('SUM(total_price) as total')
            ->where('movement_date', '>=', Carbon::now()->subDays(30))
            ->groupBy('date', 'type')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Produtos mais movimentados (últimos 30 dias)
        $topProducts = Product::select('products.*')
            ->join('product_movements', 'products.id', '=', 'product_movements.product_id')
            ->with(['company', 'category'])
            ->where('product_movements.movement_date', '>=', Carbon::now()->subDays(30))
            ->groupBy(
                'products.id',
                'products.company_id',
                'products.category_id',
                'products.supplier_id',
                'products.name',
                'products.description',
                'products.price',
                'products.quantity',
                'products.sku',
                'products.image',
                'products.created_at',
                'products.updated_at'
            )
            ->selectRaw('SUM(product_movements.quantity) as total_quantity')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();

        // Fornecedores mais utilizados
        $topSuppliers = Supplier::select('suppliers.*')
            ->join('products', 'suppliers.id', '=', 'products.supplier_id')
            ->groupBy(
                'suppliers.id',
                'suppliers.company_id',
                'suppliers.is_global',
                'suppliers.name',
                'suppliers.legal_name',
                'suppliers.cnpj',
                'suppliers.email',
                'suppliers.phone',
                'suppliers.whatsapp',
                'suppliers.website',
                'suppliers.address',
                'suppliers.address_number',
                'suppliers.complement',
                'suppliers.neighborhood',
                'suppliers.city',
                'suppliers.state',
                'suppliers.zip_code',
                'suppliers.notes',
                'suppliers.active',
                'suppliers.created_at',
                'suppliers.updated_at'
            )
            ->selectRaw('COUNT(products.id) as products_count')
            ->orderBy('products_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'lowStockProducts',
            'topCompanies',
            'movementsByType',
            'dailyMovements',
            'topProducts',
            'topSuppliers'
        ));
    }

    /**
     * Exibe lista de todas as empresas
     */
    public function companies()
    {
        $companies = Company::withCount(['products', 'movements'])
            ->orderBy('nome_fantasia')
            ->paginate(15);

        return view('admin.companies', compact('companies'));
    }

    /**
     * Exibe detalhes de uma empresa específica
     */
    public function companyDetails($id)
    {
        $company = Company::with(['products.category', 'movements.product'])
            ->withCount(['products', 'movements'])
            ->findOrFail($id);

        // Estatísticas da empresa
        $companyStats = [
            'total_products' => $company->products->count(),
            'total_stock_value' => $company->products->sum(function ($product) {
                return $product->price * $product->quantity;
            }),
            'low_stock_products' => $company->products->filter(function ($product) {
                return $product->quantity <= ($product->quantity * 0.3) || $product->quantity <= 10;
            })->count(),
            'recent_movements' => $company->movements()
                ->where('movement_date', '>=', Carbon::now()->subDays(7))
                ->count(),
        ];

        return view('admin.company-details', compact('company', 'companyStats'));
    }

    /**
     * Exibe formulário para criar nova empresa
     */
    public function createCompany()
    {
        return view('admin.company-form');
    }

    /**
     * Exibe formulário para editar empresa
     */
    public function editCompany($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company-form', compact('company'));
    }

    /**
     * Exibe gerenciador de fornecedores globais
     */
    public function globalSuppliers()
    {
        return view('admin.global-suppliers');
    }

    /**
     * Alterna o status ativo/bloqueado da empresa
     */
    public function toggleCompanyStatus($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->active = !$company->active;
            $company->save();

            $status = $company->active ? 'liberado' : 'bloqueado';
            return redirect()->route('admin.companies')
                ->with('success', "Acesso da empresa {$status} com sucesso!");
        } catch (\Exception $e) {
            return redirect()->route('admin.companies')
                ->with('error', 'Erro ao alterar status: ' . $e->getMessage());
        }
    }
}
