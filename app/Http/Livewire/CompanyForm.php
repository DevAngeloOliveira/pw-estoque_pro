<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanyForm extends Component
{
    public $companyId;
    public $cnpj;
    public $razao_social;
    public $nome_fantasia;
    public $email;
    public $telefone;
    public $endereco;
    public $active = true;

    protected $rules = [
        'cnpj' => 'required|size:18',
        'razao_social' => 'required|min:3',
        'nome_fantasia' => 'nullable',
        'email' => 'nullable|email',
        'telefone' => 'nullable',
        'endereco' => 'nullable',
        'active' => 'boolean',
    ];

    protected $messages = [
        'cnpj.required' => 'O CNPJ é obrigatório',
        'cnpj.size' => 'CNPJ inválido',
        'razao_social.required' => 'A Razão Social é obrigatória',
        'razao_social.min' => 'A Razão Social deve ter no mínimo 3 caracteres',
        'email.email' => 'E-mail inválido',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $company = Company::findOrFail($id);
            $this->companyId = $company->id;
            $this->cnpj = $company->cnpj;
            $this->razao_social = $company->razao_social;
            $this->nome_fantasia = $company->nome_fantasia;
            $this->email = $company->email;
            $this->telefone = $company->telefone;
            $this->endereco = $company->endereco;
            $this->active = $company->active;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        // Formatar CNPJ automaticamente
        if ($propertyName === 'cnpj') {
            $this->cnpj = $this->formatCnpj($this->cnpj);
        }
    }

    public function formatCnpj($cnpj)
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);
        
        if (strlen($cnpj) <= 14) {
            $cnpj = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
        }
        
        return $cnpj;
    }

    public function save()
    {
        $this->validate();

        // Validar CNPJ
        if (!Company::validateCnpj($this->cnpj)) {
            $this->addError('cnpj', 'CNPJ inválido');
            return;
        }

        // Verificar se CNPJ já existe (exceto para edição)
        $existingCompany = Company::where('cnpj', preg_replace('/\D/', '', $this->cnpj))
            ->when($this->companyId, function ($query) {
                return $query->where('id', '!=', $this->companyId);
            })
            ->first();

        if ($existingCompany) {
            $this->addError('cnpj', 'CNPJ já cadastrado');
            return;
        }

        $data = [
            'cnpj' => preg_replace('/\D/', '', $this->cnpj),
            'razao_social' => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'active' => $this->active,
        ];

        if ($this->companyId) {
            Company::find($this->companyId)->update($data);
            session()->flash('message', 'Empresa atualizada com sucesso!');
        } else {
            Company::create($data);
            session()->flash('message', 'Empresa cadastrada com sucesso!');
        }

        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.company-form');
    }
}
