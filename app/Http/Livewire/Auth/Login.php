<?php

namespace App\Http\Livewire\Auth;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $cnpj;
    public $password;
    public $remember = false;

    protected $rules = [
        'cnpj' => 'required|size:18',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'cnpj.required' => 'O CNPJ é obrigatório',
        'cnpj.size' => 'CNPJ inválido',
        'password.required' => 'A senha é obrigatória',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

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

    public function login()
    {
        $this->validate();

        $cnpjClean = preg_replace('/\D/', '', $this->cnpj);
        $company = Company::where('cnpj', $cnpjClean)->first();

        $errors = collect([
            'company_not_found' => fn() => !$company ? 'CNPJ não encontrado em nosso sistema' : null,
            'company_inactive' => fn() => $company && !$company->active ? '⚠️ Acesso bloqueado! Sua empresa está com o acesso suspenso. Entre em contato com o administrador do sistema.' : null,
            'invalid_password' => fn() => $company && !Hash::check($this->password, $company->password) ? 'Senha incorreta' : null,
        ])->map(fn($validator) => $validator())->filter()->first();

        if ($errors) {
            $field = str_contains($errors, 'Senha') ? 'password' : 'cnpj';
            $this->addError($field, $errors);
            return;
        }

        Auth::guard('company')->login($company, $this->remember);
        session(['selected_company_id' => $company->id]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
