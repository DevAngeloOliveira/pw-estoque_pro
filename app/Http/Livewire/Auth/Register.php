<?php

namespace App\Http\Livewire\Auth;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $cnpj;
    public $password;
    public $password_confirmation;
    public $razao_social;
    public $nome_fantasia;
    public $email;
    public $telefone;
    public $endereco;
    public $active = true;

    protected $rules = [
        'cnpj' => 'required|size:18|unique:companies,cnpj',
        'password' => 'required|min:6|confirmed',
        'razao_social' => 'required|min:3',
        'nome_fantasia' => 'nullable',
        'email' => 'nullable|email',
        'telefone' => 'nullable',
        'endereco' => 'nullable',
    ];

    protected $messages = [
        'cnpj.required' => 'O CNPJ é obrigatório',
        'cnpj.size' => 'CNPJ inválido',
        'cnpj.unique' => 'CNPJ já cadastrado',
        'password.required' => 'A senha é obrigatória',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        'password.confirmed' => 'As senhas não conferem',
        'razao_social.required' => 'A Razão Social é obrigatória',
        'razao_social.min' => 'A Razão Social deve ter no mínimo 3 caracteres',
        'email.email' => 'E-mail inválido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'cnpj') {
            $this->cnpj = $this->formatCnpj($this->cnpj);
        }

        if ($propertyName === 'telefone') {
            $this->telefone = $this->formatTelefone($this->telefone);
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

    public function formatTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) == 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
        } elseif (strlen($telefone) == 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
        }

        return $telefone;
    }

    public function register()
    {
        $this->validate();

        if (!Company::validateCnpj($this->cnpj)) {
            $this->addError('cnpj', 'CNPJ inválido');
            return;
        }

        $company = Company::create([
            'cnpj' => preg_replace('/\D/', '', $this->cnpj),
            'password' => $this->password,
            'razao_social' => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'active' => $this->active ?? true,
        ]);

        Auth::guard('company')->login($company);
        session(['selected_company_id' => $company->id]);

        session()->flash('message', 'Empresa cadastrada com sucesso!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.guest-layout');
    }
}
