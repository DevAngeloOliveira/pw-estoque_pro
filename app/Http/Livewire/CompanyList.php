<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyList extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $companyToDelete = null;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($companyId)
    {
        $this->companyToDelete = $companyId;
        $this->showDeleteModal = true;
    }

    public function deleteCompany()
    {
        if ($this->companyToDelete) {
            Company::find($this->companyToDelete)->delete();
            $this->showDeleteModal = false;
            $this->companyToDelete = null;
            session()->flash('message', 'Empresa excluída com sucesso!');
        }
    }

    public function toggleStatus($companyId)
    {
        $company = Company::find($companyId);
        $company->active = !$company->active;
        $company->save();
    }

    public function render()
    {
        $companies = Company::where('razao_social', 'like', '%' . $this->search . '%')
            ->orWhere('cnpj', 'like', '%' . $this->search . '%')
            ->orWhere('nome_fantasia', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.company-list', compact('companies'));
    }
}
