<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMovement;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Exports\MovementsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Exportar produtos para PDF
     */
    public function exportProductsPdf()
    {
        $companyId = Auth::guard('company')->user()->id;
        $company = Company::find($companyId);

        $products = Product::where('company_id', $companyId)
            ->orderBy('name', 'asc')
            ->get();

        $totalValue = $products->sum(function ($product) {
            return $product->price * $product->quantity;
        });

        $pdf = Pdf::loadView('reports.products-pdf', [
            'products' => $products,
            'company' => $company,
            'totalValue' => $totalValue,
            'date' => now()->format('d/m/Y H:i')
        ]);

        return $pdf->download('relatorio-produtos-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar produtos para Excel
     */
    public function exportProductsExcel()
    {
        return Excel::download(new ProductsExport, 'relatorio-produtos-' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Exportar movimentações para PDF
     */
    public function exportMovementsPdf(Request $request)
    {
        $companyId = Auth::guard('company')->user()->id;
        $company = Company::find($companyId);

        $query = ProductMovement::with('product')
            ->where('company_id', $companyId);

        // Aplicar filtros se fornecidos
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('movement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('movement_date', '<=', $request->date_to);
        }

        $movements = $query->orderBy('movement_date', 'desc')->get();

        $totalEntradas = $movements->where('type', 'entrada')->sum('total_price');
        $totalSaidas = $movements->where('type', 'saida')->sum('total_price');

        $pdf = Pdf::loadView('reports.movements-pdf', [
            'movements' => $movements,
            'company' => $company,
            'totalEntradas' => $totalEntradas,
            'totalSaidas' => $totalSaidas,
            'totalGanhos' => $totalSaidas - $totalEntradas,
            'date' => now()->format('d/m/Y H:i'),
            'filters' => $request->only(['type', 'date_from', 'date_to'])
        ]);

        return $pdf->download('relatorio-movimentacoes-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar movimentações para Excel
     */
    public function exportMovementsExcel(Request $request)
    {
        return Excel::download(
            new MovementsExport($request->only(['type', 'date_from', 'date_to'])),
            'relatorio-movimentacoes-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Relatório geral (dashboard)
     */
    public function exportDashboardPdf()
    {
        $companyId = Auth::guard('company')->user()->id;
        $company = Company::find($companyId);

        $totalProducts = Product::where('company_id', $companyId)->count();
        $totalValue = Product::where('company_id', $companyId)
            ->get()
            ->sum(function ($product) {
                return $product->price * $product->quantity;
            });

        $lowStockProducts = Product::where('company_id', $companyId)
            ->where('quantity', '<=', 10)
            ->count();

        $totalEntradas = ProductMovement::where('company_id', $companyId)
            ->where('type', 'entrada')
            ->sum('total_price');

        $totalSaidas = ProductMovement::where('company_id', $companyId)
            ->where('type', 'saida')
            ->sum('total_price');

        $topProducts = ProductMovement::where('company_id', $companyId)
            ->where('type', 'saida')
            ->where('movement_date', '>=', now()->subDays(30))
            ->select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(total_price) as total_value')
            ->groupBy('product_id')
            ->orderBy('total_value', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        $lowStockList = Product::where('company_id', $companyId)
            ->where('quantity', '<=', 10)
            ->orderBy('quantity', 'asc')
            ->limit(5)
            ->get();

        $recentMovements = ProductMovement::where('company_id', $companyId)
            ->with('product')
            ->latest('movement_date')
            ->limit(10)
            ->get();

        $pdf = Pdf::loadView('reports.dashboard-pdf', [
            'company' => $company,
            'totalProducts' => $totalProducts,
            'totalValue' => $totalValue,
            'lowStockProducts' => $lowStockProducts,
            'totalEntradas' => $totalEntradas,
            'totalSaidas' => $totalSaidas,
            'totalGanhos' => $totalSaidas - $totalEntradas,
            'topProducts' => $topProducts,
            'lowStockList' => $lowStockList,
            'recentMovements' => $recentMovements,
            'date' => now()->format('d/m/Y H:i')
        ]);

        return $pdf->download('relatorio-geral-' . now()->format('Y-m-d') . '.pdf');
    }
}
