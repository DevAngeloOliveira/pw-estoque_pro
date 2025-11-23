<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductMovement;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductDetails extends Component
{
    public $productId;
    public $product;
    public $stats = [];
    public $recentMovements = [];
    public $chartData = [];

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadProduct();
        $this->calculateStats();
        $this->loadRecentMovements();
        $this->loadChartData();
    }

    public function loadProduct()
    {
        $companyId = Auth::guard('company')->user()->id;

        $this->product = Product::with(['category', 'supplier'])
            ->where('company_id', $companyId)
            ->findOrFail($this->productId);
    }

    public function calculateStats()
    {
        $companyId = Auth::guard('company')->user()->id;

        // Estatísticas dos últimos 30 dias
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        // Total de movimentações
        $this->stats['total_movements'] = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->where('movement_date', '>=', $thirtyDaysAgo)
            ->count();

        // Entradas
        $entradas = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->where('type', 'entrada')
            ->where('movement_date', '>=', $thirtyDaysAgo)
            ->selectRaw('SUM(quantity) as total_qty, SUM(total_price) as total_value')
            ->first();

        $this->stats['entradas_qty'] = $entradas->total_qty ?? 0;
        $this->stats['entradas_value'] = $entradas->total_value ?? 0;

        // Saídas
        $saidas = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->where('type', 'saida')
            ->where('movement_date', '>=', $thirtyDaysAgo)
            ->selectRaw('SUM(quantity) as total_qty, SUM(total_price) as total_value')
            ->first();

        $this->stats['saidas_qty'] = $saidas->total_qty ?? 0;
        $this->stats['saidas_value'] = $saidas->total_value ?? 0;

        // Valor total em estoque
        $this->stats['stock_value'] = $this->product->price * $this->product->quantity;

        // Status do estoque
        $this->stats['stock_status'] = $this->getStockStatus();

        // Média de movimentação diária
        $this->stats['daily_avg'] = round($this->stats['total_movements'] / 30, 2);

        // Última movimentação
        $lastMovement = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->orderBy('movement_date', 'desc')
            ->first();

        $this->stats['last_movement_date'] = $lastMovement ? $lastMovement->movement_date : null;
    }

    public function loadRecentMovements()
    {
        $companyId = Auth::guard('company')->user()->id;

        $this->recentMovements = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->orderBy('movement_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function loadChartData()
    {
        $companyId = Auth::guard('company')->user()->id;

        // Últimos 30 dias de movimentações agrupadas por dia e tipo
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $movements = ProductMovement::where('product_id', $this->productId)
            ->where('company_id', $companyId)
            ->where('movement_date', '>=', $thirtyDaysAgo)
            ->selectRaw('DATE(movement_date) as date, type, SUM(quantity) as total_qty')
            ->groupBy('date', 'type')
            ->orderBy('date', 'asc')
            ->get();

        // Preparar dados para o gráfico
        $dates = [];
        $entradas = [];
        $saidas = [];

        // Gerar array com todos os dias dos últimos 30 dias
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->format('d/m');
            $entradas[$date] = 0;
            $saidas[$date] = 0;
        }

        // Preencher com dados reais
        foreach ($movements as $movement) {
            $date = $movement->date;
            if (isset($entradas[$date])) {
                if ($movement->type === 'entrada') {
                    $entradas[$date] = (int) $movement->total_qty;
                } else {
                    $saidas[$date] = (int) $movement->total_qty;
                }
            }
        }

        $this->chartData = [
            'labels' => $dates,
            'entradas' => array_values($entradas),
            'saidas' => array_values($saidas),
        ];
    }

    public function getStockStatus()
    {
        $quantity = $this->product->quantity;

        if ($quantity == 0) {
            return ['status' => 'danger', 'text' => 'Sem Estoque', 'icon' => 'fa-times-circle'];
        } elseif ($quantity <= 10) {
            return ['status' => 'danger', 'text' => 'Estoque Crítico', 'icon' => 'fa-exclamation-triangle'];
        } elseif ($quantity <= 30) {
            return ['status' => 'warning', 'text' => 'Estoque Baixo', 'icon' => 'fa-exclamation-circle'];
        } else {
            return ['status' => 'success', 'text' => 'Estoque Normal', 'icon' => 'fa-check-circle'];
        }
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}
