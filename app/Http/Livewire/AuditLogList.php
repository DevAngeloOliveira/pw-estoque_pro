<?php

namespace App\Http\Livewire;

use App\Models\AuditLog;
use Livewire\Component;
use Livewire\WithPagination;

class AuditLogList extends Component
{
    use WithPagination;

    public $search = '';
    public $actionFilter = '';
    public $modelFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $perPage = 25;

    protected $queryString = ['search', 'actionFilter', 'modelFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingActionFilter()
    {
        $this->resetPage();
    }

    public function updatingModelFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->actionFilter = '';
        $this->modelFilter = '';
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    public function render()
    {
        // Tenant isolation
        $companyId = auth()->guard('company')->id();

        $query = AuditLog::where('company_id', $companyId)
            ->with(['company']);

        // Filtro de busca (busca no ID do registro)
        if ($this->search) {
            $query->where('auditable_id', 'like', '%' . $this->search . '%');
        }

        // Filtro de ação
        if ($this->actionFilter) {
            $query->where('action', $this->actionFilter);
        }

        // Filtro de modelo
        if ($this->modelFilter) {
            $query->where('auditable_type', $this->modelFilter);
        }

        // Filtro de data
        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        $auditLogs = $query->latest()
            ->paginate($this->perPage);

        // Estatísticas
        $totalLogs = AuditLog::where('company_id', $companyId)->count();
        $todayLogs = AuditLog::where('company_id', $companyId)
            ->whereDate('created_at', today())
            ->count();
        $weekLogs = AuditLog::where('company_id', $companyId)
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->count();

        return view('livewire.audit-log-list', compact('auditLogs', 'totalLogs', 'todayLogs', 'weekLogs'));
    }
}
