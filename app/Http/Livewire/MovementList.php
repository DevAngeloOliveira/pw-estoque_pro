<?php

namespace App\Http\Livewire;

use App\Models\ProductMovement;
use Livewire\Component;
use Livewire\WithPagination;

class MovementList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $perPage = 25;
    public $sortField = 'movement_date';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'filterType', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filterType = '';
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    public function render()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        if (!$companyId) {
            return view('livewire.movement-list', [
                'movements' => collect(),
                'totalEntradas' => 0,
                'totalSaidas' => 0,
                'totalGanhos' => 0,
                'noCompanySelected' => true
            ]);
        }

        $query = ProductMovement::with(['product', 'company'])
            ->where('company_id', $companyId);

        if ($this->search) {
            $query->whereHas('product', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->dateFrom) {
            $query->whereDate('movement_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('movement_date', '<=', $this->dateTo);
        }

        $movements = $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);

        // Calcular totais
        $allMovements = ProductMovement::where('company_id', $companyId);

        $totalEntradas = $allMovements->clone()->where('type', 'entrada')->sum('total_price');
        $totalSaidas = $allMovements->clone()->where('type', 'saida')->sum('total_price');
        $totalGanhos = $totalSaidas - $totalEntradas;

        return view('livewire.movement-list', [
            'movements' => $movements,
            'totalEntradas' => $totalEntradas,
            'totalSaidas' => $totalSaidas,
            'totalGanhos' => $totalGanhos,
            'noCompanySelected' => false
        ]);
    }
}
