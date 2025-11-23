<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductMovement;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        // Tenant isolation: apenas dados da empresa logada
        $companyId = auth()->guard('company')->id();

        // Estatísticas gerais
        $totalProducts = Product::where('company_id', $companyId)->count();
        $totalValue = Product::where('company_id', $companyId)->sum(DB::raw('price * quantity'));
        $lowStockProducts = Product::where('company_id', $companyId)->where('quantity', '<=', 10)->count();

        // Movimentações
        $totalEntradas = ProductMovement::where('company_id', $companyId)
            ->where('type', 'entrada')
            ->sum('total_price');

        $totalSaidas = ProductMovement::where('company_id', $companyId)
            ->where('type', 'saida')
            ->sum('total_price');

        $totalGanhos = $totalSaidas - $totalEntradas;

        // Produtos mais vendidos (últimos 30 dias)
        $topProducts = ProductMovement::where('company_id', $companyId)
            ->where('type', 'saida')
            ->where('movement_date', '>=', now()->subDays(30))
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total_price) as total_value'))
            ->groupBy('product_id')
            ->orderBy('total_value', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        // Produtos com estoque baixo
        $lowStockList = Product::where('company_id', $companyId)
            ->where('quantity', '<=', 10)
            ->orderBy('quantity', 'asc')
            ->limit(5)
            ->get();

        // Últimas movimentações
        $recentMovements = ProductMovement::where('company_id', $companyId)
            ->with('product')
            ->latest('movement_date')
            ->limit(10)
            ->get();

        // Dados para gráfico de movimentações (últimos 7 dias)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');

            $entradas = ProductMovement::where('company_id', $companyId)
                ->where('type', 'entrada')
                ->whereDate('movement_date', $date)
                ->sum('total_price');

            $saidas = ProductMovement::where('company_id', $companyId)
                ->where('type', 'saida')
                ->whereDate('movement_date', $date)
                ->sum('total_price');

            $chartData[] = [
                'date' => now()->subDays($i)->format('d/m'),
                'entradas' => round($entradas, 2),
                'saidas' => round($saidas, 2)
            ];
        }

        return view('livewire.dashboard', compact(
            'totalProducts',
            'totalValue',
            'lowStockProducts',
            'totalEntradas',
            'totalSaidas',
            'totalGanhos',
            'topProducts',
            'lowStockList',
            'recentMovements',
            'chartData'
        ));
    }
}
