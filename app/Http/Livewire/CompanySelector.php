<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanySelector extends Component
{
    public $companies;
    public $selectedCompanyId;

    public function mount()
    {
        $this->companies = Company::where('active', true)->get();
        $this->selectedCompanyId = session('selected_company_id');
    }

    public function selectCompany($companyId)
    {
        session(['selected_company_id' => $companyId]);
        $this->selectedCompanyId = $companyId;
        
        $this->emit('companyChanged');
        
        // Redirecionar para dashboard
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.company-selector');
    }
}
