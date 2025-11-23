<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $razao_social;
    public $nome_fantasia;
    public $cnpj;
    public $email;
    public $telefone;
    public $endereco;
    
    public $current_password;
    public $password;
    public $password_confirmation;
    
    protected $rules = [
        'razao_social' => 'required|min:3',
        'nome_fantasia' => 'nullable',
        'email' => 'nullable|email',
        'telefone' => 'nullable',
        'endereco' => 'nullable',
    ];

    protected $messages = [
        'razao_social.required' => 'A razão social é obrigatória',
        'razao_social.min' => 'A razão social deve ter no mínimo 3 caracteres',
        'email.email' => 'Digite um e-mail válido',
    ];

    public function mount()
    {
        $company = Auth::guard('company')->user();
        $this->razao_social = $company->razao_social;
        $this->nome_fantasia = $company->nome_fantasia;
        $this->cnpj = $company->cnpj;
        $this->email = $company->email;
        $this->telefone = $company->telefone;
        $this->endereco = $company->endereco;
    }

    public function updateProfile()
    {
        $this->validate();

        $company = Auth::guard('company')->user();
        $company->update([
            'razao_social' => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
        ]);

        session()->flash('message', 'Perfil atualizado com sucesso!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Digite sua senha atual',
            'password.required' => 'Digite a nova senha',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
            'password.confirmed' => 'As senhas não conferem',
        ]);

        $company = Auth::guard('company')->user();

        if (!Hash::check($this->current_password, $company->password)) {
            $this->addError('current_password', 'Senha atual incorreta');
            return;
        }

        $company->update([
            'password' => $this->password
        ]);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        session()->flash('password_message', 'Senha atualizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
